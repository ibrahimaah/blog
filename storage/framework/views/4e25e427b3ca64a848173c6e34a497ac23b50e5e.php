

<?php $__env->startSection('title',' Edit Post'); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="/css/parsley.min.css">
<link rel="stylesheet" href="/css/select2.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $arr_id_tags=[];
    foreach($post->tags as $tag)
    {
        $arr_id_tags[]=$tag->id;
    }
    $tag_Ids = implode('' , $arr_id_tags);
    //var_dump($tag_Ids);
    //dd($arr_id_tags);
?>
<div class="row">
    <div class="col-md-8 offset-md-2">
    <h2 class="display-4">Edit Post </h2>
    
        <form action="<?php echo e(route('posts.update',$post->id)); ?>"
              method="POST" 
              class="border p-4" 
              data-parsley-validate
              enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <div class="form-group">
                <label for="id_title">Title :</label>
                <input type="text" name="title"
                value="<?php echo e(old('title',$post->title)); ?>" 
                id="id_title" class="form-control" 
                data-parsley-required="true" data-parsley-maxlength="255">

            </div>

            <div class="form-group">
                <label for="id_body">Body :</label>
                <textarea name="body" id="id_body" rows="5" class="form-control" 
                data-parsley-required><?php echo e(old('body',$post->body)); ?>

                </textarea>
            </div>

            <div class="form-group">
                <label for="id_slug">URL :</label>
                <input type="text" name="slug" value="<?php echo e(old('slug',$post->slug)); ?>" 
                       id="id_slug" class="form-control" data-parsley-required="true" 
                       data-parsley-maxlength="255">
            </div>

            <div class="form-group">
                <label for="">Category : </label>
                <select name="category_id" id="" class="form-control">
                <?php if(is_null(old('category_id'))): ?>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $cat_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" 
                            <?php echo e(( $post->category_id == $id) ? 'selected' : ''); ?>>
                            <?php echo e($cat_name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $cat_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" 
                            <?php echo e((old('category_id') == $id) ? 'selected' : ''); ?>>
                            <?php echo e($cat_name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                </select>
            </div>
            
            <div class="form-group">
                <label>Tags :</label>
                <select 
                    class="select-multiple form-control"
                    name="tags[]"  
                    multiple="multiple">
                    
                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>">
                            <?php echo e($name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </select>
            </div>

            <div class="custom-file mb-4">
                <input type="file" class="custom-file-input" 
                       id="customFile" name="post_img"
                       value="<?php echo e(old('post_img')); ?>">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>

            <div class="form-group">
                <input type="submit" value="Save" class="btn btn-success ">
                <a href="<?php echo e(route('posts.show',$post->id)); ?>" class="btn btn-danger">Cancel</a>
            </div>

        </form>
        
        
    </div>
</div>
<div class="row">
    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger"><< Back</a>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<!--<script src="/js/parsley.min.js"></script>-->
<script src="/js/select2.js"></script>
<script>

$(function(){
    $('.select-multiple').select2();
    var x = (<?php echo e(((is_null($tag_Ids) || !isset($tag_Ids) || $tag_Ids=='')) ? '0' : $tag_Ids); ?> ).toString();
    //if the post has no tags releted to it
    if(x!=0)
    {
        $('.select-multiple').val(x.split("")).trigger('change');
    }

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/posts/edit.blade.php ENDPATH**/ ?>