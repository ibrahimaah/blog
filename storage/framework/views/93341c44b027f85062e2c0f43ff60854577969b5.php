
<?php $__env->startSection('title',' All Users'); ?>

<?php $__env->startSection('style'); ?>
<style>

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="row">
    <div class="col-md-10">
        <h2 class="display-4">Users Management</h2>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover text-center">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </thead>
            <tbody>
            <?php if(isset($users)): ?>
             <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td> <?php echo e($user->id); ?>    </td>
                    <td> <?php echo e($user->name); ?>  </td>
                    <td> <?php echo e($user->email); ?> </td>
                    <!-- we use pluck to retrieve data from array of objects -->
                    <!-- $user->roles i.e $user->roles()->get() -->
                    <!-- toArray() function convert collection to array -->
                    <td> <?php echo e(implode(' - ',$user->roles->pluck('role_name')->toArray())); ?> </td>
                    <td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-user')): ?>
                        <a href="<?php echo e(route('users.edit',$user->id)); ?>" class="btn btn-warning float-left">
                            Edit
                        </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-user')): ?>
                        <form action="<?php echo e(route('users.destroy',$user->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <input type="submit" value="Delete" class="btn btn-danger float-left ml-2">
                        </form>
                    <?php endif; ?>
                    </td>
                </tr>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            </tbody>
        </table>
        
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/users/index.blade.php ENDPATH**/ ?>