

<?php $__env->startSection('main-content'); ?>
<div class="container-fluid">
    <?php echo $__env->make('user.layouts.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    

    <!-- Content Row -->

    <div class="row">
      <?php
          $orders=DB::table('orders')->where('user_id',auth()->user()->id)->paginate(10);
      ?>
      <!-- Order -->
      <div class="col-xl-12 col-lg-12">
        <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Order No.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Quantity</th>
              <th>Total Amount</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Order No.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Quantity</th>
              <th>Total Amount</th>
              <th>Status</th>
              <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            <?php if(count($orders)>0): ?>
              <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
                <tr>
                    <td><?php echo e($order->id); ?></td>
                    <td><?php echo e($order->order_number); ?></td>
                    <td><?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?></td>
                    <td><?php echo e($order->email); ?></td>
                    <td><?php echo e($order->quantity); ?></td>
                    <td>$<?php echo e(number_format($order->total_amount,2)); ?></td>
                    <td>
                        <?php if($order->status=='new'): ?>
                          <span class="badge badge-primary"><?php echo e($order->status); ?></span>
                        <?php elseif($order->status=='process'): ?>
                          <span class="badge badge-warning"><?php echo e($order->status); ?></span>
                        <?php elseif($order->status=='delivered'): ?>
                          <span class="badge badge-success"><?php echo e($order->status); ?></span>
                        <?php else: ?>
                          <span class="badge badge-danger"><?php echo e($order->status); ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('user.order.show',$order->id)); ?>" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
                        <form method="POST" action="<?php echo e(route('user.order.delete',[$order->id])); ?>">
                          <?php echo csrf_field(); ?> 
                          <?php echo method_field('delete'); ?>
                              <button class="btn btn-danger btn-sm dltBtn" data-id=<?php echo e($order->id); ?> style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>  
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
                <td colspan="8" class="text-center"><h4 class="my-4">You have no order yet!! Please order some products</h4></td>
              <?php endif; ?>
          </tbody>
        </table>

        <?php echo e($orders->links()); ?>

      </div>
    </div>

  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
  const url = "<?php echo e(route('product.order.income')); ?>";

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Area Chart Example
var ctx = document.getElementById("myAreaChart");

axios.get(url)
            .then(function (response) {
              const data_keys = Object.keys(response.data);
              const data_values = Object.values(response.data);


var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: data_keys, //["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Earnings",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: data_values, //[0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 44660],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '$' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});











            })
            .catch(function (error) {
            //   vm.answer = 'Error! Could not reach the API. ' + error
            console.log(error)
            });





  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('user.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\resources\views/user/index.blade.php ENDPATH**/ ?>