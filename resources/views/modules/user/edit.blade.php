@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4 class="display-6 text-center">{{ __('general.edit') }}</h4></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update', $element->id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.first_name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           name="first_name"
                                           value="{{ $element->first_name }}" required autocomplete="first_name"
                                           autofocus>

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.father_name') }}</label>

                                <div class="col-md-6">
                                    <input id="father_name" type="text"
                                           class="form-control @error('father_name') is-invalid @enderror"
                                           name="father_name"
                                           value="{{ $element->father_name }}" required autocomplete="father_name"
                                           autofocus>

                                    @error('father_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.sur_name') }}</label>

                                <div class="col-md-6">
                                    <input id="sur_name" type="text"
                                           class="form-control @error('sur_name') is-invalid @enderror" name="sur_name"
                                           value="{{ $element->sur_name }}" required autocomplete="sur_name" autofocus>

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
                                           value="{{ $element->email }}" required autocomplete="email">

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
                                    <input id="civil_id_no" type="number"
                                           class="form-control @error('civil_id_no') is-invalid @enderror"
                                           name="civil_id_no"
                                           value="{{ $element->civil_id_no }}" required autocomplete="civil_id_no"
                                           autofocus>
                                    @error('civil_id_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{--                             is oiffcer --}}
                            @if($element->is_officer)
{{--                                 file no --}}
                                <div class="form-group row">
                                    <label for="file_no"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.file_no') }}</label>

                                    <div class="col-md-6">
                                        <input id="file_no" type="text"
                                               class="form-control @error('file_no') is-invalid @enderror"
                                               name="file_no"
                                               value="{{ $element->file_no }}" required autocomplete="file_no"
                                               autofocus>
                                        @error('file_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
{{-- nationality --}}
                            @else
                                {{--                                 passport --}}
                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.passport_no') }}</label>

                                    <div class="col-md-6">
                                        <input id="passport_no" type="text"
                                               class="form-control @error('passport_no') is-invalid @enderror"
                                               name="passport_no"
                                               value="{{ $element->passport_no }}" required autocomplete="passport_no"
                                               autofocus>
                                        @error('passport_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--                                 reference no --}}
                                <div class="form-group row">
                                    <label for="reference_no"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.reference_no') }}</label>

                                    <div class="col-md-6">
                                        <input id="reference_no" type="text"
                                               class="form-control @error('reference_no') is-invalid @enderror"
                                               name="reference_no"
                                               value="{{ $element->reference_no }}" required autocomplete="reference_no"
                                               autofocus>
                                        @error('reference_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                            @endif


                            <div class="form-group row">
                                <label for="nationality"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.nationality') }}</label>

                                <div class="col-md-6">
                                    <input id="nationality" type="text"
                                           class="form-control @error('nationality') is-invalid @enderror"
                                           name="nationality"
                                           value="{{ $element->nationality }}" required autocomplete="nationality"
                                           autofocus>
                                    @error('nationality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="age"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.age') }}</label>

                                <div class="col-md-6">
                                    <input id="age" type="text"
                                           class="form-control @error('age') is-invalid @enderror"
                                           name="age"
                                           value="{{ $element->age }}" required autocomplete="age"
                                           autofocus>
                                    @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.mobile') }}</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="number"
                                           class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                           value="{{ $element->mobile }}" required autocomplete="mobile" autofocus>
                                    @error('mobile')
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
                                    <input id="work_number" type="number"
                                           class="form-control @error('work_number') is-invalid @enderror" name="phone"
                                           value="{{ $element->phone }}" required autocomplete="work_number" autofocus>
                                    @error('work_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleFormControlSelect1" class="col-md-4 col-form-label text-md-right">
                                    {{ trans("general.governate") }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="exampleFormControlSelect1" name="governate_id">
                                        @foreach($governates as $governate)
                                            <option
                                                value="{{ $governate->id }}" {{ $element->governate_id === $governate->id ? 'selected' : null }}>{{ $governate->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('governate_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

{{--                             address  city --}}

                            <div class="form-group row">
                                <label for="city"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.city') }}</label>

                                <div class="col-md-6">
                                    <input id="city" type="text"
                                           class="form-control @error('city') is-invalid @enderror"
                                           name="city"
                                           value="{{ $element->city }}" required autocomplete="city"
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
                                           value="{{ $element->block }}" required autocomplete="block"
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
                                           value="{{ $element->street }}" required autocomplete="street"
                                           autofocus>
                                    @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="house_no"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.house_no') }}</label>

                                <div class="col-md-6">
                                    <input id="house_no" type="text"
                                           class="form-control @error('house_no') is-invalid @enderror"
                                           name="house_no"
                                           value="{{ $element->house_no }}" required autocomplete="house_no"
                                           autofocus>
                                    @error('house_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="civil_id_image"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.civil_id_image') }}</label>

                                <div class="col-md-6">
                                    <input id="civil_id_image" type="file"
                                           class="form-control @error('civil_id_image') is-invalid @enderror"
                                           name="civil_id_image"
                                           value="{{ $element->civil_id_image }}" autocomplete="civil_id_image"
                                           autofocus>
                                    @error('civil_id_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <div class="alert alert-danger mt-2">
                                        <strong>{{ __('general.image_id_instruction') }}</strong>
                                    </div>
                                    <img class="img-10 img-thumbnail"
                                         src="{{ $element->getImageThumbLinkAttribute('civil_id_image') }}"
                                         alt="{{ $element->name }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="personal_image"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.personal_image') }}</label>

                                <div class="col-md-6">
                                    <input id="personal_image" type="file"
                                           class="form-control @error('personal_image') is-invalid @enderror"
                                           name="personal_image"
                                           value="{{ $element->personal_image }}" autocomplete="personal_image"
                                           autofocus>
                                    @error('personal_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <img class="img-10 img-thumbnail mt-3"
                                         src="{{ $element->getImageThumbLinkAttribute('personal_image') }}"
                                         alt="{{ $element->name }}">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 text-md-right">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('general.save') }}
                                    </button>
                                </div>
                                <div class="col-md-6 text-md-left">
                                    <a href="{{ route('home') }}" class="btn btn-outline-dark">
                                        {{ __('general.cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
