<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $__env->make('partials._head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body>
       
       <?php echo $__env->make('partials._nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <div class="container">
        <?php echo $__env->make('partials._messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
        </div>
    

        
        <?php echo $__env->make('partials._footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <?php echo $__env->make('partials._js_libraries', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\Blog\resources\views/main.blade.php ENDPATH**/ ?>