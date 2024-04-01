{{ Form::model($device, ['route' => ['edit.ip', $device->id], 'method' => 'POST']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group">
            {{ Form::label('ip', __('Device IP'), ['class' => 'col-form-label']) }}
            <input class="form-control" type="text" name="ip" placeholder="Enter Ip Address" id="ip" value="{{$device->ip}}">
        </div>
        <div class="form-group">
            {{ Form::label('user_id', __('User Name'), ['class' => 'col-form-label']) }}
            <select name="user_id" id="user_id" class="form-control">
                <option value="0" selected disabled>Select The owner of this Ip</option>

                @foreach ($users as $user )

                <option value="{{$user->id}}" @if ($device->user_id == $user->id) selected @endif>
                    {{$user->name}}</option>

                @endforeach

               </select>
        </div>
        <div class="form-group">
            {{ Form::label('latitude', __('Device latitude'), ['class' => 'col-form-label']) }}
            <input class="form-control" type="text" name="latitude" placeholder="Enter latitude Degree" id="latitude" value="{{$device->latitude}}">
        </div>

        <div class="form-group">
            {{ Form::label('longitude', __('Device longitude'), ['class' => 'col-form-label']) }}
            <input class="form-control" type="text" name="longitude" placeholder="Enter longitude Degree" id="longitude" value="{{$device->longitude}}">
        </div>
        
        <div class="form-group">
            {{ Form::label('status', __('status'), ['class' => 'col-form-label']) }}
            <select name="status" id="status" class="form-control">
                <option value="0" selected disabled>Select The Status of this Ip</option>

                <option value="pending" @if ($device->status == 'pending') selected @endif > Pending</option>
                <option value="approved" @if ($device->status == 'approved') selected @endif> Approved </option>
                <option value="rejected" @if ($device->status == 'rejected') selected @endif>Rejected</option>



               </select>
        </div>


    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
    <input type="submit" value="{{ __('Update') }}" class="btn  btn-primary">

</div>
{{ Form::close() }}
