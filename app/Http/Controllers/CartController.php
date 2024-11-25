<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Base;
use App\Models\Shipping;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Helper;
class CartController extends Controller
{
    protected $product=null;
    protected $client;
    public function __construct(Product $product){
        $this->product=$product;
        $this->client = new Client([
            'base_uri' => 'https://nominatim.openstreetmap.org/',
        ]);
    }

    public function addToCart(Request $request){
        // dd($request->all());
        if (empty($request->slug)) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }
        $product = Product::where('slug', $request->slug)->first();
        // return $product;
        if (empty($product)) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();
        // return $already_cart;
        if($already_cart) {
            // dd($already_cart);
            $already_cart->quantity = $already_cart->quantity + 1;
            $already_cart->amount = $product->price+ $already_cart->amount;
            // return $already_cart->quantity;
            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $already_cart->save();

        }else{

            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = ($product->price-($product->price*$product->discount)/100);
            $cart->quantity = 1;
            $cart->amount=$cart->price*$cart->quantity;
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $cart->save();
            $wishlist=Wishlist::where('user_id',auth()->user()->id)->where('cart_id',null)->update(['cart_id'=>$cart->id]);
        }
        request()->session()->flash('success','Product successfully added to cart');
        return back();
    }

    public function singleAddToCart(Request $request){
        $request->validate([
            'slug'      =>  'required',
            'quant'      =>  'required',
        ]);
        // dd($request->quant[1]);


        $product = Product::where('slug', $request->slug)->first();
        if($product->stock <$request->quant[1]){
            return back()->with('error','Out of stock, You can add other products.');
        }
        if ( ($request->quant[1] < 1) || empty($product) ) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();

        // return $already_cart;

        if($already_cart) {
            $already_cart->quantity = $already_cart->quantity + $request->quant[1];
            // $already_cart->price = ($product->price * $request->quant[1]) + $already_cart->price ;
            $already_cart->amount = ($product->price * $request->quant[1])+ $already_cart->amount;

            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');

            $already_cart->save();

        }else{

            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = ($product->price-($product->price*$product->discount)/100);
            $cart->quantity = $request->quant[1];
            $cart->amount=($product->price * $request->quant[1]);
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            // return $cart;
            $cart->save();
        }
        request()->session()->flash('success','Product successfully added to cart.');
        return back();
    }

    public function cartDelete(Request $request){
        $cart = Cart::find($request->id);
        if ($cart) {
            $cart->delete();
            request()->session()->flash('success','Cart successfully removed');
            return back();
        }
        request()->session()->flash('error','Error please try again');
        return back();
    }

    public function cartUpdate(Request $request){
        // dd($request->all());
        if($request->quant){
            $error = array();
            $success = '';
            // return $request->quant;
            foreach ($request->quant as $k=>$quant) {
                // return $k;
                $id = $request->qty_id[$k];
                // return $id;
                $cart = Cart::find($id);
                // return $cart;
                if($quant > 0 && $cart) {
                    // return $quant;

                    if($cart->product->stock < $quant){
                        request()->session()->flash('error','Out of stock');
                        return back();
                    }
                    $cart->quantity = ($cart->product->stock > $quant) ? $quant  : $cart->product->stock;
                    // return $cart;

                    if ($cart->product->stock <=0) continue;
                    $after_price=($cart->product->price-($cart->product->price*$cart->product->discount)/100);
                    $cart->amount = $after_price * $quant;
                    // return $cart->price;
                    $cart->save();
                    $success = 'Cart successfully updated!';
                }else{
                    $error[] = 'Cart Invalid!';
                }
            }
            return back()->with($error)->with('success', $success);
        }else{
            return back()->with('Cart Invalid!');
        }
    }

    public function fetchLocation(Request $request) {
    
        $request->validate([
            'zipCode' => 'required',
        ]);

        $country = 'US';
        $postalCode = $request->zipCode;
        $shippingType = $request->shippingType;

        try {
            // Fetch location data using API
            $response = $this->client->get('search', [
                'query' => [
                    'postalcode' => $postalCode,
                    'country'    => $country,
                    'format'     => 'json',
                ],
                'headers' => [
                    'User-Agent' => 'Container', // Ensure this is specific to your app
                ],
            ]);
            $result = $response->getBody()->getContents();
            $location = json_decode($result, true);

            if (empty($location)) {
                return response()->json([
                    'status' => false,
                    'msg' => "Enter a valid ZIP code.",
                ]);
            }

            // Extract location data
            $locationData = $location[0];
            $destinationLat = $locationData['lat'] ?? null;
            $destinationLon = $locationData['lon'] ?? null;
            $destinationName = $locationData['display_name'] ?? 'Unknown';

            if (!$destinationLat || !$destinationLon) {
                return response()->json([
                    'status' => false,
                    'msg' => "Invalid location data received.",
                ]);
            }

            // Fetch all bases and shipping records
            $bases = Base::all();
            $shippings = Shipping::all();
            $fixedPrices = $shippings->whereIn('type', ['Fixed'])->pluck('price');
            $til_bedPrice = $shippings->whereIn('type',['til_bed'])->pluck('price');
            $flat_bedPrice = $shippings->whereIn('type',['flat_bed'])->pluck('price');

            if($shippingType === 'til_bed') {
                $PerMilePrices = $til_bedPrice->min();
            } else if($shippingType === 'flat_bed') {
                $PerMilePrices = $flat_bedPrice->min();
            } else {
                $PerMilePrices = 0;
            }
            if ($bases->isEmpty() || $shippings->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'msg' => "No shipping locations available.",
                ]);
            }

            // Calculate the shortest distance
            $shortestDistance = PHP_INT_MAX;
            $nearestBase = null;

            foreach ($bases as $base) {
                Log::info('Coordinates', [
                    'base_lat' => $base->latitude,
                    'base_lon' => $base->longitude,
                    'dest_lat' => $destinationLat,
                    'dest_lon' => $destinationLon,
                ]);

                if (!is_numeric($base->latitude) || !is_numeric($base->longitude)) {
                    Log::warning('Invalid base coordinates detected', ['base_id' => $base->id]);
                    continue; // Skip invalid base
                }

                $distance = $this->calculateDistance(
                    $base->latitude,
                    $base->longitude,
                    $destinationLat,
                    $destinationLon
                );

                Log::info('Calculated Distance', [
                    'base' => $base->cityname,
                    'distance' => $distance,
                ]);

                if ($distance < $shortestDistance) {
                    $shortestDistance = $distance;
                    $nearestBase = $base;
                }
            }

            // Determine shipping price
            $shippingPrice = $fixedPrices->min();
            // Check if distance exceeds 80 miles
            Log::info("FINAL", [
                'destination' => $destinationName,
                'depot' => $nearestBase ? $nearestBase->cityname : 'Unknown',
                'distance' => round((float)$shortestDistance, 2),
                'shippingPrice' => round((float)$shippingPrice, 2),
            ]);
            if ($shortestDistance < 80) {
                if ($fixedPrices->isNotEmpty()) {
                    // Use the minimum fixed price for distances over 80 miles
                    $shippingPrice = $fixedPrices->min();
                }
                if($shippingType === 'pickup') {
                    $shippingPrice = 0.00;
                }
            } else {
                // Use Per Mile Price for distances under 80 miles
                $shippingPrice = $shortestDistance * $PerMilePrices;
            }
            // Prepare response data
            $responseData = [
                'destination' => $destinationName,
                'depot' => $nearestBase ? $nearestBase->cityname : 'Unknown',
                'distance' => round((float)$shortestDistance, 2),
                'shippingPrice' => round((float)$shippingPrice, 2),
            ];

            return response()->json([
                'status' => true,
                'msg' => $responseData,
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching location', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'msg' => "An error occurred. Please try again.",
            ]);
        }
}

public function calculateDistance($lat1, $lon1, $lat2, $lon2)
{
    if (!is_numeric($lat1) || !is_numeric($lon1) || !is_numeric($lat2) || !is_numeric($lon2)) {
        return 0; // Return 0 for invalid inputs
    }

    $earthRadius = 3958.8; // Radius of Earth in miles

    $latDiff = deg2rad($lat2 - $lat1);
    $lonDiff = deg2rad($lon2 - $lon1);

    $a = sin($latDiff / 2) * sin($latDiff / 2) +
        cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
        sin($lonDiff / 2) * sin($lonDiff / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    return $earthRadius * $c; // Distance in miles
}



    // public function addToCart(Request $request){
    //     // return $request->all();
    //     if(Auth::check()){
    //         $qty=$request->quantity;
    //         $this->product=$this->product->find($request->pro_id);
    //         if($this->product->stock < $qty){
    //             return response(['status'=>false,'msg'=>'Out of stock','data'=>null]);
    //         }
    //         if(!$this->product){
    //             return response(['status'=>false,'msg'=>'Product not found','data'=>null]);
    //         }
    //         // $session_id=session('cart')['session_id'];
    //         // if(empty($session_id)){
    //         //     $session_id=Str::random(30);
    //         //     // dd($session_id);
    //         //     session()->put('session_id',$session_id);
    //         // }
    //         $current_item=array(
    //             'user_id'=>auth()->user()->id,
    //             'id'=>$this->product->id,
    //             // 'session_id'=>$session_id,
    //             'title'=>$this->product->title,
    //             'summary'=>$this->product->summary,
    //             'link'=>route('product-detail',$this->product->slug),
    //             'price'=>$this->product->price,
    //             'photo'=>$this->product->photo,
    //         );

    //         $price=$this->product->price;
    //         if($this->product->discount){
    //             $price=($price-($price*$this->product->discount)/100);
    //         }
    //         $current_item['price']=$price;

    //         $cart=session('cart') ? session('cart') : null;

    //         if($cart){
    //             // if anyone alreay order products
    //             $index=null;
    //             foreach($cart as $key=>$value){
    //                 if($value['id']==$this->product->id){
    //                     $index=$key;
    //                 break;
    //                 }
    //             }
    //             if($index!==null){
    //                 $cart[$index]['quantity']=$qty;
    //                 $cart[$index]['amount']=ceil($qty*$price);
    //                 if($cart[$index]['quantity']<=0){
    //                     unset($cart[$index]);
    //                 }
    //             }
    //             else{
    //                 $current_item['quantity']=$qty;
    //                 $current_item['amount']=ceil($qty*$price);
    //                 $cart[]=$current_item;
    //             }
    //         }
    //         else{
    //             $current_item['quantity']=$qty;
    //             $current_item['amount']=ceil($qty*$price);
    //             $cart[]=$current_item;
    //         }

    //         session()->put('cart',$cart);
    //         return response(['status'=>true,'msg'=>'Cart successfully updated','data'=>$cart]);
    //     }
    //     else{
    //         return response(['status'=>false,'msg'=>'You need to login first','data'=>null]);
    //     }
    // }

    // public function removeCart(Request $request){
    //     $index=$request->index;
    //     // return $index;
    //     $cart=session('cart');
    //     unset($cart[$index]);
    //     session()->put('cart',$cart);
    //     return redirect()->back()->with('success','Successfully remove item');
    // }

    public function checkout(Request $request){
        // $cart=session('cart');
        // $cart_index=\Str::random(10);
        // $sub_total=0;
        // foreach($cart as $cart_item){
        //     $sub_total+=$cart_item['amount'];
        //     $data=array(
        //         'cart_id'=>$cart_index,
        //         'user_id'=>$request->user()->id,
        //         'product_id'=>$cart_item['id'],
        //         'quantity'=>$cart_item['quantity'],
        //         'amount'=>$cart_item['amount'],
        //         'status'=>'new',
        //         'price'=>$cart_item['price'],
        //     );

        //     $cart=new Cart();
        //     $cart->fill($data);
        //     $cart->save();
        // }
        return view('frontend.pages.checkout');
    }
}
