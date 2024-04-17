<?php $__env->startPush('script-page'); ?>
    <script type="text/javascript">

        $(document).on("click", ".email-template-checkbox", function () {
            var chbox = $(this);
            $.ajax({
                url: chbox.attr('data-url'),
                data: {_token: $('meta[name="csrf-token"]').attr('content'), status: chbox.val()},
                type: 'post',
                success: function (response) {
                    if (response.is_success) {
                        toastr('Success', response.success, 'success');
                        if (chbox.val() == 1) {
                            $('#' + chbox.attr('id')).val(0);
                        } else {
                            $('#' + chbox.attr('id')).val(1);
                        }
                    } else {
                        toastr('Error', response.error, 'error');
                    }
                },
                error: function (response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        toastr('Error', response.error, 'error');
                    } else {
                        toastr('Error', response, 'error');
                    }
                }
            })
        });

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php if(\Auth::user()->type=='company'): ?>
        <?php echo e(__('Email Notification')); ?>

    <?php else: ?>
        <?php echo e(__('Email Templates')); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <?php if(\Auth::user()->type=='company'): ?>
            <h5 class="h4 d-inline-block font-weight-400 mb-0"><?php echo e(__('Email Notification')); ?></h5>
        <?php else: ?>
            <h5 class="h4 d-inline-block font-weight-400 mb-0"><?php echo e(__('Email Templates')); ?></h5>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php if(\Auth::user()->type=='company'): ?>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Email Notification')); ?></li>
    <?php else: ?>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Email Template')); ?></li>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                <h5></h5>
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th scope="col" class="sort" data-sort="name"> <?php echo e(__('Name')); ?></th>
                                <?php if(\Auth::user()->type=='company'): ?>
                                    <th class="text-end"><?php echo e(__('On / Off')); ?></th>
                                <?php else: ?>
                                    <th class="text-end"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $EmailTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $EmailTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($EmailTemplate->name); ?></td>
                                    <td>
                                        <?php if(\Auth::user()->type=='super admin'): ?>
                                        <div class="text-end">
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="<?php echo e(route('manage.email.language',[$EmailTemplate->id,\Auth::user()->lang])); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-toggle="tooltip" title="<?php echo e(__('View')); ?>">
                                                <i class="ti ti-eye text-white"></i>
                                            </a>
                                        </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if(\Auth::user()->type=='company'): ?>
                                        <div class="text-end">
                                            <div class="form-check form-switch d-inline-block">
                                                <input class="form-check-input" type="checkbox"
                                                 id="email_tempalte_<?php echo e($EmailTemplate->template->id); ?>" 
                                                  <?php if($EmailTemplate->template->is_active == 1): ?> checked="checked" <?php endif; ?> 
                                                  value="<?php echo e($EmailTemplate->template->is_active); ?>" 
                                                  data-url="<?php echo e(route('status.email.language',[$EmailTemplate->template->id])); ?>" 
                                                   role="switch">
                                                <label class="custom-control-label form-control-label" for="email_tempalte_<?php echo e($EmailTemplate->template->id); ?>"></label>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\OneDrive - اكاديمية انس للفنون البصرية\Desktop\hr\resources\views/email_templates/index.blade.php ENDPATH**/ ?>