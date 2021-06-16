@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h4>
                    {{ __('general.report_types') }}
                </h4>
            </div>

            <div class="card-body">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('general.id') }}</th>
                        <th scope="col">{{ __('general.image') }}</th>
                        <th scope="col">{{ __('general.hot_line') }}</th>
                        <th scope="col">{{ __('general.notes') }}</th>
                        <th scope="col">{{ __('general.description') }}</th>
                        <th scope="col">{{ __('general.active') }}</th>
                        <th scope="col">{{ __('general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($elements->isNotEmpty())
                        @foreach($elements as $element)
                            <tr>
                                <th scope="row">{{ $element->id }}</th>
                                <td><img class="img-xxs" src="{{ $element->getImageThumbLinkAttribute() }}"
                                         alt="{{ str_limit($element->notes,5) }}"></td>
                                <td>{{ $element->hot_line }}</td>
                                <td>{{ str_limit($element->notes,20) }}</td>
                                <td>{{ str_limit($element->description,20) }}</td>
                                <td><span
                                        class="alert alert-{{ $element->active ? 'success' : 'danger' }}"><small>{{ $element->active ? __('general.activated') : __('general.n_a') }}</small></span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-default btn-outline-dark btn-sm dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="fa fa-fw fa-info"></i>
                                            {{ __('general.actions') }}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
{{--                                            <a class="dropdown-item"--}}
{{--                                               href="{{ route('type.show', $element->id) }}">{{ trans('general.view') .' '. trans('general.report')}}</a>--}}
                                            @can('isAdmin')
                                                <a class="dropdown-item"
                                                   href="{{ route('type.edit', $element->id) }}">{{ trans('general.edit') }}</a>
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
