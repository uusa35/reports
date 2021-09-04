@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>
                        {{ __('general.vehicle') }}
                    </h4>
                </div>

                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('general.id') }}</th>
                            <th scope="col"><small>{{ __('general.plate_no') }}</small></th>
                            <th scope="col">{{ __('general.model') }}</th>
                            <th scope="col">{{ __('general.color') }}</th>
                            <th scope="col">{{ __('general.model_year') }}</th>
                            <th scope="col">{{ __('general.insurance_no') }}</th>
                            <th scope="col">{{ __('general.insurance_company') }}</th>
                            <th scope="col">{{ __('general.insurance_start_date') }}</th>
                            <th scope="col">{{ __('general.insurance_expiry_date') }}</th>
                            <th scope="col">{{ __('general.user') }}</th>
                            <th scope="col">{{ __('general.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($elements->isNotEmpty())
                            @foreach($elements as $element)
                                <tr>
                                    <th scope="row">{{ $element->id }}</th>
                                    <td>{{ $element->plate_no }}</td>
                                    <td>{{ $element->model }}</td>
                                    <td>{{ $element->color }}</td>
                                    <td>{{ $element->model_year }}</td>
                                    <td>{{ $element->insurance_no }}</td>
                                    <td>{{ $element->insurance_company }}</td>
                                    <td>{{ $element->insurance_start_date->format('Y/m/d') }}</td>
                                    <td>{{ $element->insurance_expiry_date->format('Y/m/d') }}</td>
                                    <td>{{ $element->user->name }}</td>
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
                                                @can('isAdmin')
                                                    <a class="dropdown-item"
                                                       href="{{ route('vehicle.edit', $element->id) }}">{{ trans('general.edit') .' '. trans('general.vehicle')}}</a>
                                                @endcan
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
