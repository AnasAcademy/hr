<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <table class="table modal-table" id="pc-dt-simple">
                <tr role="row">
                    <th><?php echo e(__('Device Identifier')); ?></th>
                    <td><?php echo e(!empty($device->ip) ? $device->ip : ''); ?></td>
                </tr>
                <tr>
                    <th><?php echo e(__('User ')); ?></th>
                    <td><?php echo e(!empty($device->belongs_to) ? $device->user->name : ''); ?></td>
                </tr>
                <tr>
                    <th><?php echo e(__('Status')); ?></th>
                    <td><?php echo e($device->status); ?></td>
                </tr>
                <tr>
                    <th><?php echo e(__('Created At')); ?></th>
                    <td><?php echo e(\Auth::user()->dateFormat($device->created_at)); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Device')): ?>
    <div class="modal-footer">
        <?php echo e(Form::open(['url' => 'ip/' . $device->id . '/approve', 'method' => 'post'])); ?>

        <input type="submit" value="<?php echo e(__('Approved')); ?>" class="btn btn-success rounded" name="status">
        <?php echo e(Form::close()); ?>

        <?php echo e(Form::open(['url' => 'ip/' . $device->id . '/reject', 'method' => 'post'])); ?>

        <input type="submit" value="<?php echo e(__('Reject')); ?>" class="btn btn-danger rounded" name="status">
        <?php echo e(Form::close()); ?>

    </div>
<?php endif; ?>
<?php /**PATH F:\emem\Work\Anas Academy\hr\resources\views/restrict_ip/action.blade.php ENDPATH**/ ?>