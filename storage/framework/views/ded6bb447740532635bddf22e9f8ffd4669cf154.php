
<?php $__env->startSection('title',' Tags'); ?>

<?php $__env->startSection('style'); ?>
<style>

</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<?php if($errors->any()): ?>
    <ul>
        <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="alert alert-danger"><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php endif; ?>

<?php if(session()->has('success_save_tag')): ?>
<div class="alert alert-success">
    <?php echo e(session('success_save_tag')); ?>

</div>
<?php endif; ?>

<?php if(session()->has('success_delete_tag')): ?>
<div class="alert alert-success">
    <?php echo e(session('success_delete_tag')); ?>

</div>
<?php endif; ?>
<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered table-striped table-hover text-center">
            <thead>
                <th>#</th>
                <th>Tag Name</th>
            </thead>
            <tbody>
            <?php if(isset($tags)): ?>
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($tag->id); ?></td>
                    <td><a href="<?php echo e(route('tags.show',$tag->id)); ?>"><?php echo e($tag->name); ?></a></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="offset-md-1"></div>
    <div class="col-md-5">
    <h2>Add New tag</h2>
    <form action="<?php echo e(route('tags.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label>Tag name : </label>
            <input type="text" name="name" class="form-control" 
                   placeholder="Add A New tag">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Add tag">
        </div>
    </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/tags/index.blade.php ENDPATH**/ ?>