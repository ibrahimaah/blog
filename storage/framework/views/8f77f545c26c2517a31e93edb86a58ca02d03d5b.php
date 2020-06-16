

<?php $__env->startSection('title'," $tag->name Tag"); ?>

<?php $__env->startSection('content'); ?>

<?php if($errors->any()): ?>
    <ul>
        <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="alert alert-danger"><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php endif; ?>

<?php if(session()->has('success_update_tag')): ?>
<div class="alert alert-success">
    <?php echo e(session('success_update_tag')); ?>

</div>
<?php endif; ?>

<div class="row">
    <div class="col-md-8">
        <h2 class="h1">
            <?php echo e($tag->name); ?> Tag 
            <small class="text-muted">
                <?php echo e($tag->posts->count()); ?> Posts
            </small>
        </h2>
    </div>
    <div class="col-md-4 text-right">
        <a href="<?php echo e(route('tags.edit',$tag->id)); ?>" class="btn btn-primary">Edit</a>
        <a href="<?php echo e(route('delete_tag',$tag->id)); ?>" class="btn btn-danger">Delete</a>
    </div>
</div>


<div class="row">
    <table class="table table-striped table-bordered table-hover text-center mt-4">
        <thead>
            <th>#</th>
            <th>Title</th>
            <th>Tag</th>
            <th>Action</th>
        </thead>
        <tbody>
        <?php 
            /**
             * posts is a dynamic property
             * u can access to posts related to one tag directly and vice versa
             */
        ?>
            <?php $__currentLoopData = $tag->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($post->id); ?></td>
                    <td><?php echo e($post->title); ?></td>
                    <td>
                        <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge badge-secondary"><?php echo e($tag->name); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('posts.show',$post->id)); ?>" 
                          class="btn btn-success btn-sm">view</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    
</div>
<div class="row">
    <a href="<?php echo e(route('tags.index')); ?>" class="btn btn-danger"><< Back</a>
</div>

    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/tags/show.blade.php ENDPATH**/ ?>