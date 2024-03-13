<?php echo e(Form::model($device, ['route' => ['edit.ip', $device->id], 'method' => 'POST'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('ip', __('Device Identifier'), ['class' => 'col-form-label'])); ?>

            <input class="form-control" type="text" name="ip" placeholder="Enter Ip Address" id="ip" value="<?php echo e($device->ip); ?>">
        </div>
        <div class="form-group">
            <?php echo e(Form::label('belongs_to', __('belongs_to'), ['class' => 'col-form-label'])); ?>

            <select name="belongs_to" id="belongs_to" class="form-control">
                <option value="0" selected disabled>Select The owner of this Ip</option>

                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <option value="<?php echo e($user->id); ?>" <?php if($device->belongs_to == $user->id): ?> selected <?php endif; ?>>
                    <?php echo e($user->name); ?></option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

               </select>
        </div>
        <div class="form-group">
            <?php echo e(Form::label('status', __('status'), ['class' => 'col-form-label'])); ?>

            <select name="status" id="status" class="form-control">
                <option value="0" selected disabled>Select The Status of this Ip</option>

                <option value="pending" <?php if($device->status == 'pending'): ?> selected <?php endif; ?> > Pending</option>
                <option value="approved" <?php if($device->status == 'approved'): ?> selected <?php endif; ?>> Approved </option>
                <option value="rejected" <?php if($device->status == 'rejected'): ?> selected <?php endif; ?>>Rejected</option>



               </select>
        </div>


    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH F:\emem\Work\Anas Academy\hr\resources\views/restrict_ip/edit.blade.php ENDPATH**/ ?>