@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Devices Ip') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Employee') }}</li>
@endsection

@section('action-button')
    <a href="{{ route('employee.export') }}" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-original-title="{{ __('Export') }}" class="btn btn-sm btn-primary">
        <i class="ti ti-file-export"></i>
    </a>

    <a href="#" data-url="{{ route('employee.file.import') }}" data-ajax-popup="true"
        data-title="{{ __('Import  Employee CSV File') }}" data-bs-toggle="tooltip" title=""
        class="btn btn-sm btn-primary" data-bs-original-title="{{ __('Import') }}">
        <i class="ti ti-file"></i>
    </a>
    @can('Create Employee')
        <a href="#" data-title="{{ __('Create New Device') }}" data-bs-toggle="tooltip"
            title="" class="btn btn-sm btn-primary"
            data-url="{{ URL::to('create/ip')}}"
            data-ajax-popup="true" data-size="md"
            data-bs-original-title="{{ __('Add Device') }}">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    {{-- <h5></h5> --}}
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>{{ __('Index') }}</th>
                                    <th>{{ __('Device Identifier') }}</th>
                                    <th>{{ __('Device User') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Approved_by') }}</th>
                                    @if (Gate::check('Edit Employee') || Gate::check('Delete Employee'))
                                        <th width="200px">{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index=1;
                                @endphp
                                @foreach ($devices as $device)
                                    <tr>
                                        <td>
                                            {{$index++;}}
                                            {{-- @can('Show Employee')
                                                <a class="btn btn-outline-primary"
                                                    href="{{ route('employee.show', \Illuminate\Support\Facades\Crypt::encrypt($device->id)) }}">{{ \Auth::user()->employeeIdFormat($device->id) }}</a>
                                            @else
                                                <a href="#"
                                                    class="btn btn-outline-primary">{{ \Auth::user()->employeeIdFormat($device->id) }}</a>
                                            @endcan --}}
                                        </td>
                                        <td>{{ $device->ip }}</td>
                                        <td>{{ $device->user->name }}</td>
                                        <td>
                                            @if ($device->status == 'pending')
                                                <div class="badge bg-warning p-2 px-3 rounded status-badge5">
                                                    {{ $device->status }}</div>
                                            @elseif($device->status == 'approved')
                                                <div class="badge bg-success p-2 px-3 rounded status-badge5">
                                                    {{ $device->status }}</div>
                                            @elseif($device->status == 'rejected')
                                                <div class="badge bg-danger p-2 px-3 rounded status-badge5">
                                                    {{ $device->status }}</div>
                                            @endif
                                        </td>
                                        <td>{{ ($device->admin)? $device->admin->name : ""}}</td>


                                        <td class="Action">

                                            <span>
                                                @if (\Auth::user()->type != 'employee')
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                            data-size="lg"
                                                            data-url="{{ URL::to('ip/' . $device->id).'/action' }}"
                                                            data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                            title="" data-title="{{ __('Device Adding Action') }}"
                                                            data-bs-original-title="{{ __('Manage Device') }}">
                                                            <i class="ti ti-caret-right text-white"></i>
                                                        </a>
                                                    </div>
                                                    @can('Edit Leave')
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                                data-size="lg"
                                                                data-url="{{ URL::to('edit/ip/' . $device->id) }}"
                                                                data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                                title="" data-title="{{ __('Edit Device Ip') }}"
                                                                data-bs-original-title="{{ __('Edit') }}">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('Delete Leave')
                                                        @if (\Auth::user()->type != 'employee')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['destroy.ip', $device->id],
                                                                    'id' => 'delete-form-' . $device->id,
                                                                ]) !!}
                                                                <a href="#"
                                                                    class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    data-bs-original-title="Delete" aria-label="Delete"><i
                                                                        class="ti ti-trash text-white text-white"></i></a>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endcan
                                                @else
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                            data-size="lg"
                                                            data-url="{{ URL::to('leave/' . $device->id . '/action') }}"
                                                            data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                            title="" data-title="{{ __('Leave Action') }}"
                                                            data-bs-original-title="{{ __('Manage Leave') }}">
                                                            <i class="ti ti-caret-right text-white"></i>
                                                        </a>
                                                    </div>
                                                @endif

                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
