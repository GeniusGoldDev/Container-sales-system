
<?php $__env->startSection('main-content'); ?>
<div class="card">
  <h5 class="card-header">Message</h5>
  <div class="card-body">
    <?php if($message): ?>
        <?php if($message->photo): ?>
        <img src="<?php echo e($message->photo); ?>" class="rounded-circle " style="margin-left:44%;">
        <?php else: ?> 
        <img src="<?php echo e(asset('backend/img/avatar.png')); ?>" class="rounded-circle " style="margin-left:44%;">
        <?php endif; ?>
        <div class="py-4">From: <br>
           Name :<?php echo e($message->name); ?><br>
           Email :<?php echo e($message->email); ?><br>
           Phone :<?php echo e($message->phone); ?>

        </div>
        <hr/>
  <h5 class="text-center" style="text-decoration:underline"><strong>Subject :</strong> <?php echo e($message->subject); ?></h5>
        <p class="py-5"><?php echo e($message->message); ?></p>

    <?php endif; ?>

  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\resources\views/backend/message/show.blade.php ENDPATH**/ ?>