<?php $__env->startSection('content'); ?>
    <!-- page content -->
    <!-- top tiles -->
    <?php if(auth()->user()->hasRole('administrator')): ?>
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-users"></i> <?php echo e(__('views.admin.dashboard.count_0')); ?></span>
                <div class="count green"><?php echo e($counts['users']); ?></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i
                            class="fa fa-address-card"></i> <?php echo e(__('views.admin.dashboard.count_1')); ?></span>
                <div>
                    <span class="count green"><?php echo e($counts['users'] - $counts['users_unconfirmed']); ?></span>
                    <span class="count">/</span>
                    <span class="count red"><?php echo e($counts['users_unconfirmed']); ?></span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i
                            class="fa fa-user-times "></i> <?php echo e(__('views.admin.dashboard.count_2')); ?></span>
                <div>
                    <span class="count green"><?php echo e($counts['users'] - $counts['users_inactive']); ?></span>
                    <span class="count">/</span>
                    <span class="count red"><?php echo e($counts['users_inactive']); ?></span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-lock"></i> <?php echo e(__('views.admin.dashboard.count_3')); ?></span>
                <div>
                    <span class="count green"><?php echo e($counts['protected_pages']); ?></span>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- /top tiles -->


    <br/>

    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div id="registration_usage" class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                    <h2><?php echo e(__('views.admin.dashboard.sub_title_2')); ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                <i class="fa fa-wrench"></i>
                            </a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="" style="width:100%">
                        <tr>
                            <th></th>
                            <th>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <p class=""><?php echo e(__('views.admin.dashboard.sub_title_3')); ?></p>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                    <p class=""><?php echo e(__('views.admin.dashboard.sub_title_4')); ?></p>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <canvas class="canvasChart" height="140" width="140" style="margin: 15px 10px 10px 0">
                                </canvas>
                            </td>
                            <td>
                                <table class="tile_info">
                                    <tr>
                                        <td>
                                            <p><i class="fa fa-square aero"></i>
                                                <span class="tile_label">
                                                     <?php echo e(__('views.admin.dashboard.source_0')); ?>

                                                </span>
                                            </p>
                                        </td>
                                        <td id="registration_usage_from"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><i class="fa fa-square red"></i>
                                                <span class="tile_label">
                                                    <?php echo e(__('views.admin.dashboard.source_1')); ?>

                                                </span>
                                            </p>
                                        </td>
                                        <td id="registration_usage_google"></td>
                                    </tr>
                                    <?php if(auth()->user()->hasRole('administrator')): ?>
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square blue"></i>
                                                    <span class="tile_label">
                                                    <?php echo e(__('views.admin.dashboard.source_2')); ?>

                                                </span>
                                                </p>
                                            </td>
                                            <td id="registration_usage_facebook"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square grren"></i>
                                                    <span class="tile_label">
                                                     <?php echo e(__('views.admin.dashboard.source_3')); ?>

                                                </span>
                                                </p>
                                            </td>
                                            <td id="registration_usage_twitter"></td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <?php echo e(Html::script(mix('assets/admin/js/dashboard.js'))); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
    <?php echo e(Html::style(mix('assets/admin/css/dashboard.css'))); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>