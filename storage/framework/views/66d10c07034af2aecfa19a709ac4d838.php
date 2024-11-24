<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissable fade show">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>


<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissable fade show">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?><?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\resources\views/backend/layouts/notification.blade.php ENDPATH**/ ?>