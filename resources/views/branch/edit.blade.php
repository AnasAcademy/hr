
{{ Form::model($branch, ['route' => ['branch.update', $branch->id], 'method' => 'PUT']) }}
<div class="modal-body">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                  
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Branch Name')]) }}
                </div>
                @error('name')
                    <span class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('timezone', __('Timezone'), ['class' => 'col-form-label']) }}
                
                <select type="text" name="timezone" class="form-control select2"
                    id="timezone">
                    <option value="">{{ __('Select Timezone') }}</option>
                    @if (!empty($timezones))
                        @foreach ($timezones as $k => $timezone)
                            <option value="{{ $k }}"
                                {{ $branch['timezone'] == $k ? 'selected' : '' }}>
                                {{ $timezone }}</option>
                        @endforeach
                    @endif
                </select>
                @error('timezone')
                    <span class="invalid-timezone" role="alert">
                        <small class="text-danger">{{ $message }}</small>
                    </span>
                @enderror

            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update') }}" class="btn btn-primary">
</div>
{{ Form::close() }}
