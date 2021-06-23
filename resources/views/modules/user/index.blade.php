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
                            <th scope="col"><small>{{ __('general.name') }}</small></th>
                            <th scope="col">{{ __('general.civil_id_no') }}</th>
                            <th scope="col">{{ __('general.passport_no') }}</th>
                            <th scope="col">{{ __('general.police_no') }}</th>
                            <th scope="col">{{ __('general.mobile') }}</th>
                            <th scope="col">{{ __('general.personal_image') }}</th>
                            <th scope="col">{{ __('general.address') }}</th>
                            <th scope="col">{{ __('general.role') }}</th>
                            <th scope="col">{{ __('general.governate') }}</th>
                            <th scope="col">{{ __('general.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($elements->isNotEmpty())
                            @foreach($elements as $element)
                                <tr>
                                    <th scope="row">{{ $element->id }}</th>
                                    <td>{{ $element->name }}</td>
                                    <td>{{ $element->civil_id_no }}</td>
                                    <td>{{ $element->passport_no }}</td>
                                    <td>{{ $element->police_no }}</td>
                                    <td>{{ $element->mobile }}</td>
                                    <td><img class="img-xxs" src="{{ $element->getImageThumbLinkAttribute('personal_image') }}"
                                             alt="{{ str_limit($element->description,5) }}"></td>
                                    <td>{{ str_limit($element->address,10) }}</td>
                                    <td><span
                                            class="alert alert-info"><small>{{ $element->is_officer ? __('general.officer') : __('general.user') }}</small></span>
                                    </td>
                                    <td><smal>{{ str_limit($element->governate->name,10) }}</smal></td>
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
                                                       href="{{ route('user.edit', $element->id) }}">{{ trans('general.edit') .' '. trans('general.user')}}</a>
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
