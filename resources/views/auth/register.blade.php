@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4 class="display-6 text-center">{{ __('general.register') }}</h4></div
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="is_officer" value="{{ request()->has('is_officer') ? request()->is_officer : false }}">
                            <input type="hidden" name="governate_id" value="{{ $governates->first()->id }}">
                            <div class="form-group row mt-5">
                                <label for="first_name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.first_name') }}</label>
                                <div class="col-md-6">
                                    <input id="first_name" type="text"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           name="first_name"
                                           value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="father_name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.father_name') }}</label>
                                <div class="col-md-6">
                                    <input id="father_name" type="text"
                                           class="form-control @error('father_name') is-invalid @enderror"
                                           name="father_name"
                                           value="{{ old('father_name') }}" required autocomplete="father_name"
                                           autofocus>
                                    @error('father_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sur_name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.sur_name') }}</label>
                                <div class="col-md-6">
                                    <input id="sur_name" type="text"
                                           class="form-control @error('sur_name') is-invalid @enderror"
                                           name="sur_name"
                                           value="{{ old('sur_name') }}" required autocomplete="sur_name"
                                           autofocus>
                                    @error('sur_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.civil_id') }}</label>

                                <div class="col-md-6">
                                    <input id="civil_id_no" type="text"
                                           maxlength="15"
                                           class="form-control @error('civil_id_no') is-invalid @enderror"
                                           name="civil_id_no"
                                           value="{{ old('civil_id_no') }}" required autocomplete="civil_id_no"
                                           autofocus>
                                    @error('civil_id_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if(!request()->is_officer)
{{--                                 public --}}
                                <div class="form-group row">
                                    <label for="reference_no"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.reference_no') }}</label>
                                    <div class="col-md-6">
                                        <input id="reference_no" type="text"
                                               class="form-control @error('reference_no') is-invalid @enderror"
                                               name="reference_no"
                                               value="{{ old('reference_no') }}" required autocomplete="reference_no"
                                               autofocus>
                                        @error('reference_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                                {{--  address --}}
                                <div class="form-group row">
                                    <label for="governate"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.governate') }}</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="exampleFormControlSelect1"
                                                name="governate_id"
                                        >
                                            @foreach($governates as $gov)
                                                <option value="{{ $gov->id }}">{{ $gov->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('governate')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
{{--                             city --}}
                                <div class="form-group row">
                                    <label for="city"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.city') }}</label>
                                    <div class="col-md-6">
                                        <input id="city" type="text"
                                               class="form-control @error('city') is-invalid @enderror"
                                               name="city"
                                               value="{{ old('city') }}" required autocomplete="city"
                                               autofocus>
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="block"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.block') }}</label>
                                    <div class="col-md-6">
                                        <input id="block" type="text"
                                               class="form-control @error('block') is-invalid @enderror"
                                               name="block"
                                               value="{{ old('block') }}" required autocomplete="block"
                                               autofocus>
                                        @error('block')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="street"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.street') }}</label>
                                    <div class="col-md-6">
                                        <input id="street" type="text"
                                               class="form-control @error('street') is-invalid @enderror"
                                               name="street"
                                               value="{{ old('street') }}" autocomplete="street"
                                               autofocus>
                                        @error('street')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
{{-- house no--}}
                                <div class="form-group row">
                                    <label for="house_no"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.house_no') }}</label>
                                    <div class="col-md-6">
                                        <input id="house_no" type="text"
                                               class="form-control @error('house_no') is-invalid @enderror"
                                               name="house_no"
                                               value="{{ old('house_no') }}" autocomplete="house_no"
                                               autofocus>
                                        @error('house_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.mobile') }}</label>
                                    <div class="col-md-6">
                                        <input id="mobile" type="number"
                                               class="form-control @error('mobile') is-invalid @enderror"
                                               name="mobile"
                                               value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>
                                        @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

{{--                                 image --}}


                                <div class="form-group row">
                                    <label for="personal_image"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.personal_image') }}</label>

                                    <div class="col-md-6">
                                        <input id="personal_image" type="file"
                                               class="form-control @error('personal_image') is-invalid @enderror"
                                               name="personal_image"
                                               value="{{ old('personal_image') }}" autocomplete="personal_image"
                                               autofocus>
                                        @error('personal_image')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <label for="file_no"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.file_no') }}</label>
                                    <div class="col-md-6">
                                        <input id="file_no" type="text"
                                               class="form-control @error('file_no') is-invalid @enderror"
                                               name="file_no"
                                               value="{{ old('file_no') }}" required autocomplete="file_no"
                                               autofocus>
                                        @error('file_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="work_number"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.work_number') }}</label>
                                    <div class="col-md-6">
                                        <input id="work_number" type="text"
                                               class="form-control @error('work_number') is-invalid @enderror"
                                               name="work_number"
                                               value="{{ old('work_number') }}" required autocomplete="work_number"
                                               autofocus>
                                        @error('work_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           placeholder="@lang('general.password_instruction')"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.password_confirmation') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            @lang('general.agree_on_terms_and_condition')
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary disabled" id="submitBtn">
                                        {{ __('general.register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            console.log('here');
            $('#defaultCheck1').click(function () {
                $('#submitBtn').toggleClass('disabled');
            });
        });
    </script>
    @endsection


