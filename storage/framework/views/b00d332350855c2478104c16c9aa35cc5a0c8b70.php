

<?php $__env->startSection('title',' Categories'); ?>

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

<?php if(session('success_save_category')): ?>
<div class="alert alert-success">
    <?php echo e(session('success_save_category')); ?>

</div>
<?php endif; ?>



<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered table-striped table-hover text-center">
            <thead>
                <th>#</th>
                <th>Category</th>
                <th>Action</th>
            </thead>
            <tbody>
            <?php if(isset($categories)): ?>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($category->id); ?></td>
                    <td><?php echo e($category->name); ?></td>
                    <td>
                        <a href="<?php echo e(route('categories.edit',$category->id)); ?>"
                           class="btn btn-warning float-left">
                           Edit
                        </a>
                        <form action="<?php echo e(route('categories.destroy',$category->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <input type="submit" value="Delete" class="btn btn-danger float-left ml-2">
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="offset-md-1"></div>
    <div class="col-md-5">
    <h2>Edit Category</h2>
 
    <form action="<?php echo e(route('categories.update',$cat->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label>category name : </label>
            <input type="text" name="name" class="form-control" value="<?php echo e(old('name',$cat->name)); ?>">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Save">
            <a href="<?php echo e(route('categories.index')); ?>" class="btn btn-danger">Cancel</a>
        </div>
    </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/categories/edit.blade.php ENDPATH**/ ?>