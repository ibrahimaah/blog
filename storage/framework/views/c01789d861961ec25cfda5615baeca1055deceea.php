
<?php $__env->startSection('title',' All Posts'); ?>

<?php $__env->startSection('style'); ?>
<style>
.pagination {
   justify-content: center;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success_delete')): ?>
<div class="alert alert-danger"><?php echo e(session('success_delete')); ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-md-10">
        <h2 class="display-4">All Posts</h2>
    </div>
    <div class="col-md-2">
        <a href="<?php echo e(route('posts.create')); ?>" 
        class="btn btn-block btn-primary mt-4">Create New Post</a>
    </div>
</div>
<?php if(!$posts->isEmpty()): ?>
<div class="row mt-2">
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover text-center">
            <thead>
                <th>#</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created At</th>
                <th>Action</th>
            </thead>
            <tbody>
            <?php if(isset($posts)): ?>
             <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($post->id); ?></td>
                    <td>
                       <?php echo e(substr($post->title,0,15)); ?> <?php echo e((strlen($post->title)>=15)?'...':''); ?>

                    </td>
                    <?php 
                    // we dont want to show ... in post body which length is less of 50 chars
                    // OR <?=(strlen($post->body)>=50)?'...':''?>
                    <td class="text-left">
                        <?php echo substr($post->body,0,50); ?> <?php echo (strlen($post->body)>=50)?'...':''; ?>

                    </td>
                    <td><?php echo e(date('j M Y',strtotime($post->created_at))); ?></td>
                    <td>
                        <a href="<?php echo e(route('posts.show',$post->id)); ?>" 
                           class="btn btn-sm btn-info">View</a>
                        <a href="<?php echo e(route('posts.edit',$post->id)); ?>" 
                           class="btn btn-sm btn-warning">Edit  <i class="fa fa-edit"></i></a>
                        <a href="<?php echo e(route('delete_post',$post->id)); ?>" 
                        class="btn btn-sm btn-danger" >
                        Delete  <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            </tbody>
        </table>
        <div class="text-center"><?php echo e($posts->links()); ?></div>
        <div class="text-center lead">
            Page  <?php echo e($posts->currentPage()); ?>  Of  <?php echo e($posts->lastPage()); ?> 
        </div>
    </div>
</div>

<?php else: ?>
<div class="alert alert-info display-4">Sorry There Are No Posts :( </div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/posts/index.blade.php ENDPATH**/ ?>