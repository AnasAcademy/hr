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
        $data = AttendanceEmployee::where('created_by', \Auth::user()->creatorId())->get();
        if (\Auth::user()->type == 'employee') {
            $employee = $user->employee;

            $data = AttendanceEmployee::where('employee_id', '=', $employee->id)->where('created_by', \Auth::user()->creatorId())->get();
        }
        // else{
        //     $data= AttendanceEmployee::where('created_by', \Auth::user()->creatorId())->get();
        //     foreach($data as $k=>$attendance)
        //     {
        //         $data[$k]["employee_id"]=Employee::employee_name($attendance->employee_id);
        //         $data[$k]["leave_type_id"]= !empty(\Auth::user()->getLeaveType($attendance->leave_type_id))?\Auth::user()->getLeaveType($attendance->leave_type_id)->title:'';
        //         unset($attendance->created_at,$attendance->updated_at);
        //     }
        //     return $data;

        // }
        foreach ($data as $k => $attendance) {
            $data[$k]["employee_id"] = Employee::employee_name($attendance->employee_id);
            $data[$k]["clock_in_ip"] = IpRestrict::find($attendance->clock_in_ip)->ip;
            $data[$k]["clock_out_ip"] = IpRestrict::find($attendance->clock_out_ip)->ip;

            unset($attendance->created_at, $attendance->updated_at, $attendance->created_by);
        }

        return $data;
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
            "OverTime"
        ];
    }
}
