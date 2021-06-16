@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h4>
                    {{ __('general.reports') }}
                </h4>
            </div>

            <div class="card-body">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('general.id') }}</th>
                        <th scope="col"><small>{{ __('general.reference_id') }}</small></th>
                        <th scope="col">{{ __('general.has_injuries') }}</th>
                        <th scope="col">{{ __('general.is_closed') }}</th>
                        <th scope="col">{{ __('general.image') }}</th>
                        <th scope="col">{{ __('general.area') }}</th>
                        <th scope="col">{{ __('general.address') }}</th>
                        <th scope="col">{{ __('general.report_owner') }}</th>
                        <th scope="col">{{ __('general.officer') }}</th>
                        <th scope="col">{{ __('general.report_type') }}</th>
                        <th scope="col">{{ __('general.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($elements->isNotEmpty())
                        @foreach($elements as $element)
                            <tr>
                                <th scope="row">{{ $element->id }}</th>
                                <td>{{ $element->reference_id }}</td>
                                <td><span
                                        class="alert alert-{{ $element->has_injuries ? 'danger' : 'info' }}"><small>{{ $element->has_injuries ? __('general.has_injuries') : __('general.n_a') }}</small></span>
                                </td>
                                <td><span
                                        class="alert alert-{{ $element->is_closed ? 'success' : 'secondary' }}"><small>{{ $element->is_closed ? __('general.is_closed') : __('general.n_a') }}</small></span>
                                </td>
                                <td><img class="img-xxs" src="{{ $element->getImageThumbLinkAttribute() }}"
                                         alt="{{ str_limit($element->notes,5) }}"></td>
                                <td>{{ $element->area ? $element->area : trans('general.n_a') }}</td>
                                <td>{{ str_limit($element->address,10) }}</td>
                                <td>{{ $element->owner->name }}</td>
                                <td>{{ str_limit($element->officer->name,5) }} - {{ $element->officer->speciality->name }}</td>
                                <td>{{ $element->type->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-default btn-outline-dark btn-sm dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="fa fa-fw fa-info"></i>
                                            {{ __('general.actions') }}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                               href="{{ route('report.show', $element->id) }}">{{ trans('general.view') .' '. trans('general.report')}}</a>
                                            @can('isAdminOrOfficer')
                                                <a class="dropdown-item"
                                                   href="{{ route('report.edit', $element->id) }}">{{ trans('general.edit') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <div class="alert alert-info">{{ __('general.no_elements') }}</div>
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