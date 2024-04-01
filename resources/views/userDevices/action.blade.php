<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <table class="table modal-table" id="pc-dt-simple">
                <tr role="row">
                    <th>{{ __('Device IP') }}</th>
                    <td>{{ !empty($device->ip) ? $device->ip : '' }}</td>
                </tr>
                <tr>
                    <th>{{ __('User ') }}</th>
                    <td>{{ !empty($device->user) ? $device->user->name : '' }}</td>
                </tr>
                <tr>
                    <th>{{ __('Status') }}</th>
                    <td>{{ $device->status }}</td>
                </tr>
                <tr>
                    <th>{{ __('Latitude') }}</th>
                    <td>{{ $device->latitude }}</td>
                </tr>
                <tr>
                    <th>{{ __('Longitude') }}</th>
                    <td>{{ $device->longitude }}</td>
                </tr>
                <tr>
                    <th>{{ __('Created At') }}</th>
                    <td>{{ \Auth::user()->dateFormat($device->date) }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

@can('Manage Device')
    <div class="modal-footer">
        {{ Form::open(['url' => 'ip/' . $device->id . '/approve', 'method' => 'post']) }}
        <input type="submit" value="{{ __('Approved') }}" class="btn btn-success rounded" name="status">
        {{ Form::close() }}
        {{ Form::open(['url' => 'ip/' . $device->id . '/reject', 'method' => 'post']) }}
        <input type="submit" value="{{ __('Reject') }}" class="btn btn-danger rounded" name="status">
        {{ Form::close() }}
    </div>
@endcan
