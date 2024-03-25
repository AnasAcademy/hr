<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\AttendanceEmployee;
use App\Models\IpRestrict;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $user     = \Auth::user();
        // $attendanceEmployee = AttendanceEmployee::get();
        if ($user->type == 'employee') {
            $employee = $user->employee;
            $attendanceEmployee = AttendanceEmployee::where('employee_id', $employee->id)->get();
        } else {
            if ($user->type == 'manager') {

                $employees = Employee::select('id')->where("user_id", "!=", $user->id)->whereHas('department', function ($query) use ($user) {
                    $query->where('manager_id', $user->id);
                });
            } else if ($user->type == 'leadership') {

                $employees = Employee::select('id')->where("user_id", "!=", $user->id)->whereHas('user', function ($query) use ($user) {
                    $query->where('type', 'manager');
                });
            } else {
                $employees = Employee::select('id')->where('created_by',$user->creatorId());
            }

            $attendanceEmployee = AttendanceEmployee::whereIn('employee_id', $employees)->get();
        }

        // dd($attendanceEmployee);
        foreach ($attendanceEmployee as $k => $attendance) {
            $singleEmployee = Employee::find($attendance->employee_id);
           $attendance["employee_id"] = $singleEmployee->name;
           $attendance["department"] = $singleEmployee->department->name ?? null;
           $attendance["employee_role"] = $singleEmployee->user->type;
           $attendance["clock_in_ip"] = IpRestrict::find($attendance->clock_in_ip)->ip ?? null;
           $attendance["clock_out_ip"] = IpRestrict::find($attendance->clock_out_ip)->ip ?? null;
           $attendance["clock_in"] = $user->timeFormat($attendance["clock_in"]);
           $attendance["clock_out"] = $user->timeFormat($attendance["clock_out"]);


            unset($attendance->created_at, $attendance->updated_at, $attendance->created_by,  $attendance->total_rest);
        }

        return $attendanceEmployee;
    }

    public function headings(): array
    {
        return [
            "ID",
            "Employee Name",
            "Date ",
            "Status",
            "Clock In Time",
            "Clock Out Time",
            "Late Hours",
            "Ealry Leaving Hours",
            "OverTime",
            "Clock In Device FingerPrint",
            "Clock Out Device FingerPrint",
            "Department",
            "Employee Role"
        ];
    }
}
