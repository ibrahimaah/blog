

<?php $__env->startSection('title',' Tag'); ?>


<?php $__env->startSection('style'); ?>

<style>
    .display-4
    {
        font-size:2.5rem
    }
    .pagination
    {
        justify-content:center
    }  
    .card{
        border: 1px solid #d8d8d8;
        box-shadow: 0 3px 8px rgba(0,0,0,.25);
    }
    a.anchor-post-title{
        color:#000;
    }
    .anchor-post-title:hover{
        text-decoration:none;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-8">
    <?php if(isset($posts)): ?>
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card mb-4 p-1 pb-3">
            <div class="card-body">
                <a href="<?php echo e(route('blog.single',$post->slug)); ?>" class="anchor-post-title">
                    <h2 class="display-4">
                        <?php echo e(substr($post->title ,0,60)); ?><?php echo e(strlen($post->title)>=60 ? '...' : ''); ?>

                    </h2>
                </a>
                <div class="mb-2">
                    <small class="text-secondary">
                    Posted By: <?php echo e($post->user->name ?? 'UnKnown'); ?>

                    </small>
                    <span> | </span>
                    <small class="text-secondary">
                    <?php echo e(date("j M Y ",strtotime($post->created_at))); ?> 
                    </small> 
                    <span> | </span>
                    <small class="text-secondary">
                    Posted In: <?php echo e($post->category->name); ?>

                    </small>
                </div>
            </div>
            <?php if(isset($post->img)): ?>
                <div class="card-body py-0">
                    <img src="<?php echo e(asset('img/'.$post->img)); ?>" alt="" class="card-img-top">
                </div>
            <?php endif; ?>
            <div class="card-body py-0">
                <p class="card-text">
                    <p class="lead text-break">
                        <?php echo substr($post->body,0,150); ?> <?php echo (strlen($post->body)>=150)?'...':''; ?>

                    </p>
                    <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('get_by_tag',$tag->name)); ?>">
                            <span class="badge badge-secondary"><?php echo e($tag->name); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </p>
                <a href="<?php echo e(route('blog.single',$post->slug)); ?>" 
                    class="btn btn-secondary float-right mt-2">
                    Read More >>
                </a>
            </div>
        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    
    </div>
</div>
<div class="row">
    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger mb-4"><< Back</a>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<script>
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/blog/posts-by-tag.blade.php ENDPATH**/ ?>