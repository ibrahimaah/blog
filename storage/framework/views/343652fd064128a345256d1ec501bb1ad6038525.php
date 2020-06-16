
<?php if(session('success')): ?> 
    <div class="alert alert-success">
        <strong>Success!</strong> <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/partials/_messages.blade.php ENDPATH**/ ?>