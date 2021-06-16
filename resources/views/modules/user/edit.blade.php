@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4 class="display-6 text-center">{{ __('general.edit') }}</h4></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update', $element->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ $element->name }}" required autocomplete="name" autofocus>

                                    @error('name')
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
                                    <input id="civil_id_no" type="text"
                                           class="form-control @error('civil_id_no') is-invalid @enderror" name="civil_id_no"
                                           value="{{ $element->civil_id_no }}" required autocomplete="civil_id_no" autofocus>
                                    @error('civil_id_no')
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
                                    <input id="mobile" type="text"
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
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                           class="form-control @error('address') is-invalid @enderror" name="address"
                                           value="{{ $element->address }}" required autocomplete="address" autofocus>
                                    @error('address')
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
                                    <img class="img-xs img-thumbnail" src="{{ $element->getImageThumbLinkAttribute('civil_id_image') }}" alt="{{ $element->name }}">
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
                                    <img class="img-xs img-thumbnail mt-3" src="{{ $element->getImageThumbLinkAttribute('personal_image') }}" alt="{{ $element->name }}">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('general.save') }}
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
