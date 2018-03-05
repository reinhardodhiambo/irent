<?php $__env->startSection('title', __('views.admin.users.index.title')); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="login_wrapper">
            <div class="animate form">
                <section class="login_content">
                    <form method="post" action="<?php echo e(url('admin/addCaretaker')); ?>">
                    <h1>New Caretaker</h1>
                        <?php echo e(csrf_field()); ?>

                    <div>
                        <input type="text" name="name" class="form-control"
                               placeholder="<?php echo e(__('views.auth.register.input_0')); ?>"
                               value="<?php echo e(old('name')); ?>" required autofocus/>
                    </div>
                    <div>
                        <input type="email" name="email" class="form-control"
                               placeholder="<?php echo e(__('views.auth.register.input_1')); ?>"
                               required/>
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control"
                               placeholder="<?php echo e(__('views.auth.register.input_2')); ?>"
                               required=""/>
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="<?php echo e(__('views.auth.register.input_3')); ?>"
                               required/>
                    </div>

                    <div>
                        <button type="submit"
                                class="btn btn-default submit">Add
                        </button>
                    </div>

                    </form>
                </section>
            </div>
        </div>

    </div>
    <div class="row">
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('email', __('views.admin.users.index.table_header_0'),['page' =>
                    $users->currentPage()]));?>
                </th>
                <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('confirmed', __('views.admin.users.index.table_header_4'),['page' =>
                    $users->currentPage()]));?>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php if($user->hasRole('caretaker')): ?>
                    <tr>
                        <td><?php echo e($user->email); ?></td>
                        <td>
                            <?php if($user->confirmed): ?>
                                <span class="label label-success"><?php echo e(__('views.admin.users.index.confirmed')); ?></span>
                            <?php else: ?>
                                <span class="label label-warning"><?php echo e(__('views.admin.users.index.not_confirmed')); ?></span>
                            <?php endif; ?></td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.users.show', [$user->id])); ?>"
                               data-toggle="tooltip" data-placement="top"
                               data-title="<?php echo e(__('views.admin.users.index.show')); ?>">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.users.edit', [$user->id])); ?>"
                               data-toggle="tooltip" data-placement="top"
                               data-title="<?php echo e(__('views.admin.users.index.edit')); ?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <?php if(!$user->hasRole('administrator')): ?>
                                <a class="btn btn-xs btn-danger user_destroy"
                                        href="<?php echo e(route('admin.user.delete', [$user->id])); ?>" data-toggle="tooltip"
                                        data-placement="top" data-title="<?php echo e(__('views.admin.users.index.delete')); ?>">
                                    <i class="fa fa-trash"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="pull-right">
            <?php echo e($users->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>