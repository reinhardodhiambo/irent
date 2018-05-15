<?php $__env->startSection('title', __('views.admin.users.show.title', ['name' => 'Payment'])); ?>

<?php $__env->startSection('content'); ?>

    <?php if(auth()->user()->hasRole('authenticated')): ?>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Add
            Payments
        </button>
    <?php endif; ?>

    <div class="row" style=" margin-top: 91px;">
        <?php echo e(Form::open(array('route' => array('admin.payments.search',Request::route('apartment_id'))))); ?>

        <div style="background: #878688;padding:2%; margin-bottom: 2%">
            <form><h5 style="color:black">Search</h5>
                
                <div style="margin-bottom: 2%">
                    <input type="text" name="date" class="form-control"
                           placeholder="Date"
                    />
                </div>
                <div>
                    <button type="submit"
                            class="btn btn-default submit">Search
                    </button>
                </div>
            </form>
        </div>

        <?php echo e(Form::close()); ?>



        <?php if(count($payments)>0): ?>
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>House Number</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($payment->house->house_number); ?></td>
                        <td> <?php if($payment->status==0): ?><h4><span class="label label-warning">Unpaid</span></h4>
                            <?php else: ?>
                                <h4><span class="label label-success">Paid</span></h4>
                            <?php endif; ?></td>
                        <td><?php echo e($payment->created_at); ?></td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.payment.show', [$payment->id])); ?>"
                               data-toggle="tooltip" data-placement="top"
                               data-title="<?php echo e(__('views.admin.users.index.show')); ?>">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <h3>No Payments</h3>
        <?php endif; ?>

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
                                    <?php echo e(Form::open(array('route' => array('admin.paymentstore',auth()->user()->id, Request::route('apartment_id')), 'files' => true))); ?>

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
                                            <input type="file" class="form-control" name="photos[]" multiple/>
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