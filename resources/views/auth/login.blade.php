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
