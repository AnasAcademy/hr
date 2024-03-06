<?php if(Session::has('success')): ?>
<div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
<?php endif; ?>

<?php if(Session::has('error')): ?>
<div class="alert alert-danger"><?php echo e(Session::get('error')); ?></div>
<?php endif; ?>


<?php echo e(Form::open(['route' => ['store.ip'], 'method' => 'post'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php $__errorArgs = ['ip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="alert alert-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php echo e(Form::label('ip', __('IP'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::text('ip', null, ['class' => 'form-control', 'placeholder' => 'Enter Ip Address'])); ?>

        </div>
        <div class="form-group">
            <?php $__errorArgs = ['belongs_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="alert alert-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php echo e(Form::label('belongs_to', __('belongs_to'), ['class' => 'col-form-label'])); ?>


           <select name="belongs_to" id="belongs_to">
            <option value="0" selected disabled>Select The owner of this Ip</option>

            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

           </select>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH F:\emem\Work\Anas Academy\hr\resources\views/restrict_ip/create.blade.php ENDPATH**/ ?>