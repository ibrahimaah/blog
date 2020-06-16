

<?php $__env->startSection('title',' Comments'); ?>

<?php $__env->startSection('style'); ?>
<style></style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <?php if(session('success_spam')): ?>
            <div class="alert alert-success"><?php echo e(session('success_spam')); ?></div>
    <?php endif; ?>
    <div class="display-4 mb-4">Comments Management</div>

<?php if(isset($comments)): ?>
   <table class="table table-striped table-hover table-bordered text-center">
    <thead>
        <th>#</th>
        <th>Comment body</th>
        <th>Commented by</th>
        <th>Commented on</th>
        <th>Commented at</th>
        <th>Actions</th> 
    </thead>
    <tbody>
    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($comment->id); ?></td>
            <td class="text-left">
            <?php echo e(substr(utf8_decode($comment->comment) ,0,50)); ?><?php echo e(strlen(utf8_decode($comment->comment))>=50 ? '...' : ''); ?>

            </td>
            <td><?php echo e($comment->user->name); ?></td>
            <td>
                <a href="<?php echo e(route('show_comment',['slug'=>$comment->post->slug,'comment_id'=>$comment->id])); ?>">
                <?php echo e(substr($comment->post->title ,0,20)); ?><?php echo e(strlen($comment->post->title)>=20 ? '...' : ''); ?>

                </a>
            </td>
            <td><?php echo e(date('j M Y | H:i a',strtotime($comment->created_at))); ?></td>
            <td>

                <form action="<?php echo e(route('admin_delete_comment',$comment->id)); ?>" 
                      method="POST" class="float-left ml-2">
                 <?php echo csrf_field(); ?>
                 <?php echo method_field('DELETE'); ?>
                 <input type="submit" class="btn btn-danger btn-sm" value="spam">
                </form>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
   </table>
<?php else: ?> 
    <div class="alert alert-warining">There are no Comments</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/comments/index.blade.php ENDPATH**/ ?>