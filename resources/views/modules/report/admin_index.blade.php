@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="btn-group btn-group-toggle my-4">
                @foreach($departments as $dep)
                    <a class="btn btn-secondary active"
                       href="{{ route('report.search', ['type' => 'department_id', 'value' => $dep->id]) }}">
                        <span>{{ $dep->name }}</span>
                    </a>
                @endforeach
                <a class="btn btn-outline-danger active"
                   href="{{ route('report.index') }}">
                    <span>@lang('general.all_reports')</span>
                </a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>
                        @lang('general.reports')
                    </h4>
                </div>

                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">@lang('general.id') </th>
                            <th scope="col"><small>@lang('general.reference_id') </small></th>
                            <th scope="col">@lang('general.status') </th>
                            <th scope="col">@lang('general.created_at') </th>
                            <th scope="col">@lang('general.area') </th>
                            <th scope="col">@lang('general.report_owner') </th>
                            <th scope="col">@lang('general.officer') </th>
                            <th scope="col">@lang('general.report_type') </th>
                            <th scope="col">@lang('general.action') </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($elements->isNotEmpty())
                            @foreach($elements as $element)
                                <tr>
                                    <th scope="row">{{ $element->id }}</th>
                                    <td>{{ $element->reference_id }}</td>
                                    <td><span
                                            class="alert alert-{{ $element->is_closed ? 'danger' : 'info' }}"><small>{{ $element->is_closed ? __('general.is_closed') : __('general.open') }}</small></span>
                                    </td>
                                    <td>{{ $element->created_at ? $element->created_at->format('Y/m/d')  : ''}}</td>
                                    <td>{{ $element->area ? $element->area : trans('general.n_a') }}</td>
                                    <td>{{ $element->owner->name }}</td>
                                    <td>{{ $element->officer ? str_limit($element->officer->name,5)  : 'N/A' }}</td>
                                    <td>{{ $element->type->name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default btn-outline-dark btn-sm dropdown-toggle"
                                                    type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="fa fa-fw fa-info"></i>
                                                {{ __('general.actions') }}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @can('isUser')
                                                    <a class="dropdown-item"
                                                       href="{{ route('public.show', $element->id) }}">{{ trans('general.view') .' '. trans('general.report')}}</a>
                                                @else
                                                    <a class="dropdown-item"
                                                       href="{{ route('report.show', $element->id) }}">{{ trans('general.view') .' '. trans('general.report')}}</a>
                                                @endcan
                                                @can('isAdminOrOfficer')
                                                    <a class="dropdown-item"
                                                       href="{{ route('report.edit', $element->id) }}">@lang('general.edit')</a>
                                                    <a class="dropdown-item"
                                                       href="{{ route('add.vehicle', ['id' => $element->id]) }}">@lang('general.add_vehicles')</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <div class="alert alert-info">@lang('general.no_elements')</div>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="col-lg-12">
                        <div class="float-left">
                            {{ $elements->isNotEmpty() ? $elements->render('pagination::bootstrap-4') : null }}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
