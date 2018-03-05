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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>