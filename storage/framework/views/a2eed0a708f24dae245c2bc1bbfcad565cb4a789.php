<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <div class="nav toggle">
                <a id="menu_toggle" href="<?php echo e(URL::previous()); ?>"><i class="fa fa-arrow-left"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="true">
                        <?php if(auth()->user()->hasRole('administrator')): ?>
                            <h6>LANDLORD:</h6>
                        <?php elseif(auth()->user()->hasRole('caretaker')): ?>
                            <h6>CARETAKER:</h6>
                        <?php else: ?>
                            <h6>TENANT:</h6>
                        <?php endif; ?>
                        <img src="<?php echo e(auth()->user()->avatar); ?>" alt=""><?php echo e(auth()->user()->name); ?>

                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li>
                            <a href="<?php echo e(route('logout')); ?>">
                                <i class="fa fa-sign-out pull-right"></i> <?php echo e(__('views.backend.section.header.menu_0')); ?>

                            </a>
                        </li>
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                       aria-expanded="true">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green"><?php echo e(count(\App\Notification::get_notifications())); ?></span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <?php $__currentLoopData = \App\Notification::get_notifications(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a>
                                    
                                    <span>
                          <span><?php echo e($notification->user_name); ?></span>
                                        
                        </span>
                                    <span class="message">
                          <?php echo e($notification->message); ?>

                        </span>
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <div class="text-center">
                                <a href="<?php echo e(route('admin.notifications')); ?>">
                                    <strong>See All Notifications</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>