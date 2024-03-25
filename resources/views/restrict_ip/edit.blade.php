{{ Form::model($device, ['route' => ['edit.ip', $device->id], 'method' => 'POST']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group">
            {{ Form::label('ip', __('Device Identifier'), ['class' => 'col-form-label']) }}
            <input class="form-control" type="text" name="ip" placeholder="Enter Ip Address" id="ip" value="{{$device->ip}}">
        </div>
        <div class="form-group">
            {{ Form::label('belongs_to', __('belongs_to'), ['class' => 'col-form-label']) }}
            <select name="belongs_to" id="belongs_to" class="form-control">
                <option value="0" selected disabled>Select The owner of this Ip</option>

                @foreach ($users as $user )

                <option value="{{$user->id}}" @if ($device->belongs_to == $user->id) selected @endif>
                    {{$user->name}}</option>

                @endforeach

               </select>
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
