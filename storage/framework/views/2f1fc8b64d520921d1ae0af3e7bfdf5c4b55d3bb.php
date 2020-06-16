<?php $__env->startSection('title',' Login'); ?>

<?php $__env->startSection('style'); ?>
<style>
.or{
    display: block;
    margin: 0 0 15px 0;
    padding: 30px 0 0;
    text-align: center;
    color: #999;
    cursor: default;
}
.or small{
    font-size: 14px;
    line-height: 1.4em;
}
.test button{
    
    background: none;
    border: 1px solid #999;
    border-radius: 50%;
    width: 91px;
    height: 91px;
    margin: 0 auto;
    padding: 15px;
    text-align: center;
    opacity: .5;
    -webkit-transition: all .2s ease;
    -moz-transition: all .2s ease;
    transition: all .2s ease;
}

.test button:hover{
    background: #fff;
    border-color: #666;
    text-decoration: none;
    opacity: 1;
}
.test button small{
    display:none;
    transition: all .2s ease;
}
.test button:hover small{
    display:block;
}
.card{
    height:400px;
}
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Login')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">

                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!--<div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                    <label class="form-check-label" for="remember">
                                        <?php echo e(__('Remember Me')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>-->

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Login')); ?>

                                </button>

                                <?php if(Route::has('password.request')): ?>
                                    <!--<a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                        <?php echo e(__('Forgot Your Password?')); ?>

                                    </a>-->
                                <?php endif; ?>
                                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger"><< Back</a>
                            </div>
                        </div>
                    </form>
                </div>
                
                <p class="or">
                    <small>or sign in with...</small>
                </p>

                <div class="text-center d-flex justify-content-center mb-4">
                    <div class="test mr-4">
                        <a href="<?php echo e(url('auth/facebook')); ?>">
                            <button class="auth-facebook-lnk" 
                                    title="Sign up with your Facebook account"
                                    type="submit">
                                <img src="<?php echo e(asset('img/facebook.svg')); ?>" width="32" height="32">
                                <small>Facebook</small>
                            </button>
                        </a>
                    </div>
                    <div class="test">
                        <button class="auth-facebook-lnk" 
                                title="Sign up with your Gmail account"
                                type="submit">
                            <img src="<?php echo e(asset('img/google.svg')); ?>" width="32" height="32">
                            <small>Google</small>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/auth/login.blade.php ENDPATH**/ ?>