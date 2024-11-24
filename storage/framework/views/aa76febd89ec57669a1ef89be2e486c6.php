<?php $__env->startSection('title','E-SHOP || Brand Create'); ?>
<?php $__env->startSection('main-content'); ?>

<div class="card">
    <h5 class="card-header">Add Base</h5>
    <div class="card-body">
      <form method="post" action="<?php echo e(route('brand.store')); ?>">
        <?php echo e(csrf_field()); ?>


        <div class="form-group">
            <label for="inputTitle" class="col-form-label">ZipCord<span class="text-danger">*</span></label>
            <input id="zip" type="text" name="zip" placeholder="Enter zip"  value="" class="form-control" require>
            <button class="btn btn-success" id="zip_button" >Add</button>
        </div>

        <div class="form-group">
        <label for="inputTitle" class="col-form-label">City Name <span class="text-danger">*</span></label>
        <input id="cityname" type="text" name="cityname" placeholder="Enter cityname"  value="" class="form-control">
        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="inputTitle" class="col-form-label">Latitude <span class="text-danger">*</span></label>
            <input id="latitude" type="text" name="latitude" placeholder="Enter title"  value="" class="form-control" require>
        </div>

        <div class="form-group">
            <label for="inputTitle" class="col-form-label">Longitude <span class="text-danger">*</span></label>
            <input id="longitude" type="text" name="longitude" placeholder="Enter title"  value="" class="form-control" require>
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-danger"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button id="" class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/summernote/summernote.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="<?php echo e(asset('backend/summernote/summernote.min.js')); ?>"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });


    });

    $(document).ready(function () {
        $('#zip_button').click(function (e) {
            e.preventDefault(); // Prevent the default form submission

            let postalCode = $('#zip').val();
            let country = 'US'; // You can make this dynamic if needed

            if (postalCode) {
                $.ajax({
                    url: "<?php echo e(route('brand.getLocation')); ?>", // Route to call your controller method
                    type: "GET",
                    data: {
                        postalCode: postalCode,
                        country: country
                    },
                    success: function (response) {
                        // Populate fields with the response data
                        $('#latitude').val(response.lat);
                        $('#longitude').val(response.lon);
                        $('#cityname').val(response.cityname);
                        console.log(response.total);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        alert('Failed to fetch location. Please check the ZIP code and try again.');
                    }
                });
            } else {
                alert('Please enter a ZIP code.');
            }
        });
    });



</script>

<style>
    #zip_button {
        margin-top: 15px;
        width: 90px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\resources\views/backend/brand/create.blade.php ENDPATH**/ ?>