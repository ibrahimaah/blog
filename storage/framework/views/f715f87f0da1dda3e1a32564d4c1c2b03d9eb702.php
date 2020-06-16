

<?php if(isset($post)): ?>
    <?php $__env->startSection('title',' Post '. $post->id); ?>
<?php endif; ?> 

<?php $__env->startSection('content'); ?>

<?php if($errors->any()): ?>
  <ul>
  <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li>
      <div class="alert alert-danger"><?php echo e($error); ?></div>
    </li>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
<?php endif; ?>

<?php if(session()->has('success_update')): ?>
  <div class="alert alert-success"><?php echo e(session('success_update')); ?></div>
<?php endif; ?>


<div class="row">
  <div class="col-md-7">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> 
           <?php if(isset($post)): ?>
             <?php echo e($post->title); ?> 
           <?php endif; ?>
         </h4>
         <div class="mb-4">
            <span class="text-secondary font-size-18">By <?php echo e($post->user->name); ?> / </span>
            <span class="text-secondary font-size-18">
                <?php echo e(date("j M Y ",strtotime($post->created_at))); ?> 
            </span> 
         </div>

        <?php if(isset($post->img)): ?>
          <img src="<?php echo e(asset('img/'.$post->img)); ?>" alt="POST IMAGE" class="card-img-top mb-4">
        <?php endif; ?>

        <p class="card-text">
          <?php if(isset($post)): ?>
            <?php echo $post->body; ?> 
          <?php endif; ?>
        </p>
        
        <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <span class="badge badge-secondary"><?php echo e($tag->name); ?></span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
    <div class="row mt-4">
      <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger"><< Back</a>
    </div>
  </div>
  <div class="col-md-5">
    <div class="card">
      <div class="card-body">
        <div class="card-title text-center font-weight-bold">POST INFORMATION</div>
        <div class="card-text">
          <ul class="list-group">

            <li class="list-group-item">
              <div class="row">
                <div class="col-md-4 font-weight-bold">
                 Post URL
                </div>
                <div class="col-md-8">
                  <?php if(isset($post)): ?>
                  <a href="<?php echo e(route('blog.single',$post->slug)); ?>" target='_blank'>
                    <?php echo e(route('blog.single',$post->slug)); ?>

                  </a> 
                  <?php endif; ?>
                </div>
              </div>
            </li>

            <li class="list-group-item">
              <div class="row">
                <div class="col-md-4 font-weight-bold">
                  Category
                </div>
                <div class="col-md-8">
                  <?php if(isset($post)): ?>
                   <?php echo e($post->category->name); ?> 
                   <?php endif; ?>
                </div>
              </div>
            </li>
            
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-4 font-weight-bold">
                 Created At
                </div>
                <div class="col-md-8">
                  <?php if(isset($post)): ?>
                   <?php echo e(date("j M Y / g:i a",strtotime($post->created_at))); ?> 
                   <?php endif; ?>
                </div>
              </div>
            </li>

            <?php 
                /* If u want to convert the date in the database to a date formate that
                  u want then first u have to convert the database date to timestamp then
                  using that timestamp to create a readable date with the formate u want
                */
                /*
                  If u want to compare two dates then u have to convert both to timestamp then
                  do compare
                */
                /*
                  u can use timestamp also if u want thing for example that
                  happened in the past two weeks
                */
            ?>
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-4 font-weight-bold">
                 Updated At
                </div>
                <div class="col-md-8">
                  <?php if(isset($post)): ?>
                   <?php echo e(date("j M Y / g:i a",strtotime($post->updated_at))); ?> 
                   <?php endif; ?>
                </div>
              </div>
            </li>

          </ul>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-6">
           <?php if(isset($post)): ?>
            <a href="<?php echo e(route('posts.edit', $post->id)); ?>" class="btn btn-warning btn-block">
            Edit Post <i class="fa fa-edit"></i>
            </a>
           <?php endif; ?>
          </div>
          <div class="col-md-6">
          <?php if(isset($post)): ?>
            <a href="<?php echo e(route('delete_post', $post->id)); ?>" class="btn btn-danger btn-block">
            Delete Post <i class="fa fa-trash"></i>
            </a>
          <?php endif; ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <a href="<?php echo e(route('posts.create')); ?>" 
            class="btn btn-block btn-primary mt-4">Create New Post 
           <i class="fa fa-plus"></i> 
          </a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <a href="<?php echo e(route('posts.index')); ?>" 
            class="btn btn-block btn-info mt-4">Show All Posts >>
          </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/posts/show.blade.php ENDPATH**/ ?>