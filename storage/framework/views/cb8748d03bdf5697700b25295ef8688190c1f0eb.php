<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-fw fa-flag"></i> Levels</div>
    <ul class="list-group">
        <?php $__currentLoopData = $log->menu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($item['count'] === 0): ?>
                <a href="#" class="list-group-item disabled">
                    <span class="badge">
                        <?php echo e($item['count']); ?>

                    </span>
                    <?php echo $item['icon']; ?> <?php echo e($item['name']); ?>

                </a>
            <?php else: ?>
                <a href="<?php echo e($item['url']); ?>" class="list-group-item <?php echo e($level); ?>">
                    <span class="badge level-<?php echo e($level); ?>">
                        <?php echo e($item['count']); ?>

                    </span>
                    <span class="level level-<?php echo e($level); ?>">
                        <?php echo $item['icon']; ?> <?php echo e($item['name']); ?>

                    </span>
                </a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
