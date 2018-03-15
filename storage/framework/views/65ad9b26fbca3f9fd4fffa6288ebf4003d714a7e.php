<?php $__env->startSection('title', __('views.admin.users.show.title', ['name' => $house->house_number])); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody>

            <tr>
                <th>House Number</th>
                <td><?php echo e($house->house_number); ?></td>
            </tr>

            <tr>
                <th>Bedroom</th>
                <td>
                    <?php echo e($house->bedroom); ?>

                </td>
            </tr>
            <tr>
                <th>Bathroom</th>
                <td>
                    <?php echo e($house->bathroom); ?>

                </td>
            </tr>
            <tr>
                <th>Kitchen</th>
                <td>
                    <?php echo e($house->kitchen); ?>

                </td>
            </tr>
            <tr>
                <th>Restroom</th>
                <td>
                    <?php echo e($house->toilet); ?>

                </td>
            </tr>
            <tr>
                <th>Balcony</th>
                <td>
                    <?php echo e($house->balcony); ?>

                </td>
            </tr>
            <tr>
                <th>Floor</th>
                <td>
                    <?php echo e($house->floor); ?>

                </td>
            </tr>

            <tr>
                <th>Price</th>
                <td>
                    <?php echo e($house->price); ?>

                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td> <?php if(!isset($house->UserHouse->user_id)): ?><span class="label label-warning">Vacant</span>
                    <?php else: ?>
                        <span class="label label-success">Not Vacant</span>
                    <?php endif; ?></td>
            </tr>

            <tr>
                <th>Created At</th>
                <td><?php echo e($house->created_at); ?> (<?php echo e($house->created_at->diffForHumans()); ?>)</td>
            </tr>

            <tr>
                <th>Update At</th>
                <td><?php echo e($house->updated_at); ?> (<?php echo e($house->updated_at->diffForHumans()); ?>)</td>
            </tr>
            </tbody>
        </table>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lk">Add Tenant
    </button>

    <div class="modal fade bs-example-modal-lk" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Add Tenant</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="login_wrapper">
                            <div class="animate form">
                                <section class="login_content">
                                    <?php echo e(Form::open(array('route' => array('admin.house.rent',Request::route('house'))))); ?>

                                    <form><h1>Rent</h1>
                                        <div>
                                            <input type="text" name="national_id" class="form-control"
                                                   placeholder="national_id"
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