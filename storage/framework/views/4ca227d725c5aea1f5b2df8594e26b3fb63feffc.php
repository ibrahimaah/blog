<nav class="navbar navbar-expand-lg navbar-light mb-5">
    <a class="navbar-brand" href="/"><strong>Blog</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse nav-div-ul" id="navbarSupportedContent">
        <ul class="navbar-nav w-100 nav-ul">

            <li class="nav-item <?php echo e(Request::is('/') ? 'active' : ''); ?>">
                <a class="nav-link" href="/">Home</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="nav_menu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                </a>
                <div class="dropdown-menu dropdown-menu-right"aria-labelledby="nav_menu">
                <?php ($categories = App\Category::all()); ?>
                <?php if(isset($categories)): ?>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="dropdown-item" href="<?php echo e(route('postsByCat',$category->id)); ?>">
                            <?php echo e($category->name); ?>

                        </a> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                </div>
            </li>

            <li class="nav-item <?php echo e(Request::is('about') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('about')); ?>">About </a>
            </li>

            <li class="nav-item <?php echo e(Request::is('contact') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('contact')); ?>">Contact</a>
            </li>
    
            <li class="nav-item dropdown list-right">

                <a class="nav-link dropdown-toggle"
                    href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    Hello <?php echo e(Auth::user()->name ?? 'guest'); ?>


                </a>

                <div class="dropdown-menu dropdown-menu-right"
                     aria-labelledby="navbarDropdownMenuLink">

                <?php if(Auth::check()): ?>
                   <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('do-every-thing')): ?>
                        <a class="dropdown-item" href="<?php echo e(route('posts.index')); ?>">
                            Posts
                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('categories.index')); ?>">
                            Categories
                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('tags.index')); ?>">
                            Tags
                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('comments.index')); ?>">
                            Comments
                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('users.index')); ?>">
                            Users
                        </a>
                    <?php endif; ?>
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">
                            LogOut
                        </a>
                    <?php else: ?>
                        <a class="dropdown-item" href="<?php echo e(route('login')); ?>">
                            Login
                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('register')); ?>">
                            Sign Up
                        </a>
                <?php endif; ?>
                    
                </div>
            </li>
        </ul>   
    </div>
</nav> <?php /**PATH C:\xampp\htdocs\Blog\resources\views/partials/_nav.blade.php ENDPATH**/ ?>