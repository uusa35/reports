@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>
                        {{ !auth()->id() ?  __('general.login') : trans('general.report_types')}}
                    </h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        @auth
                            @foreach($elements as $element)
                                <div class="col-lg-4 mb-3">
                                    <div class="card" style="max-width: 18rem;">
                                        <img class="card-img-top img-fluid" src="{{ $element->getImageThumbLinkAttribute() }}"
                                             alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title text-center"><a href="{{ route('report.create') }}">
                                                    {{ $element->name }}
                                                </a></h5>
                                            <h6 class="card-title text-sm">
                                                {{ trans('general.hot_line') }} : {{ $element->hot_line }}
                                            </h6>
                                            <p class="card-text" style="height: 8em;">{{ Str::limit($element->description,60) }}</p>
                                            <div class="text-md-right">
                                                <a href="{{ route('report.create', ['report_type_id' => $element->id]) }}"
                                                   class="btn btn-danger text-md-right">{{ trans('general.process_report') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ trans('general.officer') }}</h5>
                                        <p class="card-text">{{ trans('general.officer_login') }}</p>
                                        <div class="text-md-right">
                                            <a href="{{ route('check.civil', ['is_officer' => true]) }}"
                                               class="btn btn-outline-dark">{{ trans('general.officer_login') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ trans('general.user') }}</h5>
                                        <p class="card-text">{{ trans('general.user_login') }}</p>
                                        <div class="text-md-right">
                                            <a href="{{ route('check.civil', ['is_officer' => false ]) }}"
                                               class="btn btn-outline-primary">{{ trans('general.user_login') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>


            @guest
                <hr>
                <div class="card">
                    <div class="card-header">
                        <h5>
                            {{ trans('general.instructions') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-danger">{{ trans('general.officer_login') }}</h5>
                                        <p class="card-text">{{ trans('general.officer_username') }} : 2222</p>
                                        <p class="card-text">{{ trans('general.officer_police_no') }} : 2222</p>
                                        <p class="card-text">{{ trans('general.password_is') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-danger">{{ trans('general.user_login') }}</h5>
                                        <p class="card-text">{{ trans('general.officer_username') }} : 3333</p>
                                        <p class="card-text">{{ trans('general.user_passport_no') }} : 3333</p>
                                        <p class="card-text">{{ trans('general.password_is') }}</p>
                                        <p class="card-text text-danger">
                                            * {{ trans('general.admin_login_instruction') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </div>
@endsection
