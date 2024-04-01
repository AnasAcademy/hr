@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif


{{ Form::open(['route' => ['store.ip'], 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group">
            @error('ip')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            {{ Form::label('ip', __('Device Ip'), ['class' => 'col-form-label']) }}
            {{ Form::text('ip', null, ['class' => 'form-control', 'placeholder' => 'Enter the Device Identifier']) }}
        </div>
        <div class="form-group">
            @error('user_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            {{ Form::label('user_id', __('User Name'), ['class' => 'col-form-label']) }}

            <select name="user_id" id="user_id" class="form-control">
                <option value="0" selected disabled>Select The owner of this Location</option>

                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            @error('latitude')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            {{ Form::label('latitude', __('Device latitude'), ['class' => 'col-form-label']) }}
            <input class="form-control" type="text" name="latitude" placeholder="Enter latitude Degree"
                id="latitude" value="{{ $device->latitude }}">
        </div>

        <div class="form-group">
            @error('longitude')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            {{ Form::label('longitude', __('Device longitude'), ['class' => 'col-form-label']) }}
            <input class="form-control" type="text" name="longitude" placeholder="Enter longitude Degree"
                id="longitude" value="{{ $device->longitude }}">
        </div>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">

</div>
{{ Form::close() }}
