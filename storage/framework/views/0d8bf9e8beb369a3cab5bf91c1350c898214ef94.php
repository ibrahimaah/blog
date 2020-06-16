

<?php $__env->startSection('title',' Tag'); ?>


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
    .pignose-calendar .pignose-calendar-unit
    {
        height:2.8em
    }
    .pignose-calendar
    {
        width:100%;
    }
    .pignose-calendar .pignose-calendar-header{
        font-weight:150;
    }
    .pignose-calendar {
       font-size:92%;
       margin:unset;
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
    /* change tooltip background color */
    .tooltip-inner {
        opacity:.9;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if(isset($posts)): ?>
<div class="row">
    <div class="col-md-8">
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
    </div>

    <div class="col-md-4">
        <div class="mb-4">
            <form method="GET"
                    action="<?php echo e(route('get_search_res')); ?>"
                    class="form-inline my-2 my-lg-0 justify-content-center">
                <input class="form-control mr-sm-2" 
                        type="search"
                        name="search_word" 
                        placeholder="Search"
                        aria-label="Search"
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Are you looking for Something ? Let's find it &#x1F52D;">
                <button class="btn btn-outline-success my-2 my-sm-0" 
                        type="submit">
                        Search
                </button>
            </form>
        </div>
        <div class="calendar mb-4">
        </div>

        <div class="card mb-4">
            <div class="card-header text-center">
                Popular Posts
            </div>
            <div> 
                <ul class="list-group list-group-flush">
                    <?php $__currentLoopData = $new_articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new_article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item">
                        <a href="<?php echo e(route('blog.single',$new_article->slug)); ?>">
                        >> <?php echo substr($new_article->title,0,30); ?> <?php echo (strlen($new_article->title)>=30)?'...':''; ?>

                        </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-center">
                New Articles
            </div>
            <div> 
                <ul class="list-group list-group-flush">
                    <?php $__currentLoopData = $new_articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new_article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item">
                        <a href="<?php echo e(route('blog.single',$new_article->slug)); ?>">
                        >> <?php echo substr($new_article->title,0,30); ?> <?php echo (strlen($new_article->title)>=30)?'...':''; ?>

                        </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="alert alert-warning">
                <p class="display-1">
                    No Results Found !!
                    <span style='font-size:100px;'>&#128566;</span>
                </p>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger mb-4"><< Back</a>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

<script src="/calendar/js/calendar.js"></script>
<script>
$('.calendar').pignoseCalendar();

$('[data-toggle="tooltip"]').mouseenter(function(){
    var that = $(this)
    that.tooltip('show');
    setTimeout(function(){
        that.tooltip('hide');
    }, 2000);
});

$('[data-toggle="tooltip"]').mouseleave(function(){
    $(this).tooltip('hide');
});
/*
$('[data-toggle="tooltip"]').tooltip({
    animation: true,
    trigger : 'hover'
}); */
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/blog/search-result.blade.php ENDPATH**/ ?>