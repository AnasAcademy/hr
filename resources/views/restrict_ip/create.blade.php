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
            @error('deviceIp')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
            {{ Form::label('deviceIp', __('Device Identifier'), ['class' => 'col-form-label']) }}
            {{ Form::text('deviceIp', null, ['class' => 'form-control', 'placeholder' => 'Enter the Device Identifier']) }}
        </div>
        <div class="form-group">
            @error('belongs_to')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
            {{ Form::label('belongs_to', __('belongs_to'), ['class' => 'col-form-label']) }}

           <select name="belongs_to" id="belongs_to" class="form-control">
            <option value="0" selected disabled>Select The owner of this Ip</option>

            @foreach ($users as $user )

            <option value="{{$user->id}}">{{$user->name}}</option>

            @endforeach

           </select>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">

</div>
{{ Form::close() }}
