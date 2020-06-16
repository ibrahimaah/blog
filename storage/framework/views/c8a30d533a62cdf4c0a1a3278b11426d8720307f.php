

<?php $__env->startSection('title',' Edit Comment'); ?>


<?php $__env->startSection('style'); ?>
<style>
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
 <form action="<?php echo e(route('update_comment',['comment_id' => $comment->id])); ?>"
       method="POST">
 <?php echo csrf_field(); ?>
 <?php echo method_field('PUT'); ?>
 <div class="display-5 mb-4">Edit Comment</div>
 <div class="form-group">
    <textarea class="p-2" name="comment" id="" cols="100" rows="3"><?php echo e(utf8_decode(old('comment',$comment->comment))); ?></textarea>
 </div>
 <div class="form-group">
    <input type="submit" value="save" class="btn btn-primary">
    <a href="<?php echo e(route( 'blog.single' , ['slug' => $comment->post->slug] )); ?>" 
       class="btn btn-danger">cancel</a>
 </div>
 </form>   
    
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="/emojis/emoji.js"></script>
<script>
$(function(){
    $('textarea').emoji({
        place:'after'
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/blog/edit-comment.blade.php ENDPATH**/ ?>