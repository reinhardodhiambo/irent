<?php $__env->startSection('title', __('views.admin.users.show.title', ['name' => $user->name])); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <th><?php echo e(__('views.admin.users.show.table_header_0')); ?></th>
                <td><img src="<?php echo e($user->avatar); ?>" class="user-profile-image"></td>
            </tr>

            <tr>
                <th><?php echo e(__('views.admin.users.show.table_header_1')); ?></th>
                <td><?php echo e($user->name); ?></td>
            </tr>

            <tr>
                <th><?php echo e(__('views.admin.users.show.table_header_2')); ?></th>
                <td>
                    <a href="mailto:<?php echo e($user->email); ?>">
                        <?php echo e($user->email); ?>

                    </a>
                </td>
            </tr>
            <tr>
                <th><?php echo e(__('views.admin.users.show.table_header_3')); ?></th>
                <td>
                    <?php echo e($user->roles->pluck('name')->implode(',')); ?>

                </td>
            </tr>
            <tr>
                <th><?php echo e(__('views.admin.users.show.table_header_4')); ?></th>
                <td>
                    <?php if($user->active): ?>
                        <span class="label label-primary"><?php echo e(__('views.admin.users.show.active')); ?></span>
                    <?php else: ?>
                        <span class="label label-danger"><?php echo e(__('views.admin.users.show.inactive')); ?></span>
                    <?php endif; ?>
                </td>
            </tr>

            <tr>
                <th><?php echo e(__('views.admin.users.show.table_header_5')); ?></th>
                <td>
                    <?php if($user->confirmed): ?>
                        <span class="label label-success"><?php echo e(__('views.admin.users.show.confirmed')); ?></span>
                    <?php else: ?>
                        <span class="label label-warning"><?php echo e(__('views.admin.users.show.not_confirmed')); ?></span>
                    <?php endif; ?></td>
                </td>
            </tr>

            <tr>
                <th><?php echo e(__('views.admin.users.show.table_header_6')); ?></th>
                <td><?php echo e($user->created_at); ?> (<?php echo e($user->created_at->diffForHumans()); ?>)</td>
            </tr>

            <tr>
                <th><?php echo e(__('views.admin.users.show.table_header_7')); ?></th>
                <td><?php echo e($user->updated_at); ?> (<?php echo e($user->updated_at->diffForHumans()); ?>)</td>
            </tr>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>