<?php $__env->startSection('body_class','passwords_email'); ?>

<?php $__env->startSection('content'); ?>
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <?php echo e(Form::open(['route' => 'password.email'])); ?>

                        <h1><?php echo e(__('views.auth.passwords.email.header')); ?></h1>

                        <div>
                            <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>"
                                   placeholder="<?php echo e(__('views.auth.passwords.email.input')); ?>" required autofocus>
                        </div>

                        <?php if(session('status')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>

                        <?php if(!$errors->isEmpty()): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $errors->first(); ?>

                            </div>
                        <?php endif; ?>

                        <div>
                            <button class="btn btn-default submit" type="submit"><?php echo e(__('views.auth.passwords.email.action')); ?></button>
                            <a class="reset_pass" href="<?php echo e(route('login')); ?>">
                                <?php echo e(__('views.auth.passwords.email.message')); ?>

                            </a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <div>
                                <div class="h1"><?php echo e(config('app.name')); ?></div>
                                <p>&copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?>. <?php echo e(__('views.auth.passwords.email.copyright')); ?></p>
                            </div>
                        </div>
                    <?php echo e(Form::close()); ?>

                </section>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##

    <?php echo e(Html::style(mix('assets/auth/css/passwords.css'))); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>