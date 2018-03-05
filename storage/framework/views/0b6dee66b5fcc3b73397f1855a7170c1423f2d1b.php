<?php $__env->startSection('content'); ?>
    <div class="title m-b-md">
        Member area
    </div>
    <div class="m-b-md">
        <?php if($valid): ?>
            Your membership status is confirmed. All the protected pages will be accessible.
            <?php if($expires): ?>
                <br/>Your license expires on <i><?php echo e(new \Carbon\Carbon($expires)); ?></i>
            <?php endif; ?>
        <?php else: ?>
            Your membership status isn't confirmed. All the protected pages will not be accessible!
        <?php endif; ?>

        <?php if($shopUrl): ?>
            <br/><br/>
            Click <a href="<?php echo e($shopUrl); ?>">here</a> to extend or renew your membership.
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.welcome', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>