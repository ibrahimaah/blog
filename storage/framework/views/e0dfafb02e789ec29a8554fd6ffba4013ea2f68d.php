
<?php $__env->startSection('title',' All Users'); ?>

<?php $__env->startSection('style'); ?>
<style>

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



       


<div class="row">
    <div class="col-md-6">
        <h2 class="h1">Edit User <?php echo e($user->name); ?></h2>
        <form action="<?php echo e(route('users.update', $user)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?> 
            <div class="form-group">
                <label for="">UserName : </label>
                <input type="text" class="form-control" name="name" 
                value="<?php echo e(old('name',$user->name)); ?>">
            </div>
            <div class="form-group">
                <label for="">Email : </label>
                <input type="email" class="form-control" name="email" 
                value="<?php echo e(old('name',$user->email)); ?>">
            </div>
           
            <label for="">Roles:</label>
            <div class="form-check form-group">
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="checkbox" name="roles[]" value="<?php echo e($role->id); ?>"
                <?php echo e(($user->roles->pluck('id')->contains($role->id)) ? 'checked' : ''); ?>>
                <label for=""><?php echo e($role->role_name); ?></label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <input type="submit" value="Save" class="btn btn-primary">
        </form>

    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/users/edit.blade.php ENDPATH**/ ?>