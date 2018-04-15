<?php $__env->startSection('title', __('views.admin.users.show.title', ['name' => 'Payment'])); ?>

<?php $__env->startSection('content'); ?>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Add Payments
        </button>

    <div class="row">
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($payment->name); ?></td>
                    <td><?php echo e($payment->description); ?></td>
                    <td><?php echo e($payment->amount); ?></td>
                    <td>

                        <a class="btn btn-xs btn-primary" href=""
                           data-toggle="tooltip" data-placement="top"
                           data-title="<?php echo e(__('views.admin.users.index.show')); ?>">
                            <i class="fa fa-eye"></i>
                        </a>
                        <?php if(auth()->user()->hasRole('administrator')): ?>
                            <a class="btn btn-xs btn-info" href=""
                               data-toggle="tooltip" data-placement="top"
                               data-title="<?php echo e(__('views.admin.users.index.edit')); ?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="btn btn-xs btn-danger" href=""
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
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">New Payment</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="login_wrapper">
                            <div class="animate form">
                                <section class="login_content">
                                    <?php echo e(Form::open(array('route' => array('admin.paymentstore',auth()->user()->id,Request::route('apartment_id'))))); ?>

                                    <form><h1>New Payment</h1>
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
                                            <input type="text" name="amount" class="form-control"
                                                   placeholder="amount"
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

                </div>
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>