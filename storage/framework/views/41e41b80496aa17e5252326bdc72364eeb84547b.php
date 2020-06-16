

<?php $__env->startSection('title',' Create a new post'); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="/css/parsley.min.css">
<link rel="stylesheet" href="/css/select2.css">

<!--<script src="/js/tinymce/js/tinymce/tinymce.min.js"></script>-->
<script>
    //tinymce.init({
    //selector: '#id_body',  // change this value according to your HTML
    //plugins:"link code",
    //menubar:false
    //});

</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-8 offset-md-2">
    <h2 class="display-4">Create New Post </h2>
    
        <form action="<?php echo e(route('posts.store')); ?>" 
              method="POST" 
              class="border p-4" 
              data-parsley-validate 
              enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="id_title">Title :</label>
                <input type="text" name="title" value="<?php echo e(old('title')); ?>" id="id_title" class="form-control" 
                       data-parsley-required="true" data-parsley-maxlength="255">
            </div>

            <div class="form-group">
                <label for="id_body">Body :</label>
                <textarea name="body" id="id_body" rows="5" class="form-control" data-parsley-required><?php echo e(old('body')); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="id_slug">URL :</label>
                <input type="text" name="slug" value="<?php echo e(old('slug')); ?>" id="id_slug" class="form-control" 
                       data-parsley-required="true" data-parsley-maxlength="255">
            </div>

            <div class="form-group">
                <label for="id_slug">Category :</label>
                <select name="category_id" id="" class="form-control">
                <?php if(isset($categories)): ?>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option 
                         value="<?php echo e($category->id ?? ''); ?>" 
                         <?php echo e((old('category_id') == $category->id) ? 'selected' : ''); ?>>
                         <?php echo e($category->name ?? ''); ?>

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
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tag->id); ?>"><?php echo e($tag->name); ?></option>
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
                <input type="submit" value="Create A New Post" class="btn btn-success btn-lg btn-block">
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

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/posts/create.blade.php ENDPATH**/ ?>