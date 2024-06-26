<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php
    $setting = App\Models\Utility::settings();

?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php if(session('status')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>


        <?php if(\Auth::user()->type == 'employee' || \Auth::user()->type == 'manager' || \Auth::user()->type == 'hr'): ?>
            
            <div class="d-flex justify-content-end mb-5">
                <form action="create/ip" method="post" id="deviceIpIdentifier">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="deviceIp" id="deviceIp">
                    <?php
                        $addedDeviceCount = 0;
                    ?>
                    <?php if(isset($_COOKIE['addedDeviceCount'])): ?>
                        <?php
                            $addedDeviceCount = $_COOKIE['addedDeviceCount'];
                        ?>
                    <?php endif; ?>

                    <button class="btn btn-success" type="submit"><?php echo e(__('Add My Device')); ?></button>
                    

                </form>

            </div>
            <div class="col-xxl-6">
                <div class="card" style="min-height: 230px;">
                    <div class="card-header">
                        <h5><?php echo e(__('Mark Attandance')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex gap-5 align-items-baseline flex-wrap mb-5">
                            <p class="text-muted pb-0-5">

                                <?php echo e(__('My Office Time:') ." ". \Auth::user()->TimeFormat(auth()->user()->employee->work_start_time)    .' '.__('to').' '.  \Auth::user()->TimeFormat(auth()->user()->employee->work_end_time)); ?>

                            </p>
                            <div id="countdown" class="btn btn-info text-center d-none"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-3 float-right border-right">
                                <?php echo e(Form::open(['url' => 'attendanceemployee/attendance', 'method' => 'post', 'id' => 'clockInForm'])); ?>

                                <input type="hidden" name="fingerprint" id="lockInFingerprint">
                                <?php if(empty($employeeAttendance) || $employeeAttendance->clock_out != '00:00:00'): ?>
                                    <button type="submit" value="0" name="in" id="clock_in"
                                        class="btn btn-primary"><?php echo e(__('CLOCK IN')); ?></button>
                                <?php else: ?>
                                    <button type="submit" value="0" name="in" id="clock_in"
                                        class="btn btn-primary disabled" disabled><?php echo e(__('CLOCK IN')); ?></button>
                                <?php endif; ?>
                                <?php echo e(Form::close()); ?>

                            </div>
                            <div class="col-sm-6 float-left">
                                <?php if(!empty($employeeAttendance) && $employeeAttendance->clock_out == '00:00:00'): ?>
                                    <?php echo e(Form::model($employeeAttendance, ['route' => ['attendanceemployee.update', $employeeAttendance->id], 'method' => 'PUT', 'id' => 'clockOutForm'])); ?>

                                    <input type="hidden" name="fingerprint" id="lockOutFingerprint">
                                    <button type="submit" value="1" name="out" id="clock_out"
                                        class="btn btn-danger"><?php echo e(__('CLOCK OUT')); ?></button>
                                <?php else: ?>
                                    <button type="submit" value="1" name="out" id="clock_out"
                                        class="btn btn-danger disabled" ><?php echo e(__('CLOCK OUT')); ?></button>
                                <?php endif; ?>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="height: 402px;">
                    <div class="card-header card-body table-border-style">
                        <h5><?php echo e(__('Meeting schedule')); ?></h5>
                    </div>
                    <div class="card-body" style="height: 320px">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Meeting title')); ?></th>
                                        <th><?php echo e(__('Meeting Date')); ?></th>
                                        <th><?php echo e(__('Meeting Time')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($meeting->title); ?></td>
                                            <td><?php echo e(\Auth::user()->dateFormat($meeting->date)); ?></td>
                                            <td><?php echo e(\Auth::user()->timeFormat($meeting->time)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5><?php echo e(__('Calendar')); ?></h5>
                                <input type="hidden" id="path_admin" value="<?php echo e(url('/')); ?>">
                            </div>
                            <div class="col-lg-6">
                                
                                <label for=""></label>
                                <?php if(isset($setting['is_enabled']) && $setting['is_enabled'] == 'on'): ?>
                                    <select class="form-control" name="calender_type" id="calender_type"
                                        style="float: right;width: 155px;" onchange="get_data()">
                                        <option value="google_calender"><?php echo e(__('Google Calendar')); ?></option>
                                        <option value="local_calender" selected="true">
                                            <?php echo e(__('Local Calendar')); ?></option>
                                    </select>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id='event_calendar' class='calendar'></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header card-body table-border-style">
                        <h5><?php echo e(__('Announcement List')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Start Date')); ?></th>
                                        <th><?php echo e(__('End Date')); ?></th>
                                        <th><?php echo e(__('Description')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($announcement->title); ?></td>
                                            <td><?php echo e(\Auth::user()->dateFormat($announcement->start_date)); ?></td>
                                            <td><?php echo e(\Auth::user()->dateFormat($announcement->end_date)); ?></td>
                                            <td><?php echo e($announcement->description); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xxl-12">

                
                <div class="row">

                    <div class="col-lg-4 col-md-6">

                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-users"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Staff')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary"><?php echo e($countUser + $countEmployee); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">

                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-info">
                                                <i class="ti ti-ticket"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Ticket')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-info"> <?php echo e($countTicket); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">

                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-warning">
                                                <i class="ti ti-wallet"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Account Balance')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-warning"><?php echo e(\Auth::user()->priceFormat($accountBalance)); ?>

                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mb-3 mb-sm-0">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-cast"></i>
                                    </div>
                                    <div class="ms-3">
                                        <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                        <h6 class="m-0"><?php echo e(__('Jobs')); ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto text-end">
                                <h4 class="m-0 text-primary"><?php echo e($activeJob + $inActiveJOb); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-6">

                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mb-3 mb-sm-0">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-info">
                                        <i class="ti ti-cast"></i>
                                    </div>
                                    <div class="ms-3">
                                        <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                        <h6 class="m-0"><?php echo e(__('Active Jobs')); ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto text-end">
                                <h4 class="m-0 text-info"> <?php echo e($activeJob); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">

                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mb-3 mb-sm-0">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-warning">
                                        <i class="ti ti-cast"></i>
                                    </div>
                                    <div class="ms-3">
                                        <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                        <h6 class="m-0"><?php echo e(__('Inactive Jobs')); ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto text-end">
                                <h4 class="m-0 text-warning"><?php echo e($inActiveJOb); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

            
            <div class="col-xxl-12">
                <div class="row">
                    <div class="col-xl-5">

                        <?php if(\Auth::user()->type == 'company'): ?>
                            <div class="card">
                                <div class="card-header card-body table-border-style">
                                    <h5><?php echo e(__('Storage Status')); ?> <small>(<?php echo e($users->storage_limit . 'MB'); ?> /
                                            <?php echo e($plan->storage_limit . 'MB'); ?>)</small></h5>
                                </div>
                                <div class="card-body" style="height: 324px; overflow:auto">
                                    <div class="card shadow-none mb-0">
                                        <div class="card-body border rounded  p-3">
                                            <div id="device-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="card">
                            <div class="card-header card-body table-border-style">
                                <h5><?php echo e(__('Meeting schedule')); ?></h5>
                            </div>
                            <div class="card-body" style="height: 324px; overflow:auto">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Title')); ?></th>
                                                <th><?php echo e(__('Date')); ?></th>
                                                <th><?php echo e(__('Time')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($meeting->title); ?></td>
                                                    <td><?php echo e(\Auth::user()->dateFormat($meeting->date)); ?></td>
                                                    <td><?php echo e(\Auth::user()->timeFormat($meeting->time)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header card-body table-border-style">
                                <h5><?php echo e(__("Today's Not Clock In")); ?></h5>
                            </div>
                            <div class="card-body" style="height: 324px; overflow:auto">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Name')); ?></th>
                                                <th><?php echo e(__('Status')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            <?php $__currentLoopData = $notClockIns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notClockIn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($notClockIn->name); ?></td>
                                                    <td><span class="absent-btn"><?php echo e(__('Absent')); ?></span></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h5><?php echo e(__('Calendar')); ?></h5>
                                        <input type="hidden" id="path_admin" value="<?php echo e(url('/')); ?>">
                                    </div>
                                    <div class="col-lg-6">
                                        
                                        <label for=""></label>
                                        <?php if(isset($setting['is_enabled']) && $setting['is_enabled'] == 'on'): ?>
                                            <select class="form-control" name="calender_type" id="calender_type"
                                                style="float: right;width: 155px;" onchange="get_data()">
                                                <option value="google_calender"><?php echo e(__('Google Calendar')); ?></option>
                                                <option value="local_calender" selected="true">
                                                    <?php echo e(__('Local Calendar')); ?></option>
                                            </select>
                                        <?php endif; ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-body card-635 ">
                                <div id='calendar' class='calendar'></div>
                            </div>
                        </div>

                        <?php if(\Auth::user()->type == 'company'): ?>
                            <div class="card">
                                <div class="card-header card-body table-border-style">
                                    <h5><?php echo e(__('Announcement List')); ?></h5>
                                </div>
                                <div class="card-body" style="height: 324px; overflow:auto">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th><?php echo e(__('Title')); ?></th>
                                                    <th><?php echo e(__('Start Date')); ?></th>
                                                    <th><?php echo e(__('End Date')); ?></th>
                                                    <th><?php echo e(__('Description')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($announcement->title); ?></td>
                                                        <td><?php echo e(\Auth::user()->dateFormat($announcement->start_date)); ?></td>
                                                        <td><?php echo e(\Auth::user()->dateFormat($announcement->end_date)); ?></td>
                                                        <td><?php echo e($announcement->description); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <?php if(\Auth::user()->type != 'company'): ?>
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header card-body table-border-style">
                            <h5><?php echo e(__('Announcement List')); ?></h5>
                        </div>
                        <div class="card-body" style="height: 270px; overflow:auto">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Title')); ?></th>
                                            <th><?php echo e(__('Start Date')); ?></th>
                                            <th><?php echo e(__('End Date')); ?></th>
                                            <th><?php echo e(__('Description')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($announcement->title); ?></td>
                                                <td><?php echo e(\Auth::user()->dateFormat($announcement->start_date)); ?></td>
                                                <td><?php echo e(\Auth::user()->dateFormat($announcement->end_date)); ?></td>
                                                <td><?php echo e($announcement->description); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/main.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>

    <?php if(Auth::user()->type == 'company' || Auth::user()->type == 'hr'): ?>
        <script type="text/javascript">
            $(document).ready(function() {
                get_data();
            });

            function get_data() {
                var calender_type = $('#calender_type :selected').val();

                $('#calendar').removeClass('local_calender');
                $('#calendar').removeClass('google_calender');
                if (calender_type == undefined) {
                    calender_type = 'local_calender';
                }
                $('#calendar').addClass(calender_type);

                $.ajax({
                    url: $("#path_admin").val() + "/event/get_event_data",
                    method: "POST",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        'calender_type': calender_type
                    },
                    success: function(data) {

                        var etitle;
                        var etype;
                        var etypeclass;
                        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            buttonText: {
                                timeGridDay: "<?php echo e(__('Day')); ?>",
                                timeGridWeek: "<?php echo e(__('Week')); ?>",
                                dayGridMonth: "<?php echo e(__('Month')); ?>"
                            },
                            // slotLabelFormat: {
                            //     hour: '2-digit',
                            //     minute: '2-digit',
                            //     hour12: false,
                            // },
                            themeSystem: 'bootstrap',
                            slotDuration: '00:10:00',
                            allDaySlot: true,
                            navLinks: true,
                            droppable: true,
                            selectable: true,
                            selectMirror: true,
                            editable: true,
                            dayMaxEvents: true,
                            handleWindowResize: true,
                            events: data,
                            // height: 'auto',
                            // timeFormat: 'H(:mm)',
                        });
                        calendar.render();
                    }
                });
            };
        </script>
    <?php else: ?>
        <script>
            $(document).ready(function() {
                get_data();
            });

            function get_data() {
                var calender_type = $('#calender_type :selected').val();

                $('#event_calendar').removeClass('local_calender');
                $('#event_calendar').removeClass('google_calender');
                if (calender_type == undefined) {
                    calender_type = 'local_calender';
                }
                $('#event_calendar').addClass(calender_type);

                $.ajax({
                    url: $("#path_admin").val() + "/event/get_event_data",
                    method: "POST",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        'calender_type': calender_type
                    },
                    success: function(data) {
                        var etitle;
                        var etype;
                        var etypeclass;
                        var calendar = new FullCalendar.Calendar(document.getElementById('event_calendar'), {
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            buttonText: {
                                timeGridDay: "<?php echo e(__('Day')); ?>",
                                timeGridWeek: "<?php echo e(__('Week')); ?>",
                                dayGridMonth: "<?php echo e(__('Month')); ?>"
                            },
                            // slotLabelFormat: {
                            //     hour: '2-digit',
                            //     minute: '2-digit',
                            //     hour12: false,
                            // },
                            themeSystem: 'bootstrap',
                            slotDuration: '00:10:00',
                            allDaySlot: true,
                            navLinks: true,
                            droppable: true,
                            selectable: true,
                            selectMirror: true,
                            editable: true,
                            dayMaxEvents: true,
                            handleWindowResize: true,
                            events: data,
                            // height: 'auto',
                            // timeFormat: 'H(:mm)',

                        });

                        calendar.render();
                    }
                });
            };
        </script>
    <?php endif; ?>

    <?php if(\Auth::user()->type == 'company'): ?>
        <script>
            (function() {
                var options = {
                    series: [<?php echo e(round($storage_limit, 2)); ?>],
                    chart: {
                        height: 350,
                        type: 'radialBar',
                        offsetY: -20,
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        radialBar: {
                            startAngle: -90,
                            endAngle: 90,
                            track: {
                                background: "#e7e7e7",
                                strokeWidth: '97%',
                                margin: 5, // margin is in pixels
                            },
                            dataLabels: {
                                name: {
                                    show: true
                                },
                                value: {
                                    offsetY: -50,
                                    fontSize: '20px'
                                }
                            }
                        }
                    },
                    grid: {
                        padding: {
                            top: -10
                        }
                    },
                    colors: ["#6FD943"],
                    labels: ['Used'],
                };
                var chart = new ApexCharts(document.querySelector("#device-chart"), options);
                chart.render();
            })();
        </script>
    <?php endif; ?>



    <?php if(\Auth::user()->type == 'employee' || \Auth::user()->type == 'manager' || \Auth::user()->type == 'hr'): ?>
        
        <script>
            function getLocation(locationCallBack) {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            let location = {
                                latitude: position.coords.latitude,
                                longitude: position.coords.longitude
                            };
                            locationCallBack(location);
                        },
                        function(error) {
                            if (error.code === error.PERMISSION_DENIED) {
                                alert(
                                    "Location permission denied. Please enable location access in your browser settings."
                                );
                            } else {
                                alert("Error getting location: " + error.message);
                            }
                            locationCallBack(null);
                        }
                    );
                } else {
                    alert("Geolocation is not supported by this browser.");
                    locationCallBack(null);
                }
            }

            function createLocationField(targetForm, lat, long) {
                let latInput = document.createElement("input");
                latInput.setAttribute("value", lat);
                latInput.setAttribute("type", "hidden");
                latInput.setAttribute("name", "latitude");

                let longInput = document.createElement("input");
                longInput.setAttribute("value", long);
                longInput.setAttribute("type", "hidden");
                longInput.setAttribute("name", "longitude");

                targetForm.appendChild(latInput);
                targetForm.appendChild(longInput);

            }
        </script>

        
        <script src="<?php echo e(asset('js/userfingerprint.js')); ?>"></script>

        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('deviceIpIdentifier').onsubmit = function(event) {
                    event.preventDefault();
                    getFingerPrint(function(fingerprintValue) {
                        document.getElementById("deviceIp").value = fingerprintValue;
                        let form = event.target;
                        let device = fingerprintValue;
                        getLocation((location) => {
                            if (location) {
                                createLocationField(form, location.latitude, location.longitude);
                                // Submit the form
                                form.submit();
                            }
                        });

                    });
                }
            });
        </script>

        
        <script>
            function timeDown() {

                <?php if(!empty($employeeAttendance)): ?>
                    <?php
                        [$hours, $minutes] = explode(':', $employeeAttendance->clock_in);
                        $workHours = strtotime(auth()->user()->employee->work_end_time) - strtotime(auth()->user()->employee->work_start_time);
                        $workHours = $workHours / (60 * 60);
                        ?>
                        console.log(<?php echo e($workHours); ?>);
                    var startTime = new Date();
                    console.log(<?php echo e($hours); ?>);
                    console.log(startTime);
                    startTime.setHours(<?php echo e($hours); ?>);
                    startTime.setMinutes(<?php echo e($minutes); ?>);
                    startTime.setSeconds(0);
                    var targetTime = new Date(startTime.getTime());
                    targetTime.setHours(targetTime.getHours() + <?php echo e($workHours); ?>);

                    console.log('time: ', targetTime);



                    // Update the countdown every 1 second
                    var x = setInterval(function() {

                        // Get the current date and time
                        var now = new Date().getTime();

                        // Calculate the distance between now and the countdown date
                        var distance = targetTime - now;

                        // Calculate the days, hours, minutes, and seconds remaining
                        // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        // Display the countdown timer
                        document.getElementById("countdown").innerHTML = hours + "h " +
                            minutes + "m " + seconds + "s ";
                        document.getElementById("countdown").classList.remove("d-none");
                        // If the countdown is over, display a message
                        if (distance < 0) {
                            clearInterval(x);
                            document.getElementById("countdown").innerHTML = "EXPIRED";
                            let clockOutForm = document.getElementById('clockOutForm');

                            getFingerPrint(function(fingerprintValue) {
                                // Set the fingerprint value in the hidden input field
                                // document.getElementById("lockOutFingerprint").value = fingerprintValue;
                                // clock_in.disabled = false;
                                // clock_in.classList.remove("disabled");
                                // clock_out.disabled = true;
                                // clock_out.classList.add("disabled");
                                // // Submit the form
                                // clockOutForm.submit();
                            });

                        }
                    }, 1000);
                <?php endif; ?>
            }

            if (clock_in.disabled==true) {
                timeDown();
            }
        </script>


        
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                document.getElementById('clockInForm').onsubmit = function(event) {
                    event.preventDefault();
                    getFingerPrint(function(fingerprintValue) {
                        // Set the fingerprint value in the hidden input field
                        document.getElementById("lockInFingerprint").value = fingerprintValue;
                        let form = event.target;
                        getLocation((location) => {
                            if (location) {
                                createLocationField(form, location.latitude, location.longitude);
                                // Submit the form
                                form.submit();
                            }
                        });
                    });
                }

                document.getElementById('clockOutForm').onsubmit = function(event) {
                    event.preventDefault();
                    getFingerPrint(function(fingerprintValue) {
                        // Set the fingerprint value in the hidden input field
                        document.getElementById("lockOutFingerprint").value = fingerprintValue;
                        let form = event.target;
                        getLocation((location) => {
                            if (location) {
                                createLocationField(form, location.latitude, location.longitude);
                                // Submit the form
                                form.submit();
                            }
                        });
                    });
                }
            });
        </script>
    <?php endif; ?>




<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\OneDrive - اكاديمية انس للفنون البصرية\Desktop\hr\resources\views/dashboard/dashboard.blade.php ENDPATH**/ ?>