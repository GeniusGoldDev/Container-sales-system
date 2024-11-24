<div id="notifications">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <span class="badge badge-danger badge-counter">
            <?php if(count(Auth::user()->unreadNotifications) >5 ): ?><span data-count="5" class="count">5+</span>
            <?php else: ?> 
                <span class="count" data-count="<?php echo e(count(Auth::user()->unreadNotifications)); ?>"><?php echo e(count(Auth::user()->unreadNotifications)); ?></span>
            <?php endif; ?>
        </span>
      </a>
      <!-- Dropdown - Alerts -->
      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
          Notifications Center
        </h6>
        <?php $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a class="dropdown-item d-flex align-items-center" target="_blank" href="<?php echo e(route('admin.notification',$notification->id)); ?>">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                    <i class="fas <?php echo e($notification->data['fas']); ?> text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500"><?php echo e($notification->created_at->format('F d, Y h:i A')); ?></div>
                    <span class="<?php if($notification->unread()): ?> font-weight-bold <?php else: ?> small text-gray-500 <?php endif; ?>"><?php echo e($notification->data['title']); ?></span>
                </div>
            </a>
            <?php if($loop->index+1==5): ?>
                <?php 
                    break;
                ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <a class="dropdown-item text-center small text-gray-500" href="<?php echo e(route('all.notification')); ?>">Show All Notifications</a>
      </div>
</div><?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\resources\views/backend/notification/show.blade.php ENDPATH**/ ?>