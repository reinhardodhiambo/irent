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
                    <span class="count green"><?php echo e(($counts['users'] - $counts['users_unconfirmed'])*-1); ?></span>
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

    <?php if(auth()->user()->hasRole('administrator')): ?>
    <div class="row">
        <?php $__currentLoopData = $apartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apartment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <canvas id="myChart<?php echo e($apartment->id); ?>" width="400" height="400"></canvas>
            <script>
                var ctx = document.getElementById("myChart<?php echo e($apartment->id); ?>");
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                        datasets: [{
                            label: '# of Votes',
                            data: [12, 19, 3, 5, 2, 3],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            </script>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div id="registration_usage" class="x_panel tile fixed_height_320 overflow_hidden">
                    <div class="x_title">
                        <h2><?php echo e($apartment->name); ?></h2>
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
                                    <canvas id="<?php echo e($apartment->id); ?>" class="canvasChart <?php echo e($apartment->id); ?>" height="140"
                                            width="140" style="margin: 15px 10px 10px 0">
                                    </canvas>

                                </td>
                                <td>
                                    <table class="tile_info">
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square aero"></i>
                                                    <span class="tile_label">
                                                     Empty Houses
                                                </span>
                                                </p>
                                            </td>
                                            <td><?php echo e($apartment->vacant); ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square red"></i>
                                                    <span class="tile_label">
                                                    Occupied Houses
                                                </span>
                                                </p>
                                            </td>
                                            <td><?php echo e($apartment->occupied); ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square blue"></i>
                                                    <span class="tile_label">
                                                    Total Houses
                                                </span>
                                                </p>
                                            </td>
                                            <td><?php echo e($apartment->total_houses); ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>






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