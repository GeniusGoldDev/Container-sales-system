<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Base;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://nominatim.openstreetmap.org/',
        ]);
    }

    public function getLocation(Request $request)
    {
        $postalCode = $request->input('postalCode');
        $country = $request->input('country', 'US'); // Default to US if not provided

        $response = $this->client->get('search', [
            'query' => [
                'postalcode' => $postalCode,
                'country' => $country,
                'format' => 'json',
            ],
            'headers' => [
                'User-Agent' => 'Container' // Ensure this is specific to your app
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        if (!empty($result) && isset($result[0])) {
            $location = [
                'lat' => $result[0]['lat'],
                'lon' => $result[0]['lon'],
                'cityname' => $result[0]['display_name'], // Adjust as per OpenStreetMap response
                'total' => $result[0],
            ];
            return response()->json($location);
        } else {
            return response()->json(['error' => 'Location not found.'], 404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand=Brand::orderBy('id','DESC')->paginate();
        return view('backend.brand.index')->with('brands',$brand);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $this->validate($request,[
    //         'title'=>'string|required',
    //     ]);
    //     $data=$request->all();
    //     dd($data);
    //     $slug=Str::slug($request->title);
    //     $count=Brand::where('slug',$slug)->count();
    //     if($count>0){
    //         $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
    //     }
    //     $data['slug']=$slug;
    //     // return $data;
    //     $status=Brand::create($data);
    //     if($status){
    //         request()->session()->flash('success','Brand successfully created');
    //     }
    //     else{
    //         request()->session()->flash('error','Error, Please try again');
    //     }
    //     return redirect()->route('brand.index');
    // }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cityname' => 'string|required',
            'latitude' => 'numeric|required',
            'longitude' => 'numeric|required',
        ]);

        $data = $request->only(['cityname', 'latitude', 'longitude', 'status']);

        $base = Base::create($data);

        if($base) {
            return redirect()->route('brand.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand=Brand::find($id);
        if(!$brand){
            request()->session()->flash('error','Brand not found');
        }
        return view('backend.brand.edit')->with('brand',$brand);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brand=Brand::find($id);
        $this->validate($request,[
            'title'=>'string|required',
        ]);
        $data=$request->all();

        $status=$brand->fill($data)->save();
        if($status){
            request()->session()->flash('success','Brand successfully updated');
        }
        else{
            request()->session()->flash('error','Error, Please try again');
        }
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand=Brand::find($id);
        if($brand){
            $status=$brand->delete();
            if($status){
                request()->session()->flash('success','Brand successfully deleted');
            }
            else{
                request()->session()->flash('error','Error, Please try again');
            }
            return redirect()->route('brand.index');
        }
        else{
            request()->session()->flash('error','Brand not found');
            return redirect()->back();
        }
    }
}
