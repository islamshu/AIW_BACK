<?php if(Session::get('success') != null): ?>
<div class="alert alert-success" style="text-align: center;">
    <?php echo e(Session::get('success')); ?>

</div>
<?php endif; ?>
<?php if(Session::get('error') != null): ?>
<div class="alert alert-danger" style="text-align: center;">
    <?php echo e(Session::get('error')); ?>

</div>
<?php endif; ?>
<?php if(count($errors) > 0): ?>
<div class="alert alert-danger">
 <ul style="text-align: center">
  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <li><?php echo e($error); ?></li>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 </ul>
</div>
<?php endif; ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/inc/alerts.blade.php ENDPATH**/ ?>