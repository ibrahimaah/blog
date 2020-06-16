

<?php $__env->startSection('title',' Contact'); ?>


<?php $__env->startSection('style'); ?>
<style></style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <h2 class="display-4 mb-4 text-center">Contact Us</h2>
        <form action="">
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" placeholder="Enter email" id="email">
            </div>
            <div class="form-group">
                <label for="pwd">Subject:</label>
                <input type="text" class="form-control" placeholder="Enter subject" id="subj">
            </div>
            <div class="form-group">
                <label for="txt-area">Message</label>
                <textarea class="form-control" id="txt-area" rows="3" placeholder="Enter Your Message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    //confirm("Hello from Blade");
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/Pages/Contact.blade.php ENDPATH**/ ?>