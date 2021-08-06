@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="margin-top: 25%">
                    <div class="card-header">{{ __('general.login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('check.civil') }}">
                            <input type="hidden" name="is_officer" value="{{ request()->is_officer }}">
                            @csrf
                            <div class="form-group row">
                                <label for="civil_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.civil_id') }}</label>

                                <div class="col-md-6">
                                    <input id="civil_id_no" type="text"
                                           class="form-control @error('civil_id_no') is-invalid @enderror"
                                           name="civil_id_no" value="{{ old('civil_id_no') }}" required
                                           autocomplete="civil_id_no" autofocus>

                                    @error('civil_id_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('general.password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @if(request()->is_officer)
                                <div class="form-group row">
                                    <label for="file_no"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.file_no') }}</label>
                                    <div class="col-md-6">
                                        <input id="file_no" type="text"
                                               class="form-control @error('file_no') is-invalid @enderror"
                                               name="file_no" value="{{ old('file_no') }}" required
                                               autocomplete="file_no"
                                               autofocus/>

                                        @error('file_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <label for="civil_id"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.passport_no') }}</label>
                                    <div class="col-md-6">
                                        <input id="passport_no" type="text"
                                               class="form-control @error('passport_no') is-invalid @enderror"
                                               name="passport_no" value="{{ old('passport_no') }}" required
                                               autocomplete="passport_no"
                                               autofocus/>
                                        @error('passport_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ request()->is_officer ? __('general.officer_login') : trans('general.user_login')}}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection
