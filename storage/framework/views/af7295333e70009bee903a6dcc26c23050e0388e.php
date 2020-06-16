

<?php $__env->startSection('title',' Edit Tag'); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <form action="<?php echo e(route('tags.update',$tag->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group">
                <label for="">Tag name : </label>
                <input type="text" name="name" value="<?php echo e(old('name',$tag->name)); ?>" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="save" class="btn btn-success">
                <a href="<?php echo e(route('tags.show',$tag->id)); ?>" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<!--<script src="/js/parsley.min.js"></script>-->
<script>

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/tags/edit.blade.php ENDPATH**/ ?>