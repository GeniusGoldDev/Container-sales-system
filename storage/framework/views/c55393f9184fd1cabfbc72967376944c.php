

<?php $__env->startSection('title','Comment Edit'); ?>

<?php $__env->startSection('main-content'); ?>
<div class="card">
  <h5 class="card-header">Comment Edit</h5>
  <div class="card-body">
    <form action="<?php echo e(route('comment.update',$comment->id)); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PATCH'); ?>
      <div class="form-group">
        <label for="name">By:</label>
        <input type="text" disabled class="form-control" value="<?php echo e($comment->user_info->name); ?>">
      </div>
      <div class="form-group">
        <label for="comment">comment</label>
      <textarea name="comment" id="" cols="20" rows="10" class="form-control"><?php echo e($comment->comment); ?></textarea>
      </div>
      <div class="form-group">
        <label for="status">Status :</label>
        <select name="status" id="" class="form-control">
          <option value="">--Select Status--</option>
          <option value="active" <?php echo e((($comment->status=='active')? 'selected' : '')); ?>>Active</option>
          <option value="inactive" <?php echo e((($comment->status=='inactive')? 'selected' : '')); ?>>Inactive</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\resources\views/backend/comment/edit.blade.php ENDPATH**/ ?>