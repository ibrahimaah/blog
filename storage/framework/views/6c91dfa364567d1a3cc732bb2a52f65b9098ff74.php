
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<!--<script src="/js/fontawesome.js"></script>-->
<script src="/js/script.js"></script> 
<script>
$(function(){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
});
</script>


<!-- For Sharing Links -->
<!--<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>-->
<script src="<?php echo e(asset('js/share.js')); ?>"></script>


<?php echo $__env->yieldContent('script'); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/partials/_js_libraries.blade.php ENDPATH**/ ?>