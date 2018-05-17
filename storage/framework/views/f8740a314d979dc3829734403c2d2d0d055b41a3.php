<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="site_title">
                <span><?php echo e(config('app.name')); ?></span>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?php echo e(auth()->user()->avatar); ?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <?php if(auth()->user()->hasRole('administrator')): ?>
                    <h2>LANDLORD:</h2>
                <?php elseif(auth()->user()->hasRole('caretaker')): ?>
                    <h2>CARETAKER:</h2>
                <?php else: ?>
                    <h2>TENANT:</h2>
                <?php endif; ?>
                <h2><?php echo e(auth()->user()->name); ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <?php if(auth()->user()->hasRole('administrator')): ?>
                <div class="menu_section">
                    <h3><?php echo e(__('views.backend.section.navigation.sub_header_0')); ?></h3>
                    <ul class="nav side-menu">
                        <li>
                            <a href="<?php echo e(route('admin.dashboard')); ?>">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <?php echo e(__('views.backend.section.navigation.menu_0_1')); ?>

                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('admin.kra')); ?>">
                                <i class="fa fa-percent" aria-hidden="true"></i>
                                KRA
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="menu_section">
                <h3><?php echo e(__('views.backend.section.navigation.sub_header_1')); ?></h3>
                <ul class="nav side-menu">
                    <?php if(auth()->user()->hasRole('administrator')): ?>
                        <li>
                            <a href="<?php echo e(route('admin.users')); ?>">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <?php echo e(__('views.backend.section.navigation.menu_1_1')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="<?php echo e(route('admin.apartments')); ?>">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            <?php echo e(__('views.backend.section.navigation.menu_1_2')); ?>

                        </a>
                    </li>
                    <?php if(auth()->user()->hasRole('authenticated')): ?>
                        <li>
                            <a href="<?php echo e(route('admin.receipts')); ?>">
                                <i class="fa fa-file" aria-hidden="true"></i>
                                Receipts
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->
    </div>
</div>
