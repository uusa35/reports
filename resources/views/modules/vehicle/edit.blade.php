@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4
                            class="display-6 text-center">{{ __('general.edit') }} @lang('general.profile') </h4></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('vehicle.update', $element->id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.plate_no') }}</label>

                                <div class="col-md-6">
                                    <input id="plate_no" type="text"
                                           class="form-control @error('plate_no') is-invalid @enderror"
                                           name="plate_no"
                                           value="{{ $element->plate_no }}" required autocomplete="plate_no"
                                           autofocus>

                                    @error('plate_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 text-md-right">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('general.save') }}
                                    </button>
                                </div>
                                <div class="col-md-6 text-md-left">
                                    <a href="{{ route('vehicle.index') }}" class="btn btn-outline-dark">
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
