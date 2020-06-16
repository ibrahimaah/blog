

<?php $__env->startSection('title',' Search Results'); ?>


<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="/calendar/css/calendar.css">
<style>
    .display-4
    {
        font-size:2.5rem
    }
    .pagination
    {
        justify-content:center
    }
</style>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>


<div class="row">
    <div class="col-md-12">
        <div class="jumbotron" style="background-color:var(--post-color)">
            <h2 class="display-3">Welcome to My Blog !</h1>
            <p class="lead mb-4">Thank You for visiting our blog , wish you exiciting time <span>&#128579;&#128579;</span> </p>
            <form class="form-inline my-2 my-lg-0 justify-content-center">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
    <?php if(isset($posts)): ?>
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card mb-4 border-secondary p-1"
             style="background-color:var(--post-color)">
            <div class="card-body">
                <h2 class="display-4">
                    <?php echo e(substr($post->title ,0,60)); ?><?php echo e(strlen($post->title)>=60 ? '...' : ''); ?>

                </h2>
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
                        <span class="badge badge-secondary"><?php echo e($tag->name); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </p>
                <a href="<?php echo e(url('blog/'.$post->slug)); ?>" 
                    class="btn btn-secondary float-right mt-2"
                    target="_blank">
                    Read More >>
                </a>
            </div>
        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php echo e($posts); ?>

    </div>

        <!--<div class="offset-md-1 col-md-5">
            <div class="calendar">
                
            </div>
        </div>-->
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script src="/calendar/js/calendar.js"></script>
<script>
$('.calendar').pignoseCalendar();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/Pages/Search.blade.php ENDPATH**/ ?>