@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>
                        {{ !auth()->id() ?  __('general.accident_reporting') : trans('general.report_types')}}
                    </h5>
                </div>

                <div class="card-body mx-5">
                    @can('isUser')
                        <div class="row justify-content-center align-items-center my-5">
                            <h1 class="text-center">@lang('general.welcome_message')</h1>
                        </div>
                    @else
                        <div class="row justify-content-center align-items-center my-5">
                            <h1 class="text-center">@lang('general.officer_welcome_message')</h1>
                        </div>
                    @endcan
                    <div class="row">
                        @auth
                            @foreach($elements as $element)
                                <div class="col-lg-4 mb-3 {!! !auth()->user()->can('isAdminOrOfficer') && $element->name === 'Traffic Violation'  ? 'd-none' : '' !!}">
                                    <div class="card" style="max-width: 18rem;">
                                        <img class="card-img-top img-fluid"
                                             src="{{ $element->getImageThumbLinkAttribute() }}"
                                             alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">
                                                {{ $element->name }}
                                            </h5>
                                            <h6 class="card-title text-sm d-none">
                                                {{ trans('general.hot_line') }} : {{ $element->hot_line }}
                                            </h6>
                                            <p class="card-text d-none"
                                               style="height: 8em;">{{ Str::limit($element->description,60) }}</p>
                                            @can('isUser')
                                                <div class="text-md-right">
                                                    <a href="{{ route('public.create', ['report_type_id' => $element->id]) }}"
                                                       class="btn btn-danger text-md-right">{{ trans('general.process_report') }}</a>
                                                </div>
                                            @else
                                                <div class="text-md-right">
                                                    <a href="{{ route('report.create', ['report_type_id' => $element->id]) }}"
                                                       class="btn btn-danger text-md-right">{{ trans('general.process_report') }}</a>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else

                            <div class="card m-auto">
                                <div class="card-header">
                                    @lang('general.login')
                                </div>
                                <div class="card-body">
                                    {{--                             login --}}
                                    <form method="POST" action="{{ route('check.civil') }}" class="mb-3">
                                        <input type="hidden" name="is_officer"
                                               value="{{ request()->is_officer }}"
                                        >
                                        @csrf
                                        <div class="form-group row">
                                            <label for="civil_id"
                                                   class="col-md-3 col-form-label text-md-right">{{ __('general.civil_id') }}</label>

                                            <div class="col-md-9">
                                                <input id="civil_id_no" type="civil_id_no"
                                                       class="form-control @error('civil_id_no') is-invalid @enderror"
                                                       name="civil_id_no" value="{{ old('civil_id_no') }}"
                                                       required
                                                       autocomplete="civil_id_no" autofocus>

                                                @error('civil_id_no')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password"
                                                   class="col-md-3 col-form-label text-md-right">{{ __('general.password') }}</label>
                                            <div class="col-md-9">
                                                <input id="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" required autocomplete="current-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-12 text-md-right">
                                                <button type="submit" class="btn btn-danger ">
                                                    @lang('general.submit')
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <a href="{{ route('password.request') }}"
                                       class="btn btn-outline-danger">{{ trans('general.forget_password') }}</a>
                                    <a href="{{ route('register', ['is_officer' => false]) }}"
                                       class="btn btn-outline-dark">@lang('general.public_register')</a>
                                    <a href="{{ route('register', ['is_officer' => false]) }}"
                                       class="btn btn-outline-info">@lang('general.officer_register')</a>
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
                        {{--                             btns--}}
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-danger">{{ trans('general.officer_login') }}</h5>
                                    <p class="card-text">{{ trans('general.officer_username') }} : 2222</p>
                                    <p class="card-text">{{ trans('general.file_no') }} : 2222</p>
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
