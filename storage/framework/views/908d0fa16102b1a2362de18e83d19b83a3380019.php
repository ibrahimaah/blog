<!--
    This view is managed by BlogController
-->


<?php $__env->startSection('title',$post->slug); ?>


<?php $__env->startSection('style'); ?>
<style>
    .display-4{
        font-size:2.5rem
    }
    .pagination{
        justify-content:left
    }
    .img-thumbnail-ib {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        width:60px;
        height:60px;
    }
    
    .comment .row img ,  .comment .row h5
    {
        align-self:flex-end;
    }
    .btn-like-result{
        display:none;
    }
    .btn-circle{
        width: 50px; 
        height: 50px; 
        padding: 7px 10px; 
        border-radius: 25px; 
        font-size: 20px; 
        text-align: center;
    }
    .card{
        border: 1px solid #d8d8d8;
        box-shadow: 0 3px 8px rgba(0,0,0,.25);
    }
    /* change tooltip background color */
    .tooltip-inner {
        background-color: #000;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="row">
    <div class="col-md-8">

    <?php if(isset($post)): ?>
        <div class="card">
            <div class="card-body">

                <h2 class="display-4 mb-2">
                <?php echo e($post->title ?? ''); ?>

                </h2>
                

                <div class="mb-4">
                    <span class="text-secondary font-size-18">By <?php echo e($post->user->name); ?> / </span>
                    <span class="text-secondary font-size-18">
                        <?php echo e(date("j M Y ",strtotime($post->created_at))); ?> /
                    </span> 
                    <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span>
                        <a href="<?php echo e(route('get_by_tag',$tag->name)); ?>">
                            <?php echo e($tag->name); ?>

                        </a>
                    </span>
                        <?php if(!($loop->last)): ?>
                            <span>,</span>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php if(isset($post->img)): ?>
                    <img src="<?php echo e(asset('img/'.$post->img)); ?>" alt="POST IMAGE" class="card-img-top mb-4">
                <?php endif; ?>

                <p class="lead">
                <?php echo $post->body ?? ''; ?>

                </p> 
            
            </div> 
        </div>
    <?php endif; ?>


        <hr>
            <img src="<?php echo e(asset('img/icons/eye.png')); ?>" alt="eye icon" width="20" height="20">
            <span class="num-of-views"><?php echo e($post->views ?? "0"); ?></span>
        <hr>
        
        <!-- like and dislike buttons -->
        <?php if(auth()->guard()->check()): ?>
            <button class="btn <?php echo e($liked ? 'btn-primary' : 'btn-light'); ?> btn-circle mr-2" 
                    id="btn-like">
                <i class='far fa-thumbs-up'></i>
            </button>
            <span id="span-like" class="mr-4"><?php echo e($likes ?? '0'); ?></span>
            
            <button class="btn <?php echo e($disliked ? 'btn-primary' : 'btn-light'); ?> btn-circle ml-4 mr-2" 
                    id="btn-dislike">
                <i class='far fa-thumbs-down'></i>
            </button>
            <span id="span-dislike"><?php echo e($dislikes ?? '0'); ?></span>
        <?php endif; ?>

            <div id="btn-result" class="btn-like-result mt-2"></div>

            
        <hr>
    
    <?php 
       // echo Share::page('http://jorenvanhocht.be')->twitter()
       //dd($x);
    ?>

    <div class="d-flex justify-content-left my-4">
        <div id="social-links">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(route('blog.single',$post->slug)); ?>"
            class="social-button pr-2">
                <img src="<?php echo e(asset('img/icons/facebook.png')); ?>" width="40" height="40">  
            </a>
        </div>
        <div id="social-links">
            <a href="https://wa.me/?text=<?php echo e(route('blog.single',$post->slug)); ?>"
            class="social-button pr-2">
                <img src="<?php echo e(asset('img/icons/whatsapp.svg')); ?>" width="40" height="40">
            </a>
        </div>
        <div id="social-links">
            <a href="https://telegram.me/share/url?url=<?php echo e(route('blog.single',$post->slug)); ?>"
            class="social-button ">
                <img src="<?php echo e(asset('img/icons/telegram.svg')); ?>" width="40" height="40">
            </a>
        </div>
    </div>

        <?php if(session('cannt_comment')): ?>
            <div class="alert alert-warning text-center">
                <?php echo e(session('cannt_comment')); ?> &#128517;
            </div>
        <?php endif; ?>
        <div class="display-6 mb-4">Add Comment</div>
        <?php if(session('success_comment')): ?>
            <div class="alert alert-success"><?php echo e(session('success_comment')); ?></div>
        <?php endif; ?>
        
        <form action="<?php echo e(route('add_comment',['post_id'=>$post->id])); ?>" method="POST">
        <?php echo csrf_field(); ?>
            <div class="form-group">
                <textarea class="p-2" 
                          name="comment" 
                          placeholder="Type your comment"
                          rows=4 
                          style="width:100%" 
                          id="txt_comment"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" 
                       class="btn btn-primary" 
                       value="Add Comment">
            </div>
        </form>
        <hr>
        <div class="display-6 mb-4">Comments (<?php echo e($comments_count); ?>)</div>
        <div class="all-comments">
        
        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
            <div class="comment mb-4">
                <div class="row mb-4">
                    <img src="/img/profile.jpg" alt="profile image" class="rounded-circle img-thumbnail-ib" id="<?php echo e($comment->id); ?>">
                    <h5 class="ml-2"><?php echo e($comment->user->name); ?></h5>
                </div>
                <div class="row">
                    <div class="col-md-8">

                        <div class="mb-4">
                            <?php echo e(utf8_decode($comment->comment)); ?>

                        </div>
                    <?php if(Auth::check()): ?>
                        <?php if(Auth::user()->id == $comment->user->id || Auth::user()->fun_has_role('admin')): ?>
                            <div class="comment-action mt-2">
                               <a href="<?php echo e(route('edit_comment',['comment_id'=>$comment->id])); ?>" 
                                   class="btn btn-warning btn-sm float-left">Edit</a>
                               <form action="<?php echo e(route('delete_comment',['comment_id'=>$comment->id])); ?>"                      method="post" class="float-left">
                               <?php echo csrf_field(); ?>
                               <?php echo method_field('DELETE'); ?>
                               <input type="submit" class="btn btn-danger btn-sm ml-2" value="Delete">
                               </form>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    </div>
                </div>
            </div>
            <?php if(isset($comment->created_at)): ?>
            <small>Commented at - <span class="text-secondary">
                <?php echo e(date('j M Y | H:i a',strtotime($comment->created_at))); ?></span></small>
            <?php else: ?>
            <small>Commented at - <span class="text-secondary">unKnown</span> </small>
            <?php endif; ?>
            <hr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger mt-4 mb-4"><< Back</a>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header text-center">
                Related Posts
            </div>
            <div> 
                <ul class="list-group list-group-flush">
                    <?php $__currentLoopData = $related_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item">
                        <a href="<?php echo e(route('blog.single',$p->slug)); ?>">
                        >> <?php echo substr($p->title,0,30); ?> <?php echo (strlen($p->title)>=30)?'...':''; ?>

                        </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>


    <!--<div class="offset-md-1 col-md-3">
        <h2 class="">Sidebar</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quam porro? Tenetur aspernatur eveniet numquam ab quos iusto quidem distinctio sit doloremque. Quae mollitia accusantium ad explicabo reiciendis assumenda natus.</p>
    </div>-->
    
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="/emojis/emoji.js"></script>

<script>
$(function(){

    $('textarea').emoji({
        place:'after'
    });

    function ajax_like(btn_state)
    {
        $.ajax({
            url     : "<?php echo e(route('ajax_like',$post->id)); ?>" ,
            method  : "GET" ,
            data    : {
                state : btn_state
            },
            success : function(data){
                $('#span-like').text(data.likes);
                $('#span-dislike').text(data.dislikes);
            },
            error : function(){
                alert('error');
            }
        });
    }
    
    function control_class(obj , removed_class , added_class)
    {
        $(obj).removeClass(removed_class).addClass(added_class);
    }

    function addlike()
    {
        ajax_like('add_like');
        control_class('#btn-like','btn-light','btn-primary');
        control_class('#btn-dislike','btn-primary','btn-light');
    }
    function un_like()
    {
        ajax_like('unlike');
        control_class('#btn-like','btn-primary','btn-light');
    }
    function add_dislike()
    {
        ajax_like('add_dislike');
        control_class('#btn-dislike','btn-light','btn-primary');
        control_class('#btn-like','btn-primary','btn-light');
    }
    function un_dislike()
    {
        ajax_like('undislike');
        control_class('#btn-dislike','btn-primary','btn-light');
    }

    $('#btn-like').on('click',function()
    {
        if($(this).hasClass('btn-light')) 
        {
            addlike();
        }    
        else
        {
            un_like();
        }
    });

    $('#btn-dislike').on('click',function()
    {
        if($(this).hasClass('btn-light')) 
        {
            add_dislike();
        }
        else
        {
            un_dislike();
        }
    });
    
    
});

  

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/blog/single.blade.php ENDPATH**/ ?>