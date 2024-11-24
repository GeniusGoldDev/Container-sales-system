<div class="m-3 d-block d-lg-none">
  <h1 style="font-size: 1.5rem;">Laravel File Manager</h1>
  <small class="d-block">Ver 2.0</small>
  <div class="row mt-3">
    <div class="col-4">
      <img src="<?php echo e(asset('vendor/laravel-filemanager/img/152px color.png')); ?>" class="w-100">
    </div>

    <div class="col-8">
      <p>Current usage :</p>
      <p>20 GB (Max : 1 TB)</p>
    </div>
  </div>
  <div class="progress mt-3" style="height: .5rem;">
    <div class="progress-bar progress-bar-striped progress-bar-animated w-75 bg-main" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
</div>

<ul class="nav nav-pills flex-column">
  <?php $__currentLoopData = $root_folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $root_folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="nav-item">
      <a class="nav-link" href="#" data-type="0" data-path="<?php echo e($root_folder->url); ?>">
        <i class="fa fa-folder fa-fw"></i> <?php echo e($root_folder->name); ?>

      </a>
    </li>
    <?php $__currentLoopData = $root_folder->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $directory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="nav-item sub-item">
      <a class="nav-link" href="#" data-type="0" data-path="<?php echo e($directory->url); ?>">
        <i class="fa fa-folder fa-fw"></i> <?php echo e($directory->name); ?>

      </a>
    </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\vendor\unisharp\laravel-filemanager\src/views/tree.blade.php ENDPATH**/ ?>