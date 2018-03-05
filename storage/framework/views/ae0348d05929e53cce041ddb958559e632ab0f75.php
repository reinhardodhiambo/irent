<?php $__env->startSection('title', __('views.membership.title')); ?>

<?php $__env->startSection('content'); ?>

    <?php if(auth()->user()->hasRole('administrator')): ?>
    <div class="row">
        <div class="login_wrapper">
            <div class="animate form">
                <section class="login_content">
                    <?php echo e(Form::open(['route' => 'admin.apartmentstore'])); ?>

                    <form><h1>New Apartment</h1>
                        <div>
                            <input type="text" name="name" class="form-control"
                                   placeholder="name"
                                   value="<?php echo e(old('name')); ?>" required autofocus/>
                        </div>
                        <div>
                            <input type="text" name="description" class="form-control"
                                   placeholder="description"
                                   required/>
                        </div>
                        <div>
                            <input type="text" name="location" class="form-control"
                                   placeholder="location"
                                   required/>
                        </div>
                        <div>
                            <button type="submit"
                                    class="btn btn-default submit">Add
                            </button>
                        </div>
                    </form>

                    <?php echo e(Form::close()); ?>

                </section>
            </div>
        </div>

    </div>
    <?php endif; ?>

    <div class="row">
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', 'Name',['page' => $apartments->currentPage()]));?></th>
                <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('description', 'Description',['page' => $apartments->currentPage()]));?></th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $apartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apartment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($apartment->id); ?></td>
                    <td><?php echo e($apartment->name); ?></td>
                    <td><?php echo e($apartment->description); ?></td>
                    <td><?php echo e($apartment->location); ?></td>
                    <td>

                        <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.apartments.show', [$apartment->id])); ?>"
                           data-toggle="tooltip" data-placement="top"
                           data-title="<?php echo e(__('views.admin.users.index.show')); ?>">
                            <i class="fa fa-eye"></i>
                        </a>
                        <?php if(auth()->user()->hasRole('administrator')): ?>
                            <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.apartment.edit', [$apartment->id])); ?>"
                               data-toggle="tooltip" data-placement="top"
                               data-title="<?php echo e(__('views.admin.users.index.edit')); ?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="btn btn-xs btn-danger"
                               href="<?php echo e(route('admin.apartments.delete', [$apartment->id])); ?>"
                               data-toggle="tooltip" data-placement="top"
                               data-title="delete">
                                <i class="fa fa-trash"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="pull-right">
            <?php echo e($apartments->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>