<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\IpRestrict;

class DeviceIpController extends Controller
{
    //

    public function index(){
        $devices = IpRestrict::get();

        return view("restrict_ip.index", ['devices' => $devices]);
    }
    public function createIp()
    {
        $users = User::get();
        return view('restrict_ip.create', ["users" => $users]);
    }

    public function storeIp(Request $request)
    {
        if (\Auth::user()->type == 'employee') {
            $validator = \Validator::make(
                $request->all(),
                [
                    'deviceIp' => 'required'
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $exist = IpRestrict::where('ip', $request['deviceIp'])->first();
            if($exist) {
                return redirect()->back()->with('error', __('this Device is already Added'));
            }

            $ip             = new IpRestrict();
            $ip->ip         = $request->deviceIp;
            $ip->belongs_to  = \Auth::user()->id;
            $ip->created_by = \Auth::user()->creatorId();
            $ip->save();

            return redirect()->back()->with('success', __('Device Added Successfully wait the admin to approve'));
        }
        else if (\Auth::user()->type == 'company' || \Auth::user()->type == 'super admin') {
            $validator = \Validator::make(
                $request->all(),
                [
                    'deviceIp' => 'required',
                    'belongs_to' =>'required|exists:users,id'
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $ip             = new IpRestrict();
            $ip->ip         = $request->deviceIp;
            $ip->belongs_to  = $request->belongs_to;
            $ip->created_by = \Auth::user()->creatorId();
            $ip->approved_by = \Auth::user()->id;
            $ip->status = 'approved';
            $ip->save();

            return redirect()->back()->with('success', __('Device Added Successfully'));

        }
        else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function editIp($id)
    {
        $device = IpRestrict::find($id);
        $users =  $users = User::get();
        return view('restrict_ip.edit', compact('device', 'users'));
    }
    public function action($id)
    {
        $device = IpRestrict::find($id);

        return view('restrict_ip.action', compact('device'));
    }

    public function updateIp(Request $request, $id)
    {
        if (\Auth::user()->type == 'company' || \Auth::user()->type == 'super admin') {
            $validator = \Validator::make(
                $request->all(),
                [
                    'ip' => 'required',
                    'belongs_to' => 'required',
                    'status' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $ip     = IpRestrict::find($id);
            $ip->update($request->all());
            $ip->save();

            return redirect()->back()->with('success', __('IP successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroyIp($id)
    {
        if (\Auth::user()->type == 'company' || \Auth::user()->type == 'super admin') {
            $ip = IpRestrict::find($id);
            $ip->delete();

            return redirect()->back()->with('success', __('IP successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function approveIp($id)
    {
        if (\Auth::user()->type == 'company' || \Auth::user()->type == 'super admin') {
            $ip = IpRestrict::find($id);
            $ip->update(["status" =>"approved", "approved_by" => \Auth::user()->id]);

            return redirect()->back()->with('success', __('IP successfully Approved.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function rejectIp($id)
    {
        if (\Auth::user()->type == 'company' || \Auth::user()->type == 'super admin') {
            $ip = IpRestrict::find($id);
            $ip->update(["status" =>"rejected", "approved_by" => \Auth::user()->id]);

            return redirect()->back()->with('success', __('IP successfully Rejected.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
