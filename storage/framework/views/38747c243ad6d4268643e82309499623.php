<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php $dep = $depth-1; ?>
<div class="display-comment"   <?php if($comment->parent_id != null): ?> style="margin-left:40px;" <?php endif; ?>>
    <div class="comment-list">
        <div class="single-comment">
            <?php if($comment->user_info['photo']): ?>
                <img src="<?php echo e($comment->user_info['photo']); ?>" alt="#">
            <?php else: ?> 
                <img src="<?php echo e(asset('backend/img/avatar.png')); ?>" alt="">
            <?php endif; ?>
            <div class="content">
                
            <h4><?php echo e($comment->user_info['name']); ?> <span>At <?php echo e($comment->created_at->format('g: i a')); ?> On <?php echo e($comment->created_at->format('M d Y')); ?></span></h4>
                <p><?php echo e($comment->comment); ?></p>
                <?php if($dep): ?>
                <div class="button">
                    <a href="#" class="btn btn-reply reply" data-id="<?php echo e($comment->id); ?>"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
                    <a href="" class="btn btn-reply cancel" style="display: none;" ><i class="fa fa-trash" aria-hidden="true"></i>Cancel</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php echo $__env->make('frontend.pages.comment', ['comments' => $comment->replies, 'depth' => $dep], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>    
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH E:\work\study\Complete-Ecommerce-in-laravel-10\resources\views/frontend/pages/comment.blade.php ENDPATH**/ ?>