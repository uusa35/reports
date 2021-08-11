@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4
                            class="display-6 text-center">{{ trans('general.edit') }} {{ __('general.report_type') }} {{ $element->name }}</h4></div>

                    <div class="card-body">
                        <form method="post" action="{{ route('type.update', $element->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right text-danger">{{ __('general.description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description"
                                              required autocomplete="description"
                                              autofocus
                                              rows="5"
                                    >{{ $element->description }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right text-danger">{{ __('general.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="name"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ $element->name }}" autocomplete="name" required>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right text-danger">{{ __('general.hot_line') }}</label>

                                <div class="col-md-6">
                                    <input id="hot_line" type="text"
                                           class="form-control @error('hot_line') is-invalid @enderror" name="hot_line"
                                           value="{{ $element->hot_line }}" required autocomplete="hot_line"
                                           autofocus>
                                    @error('hot_line')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.is_traffic') }} </label>
                                <div class="col-6 ">
                                    <div class="col pt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_traffic"
                                                   id="inlineRadio1" value="1" {{ $element->is_traffic ? 'checked' : null }}>
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.yes') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="radio" name="is_traffic"
                                                   id="inlineRadio1" value="0" {{ !$element->is_traffic ? 'checked' : null }}>
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.no') }}</label>
                                        </div>
                                    </div>
                                    @error('is_traffic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="is_ambulance"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.is_ambulance') }} </label>
                                <div class="col-6 ">
                                    <div class="col pt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_ambulance"
                                                   id="inlineRadio1" value="1" {{ $element->is_ambulance ? 'checked' : null }}>
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.yes') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="radio" name="is_ambulance"
                                                   id="inlineRadio1" value="0" {{ !$element->is_ambulance ? 'checked' : null }}>
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.no') }}</label>
                                        </div>
                                    </div>
                                    @error('is_ambulance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.is_fire') }} </label>
                                <div class="col-6 ">
                                    <div class="col pt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_fire"
                                                   id="inlineRadio1" value="1" {{ $element->is_fire ? 'checked' : null }}>
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.yes') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="radio" name="is_fire"
                                                   id="inlineRadio1" value="0" {{ !$element->is_fire ? 'checked' : null }}>
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.no') }}</label>
                                        </div>
                                    </div>
                                    @error('is_fire')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right ">{{ __('general.image') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file"
                                           class="form-control @error('image') is-invalid @enderror" name="image"
                                           value="" autocomplete="image" autofocus>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.notes') }}</label>

                                <div class="col-md-6">
                                    <input id="notes" type="notes"
                                           class="form-control @error('notes') is-invalid @enderror" name="notes"
                                           value="{{ $element->notes }}" autocomplete="notes">

                                    @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.active') }}</label>
                                <div class="col-6 ">
                                    <div class="col pt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="active"
                                                   id="inlineRadio1" value="1" {{ $element->active ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.yes') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="radio" name="active"
                                                   id="inlineRadio1" value="0" {{ !$element->active ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.no') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container">
                                <div class="row text-center">
                                    <div class="col offset-2">
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('general.save') }}
                                        </button>
                                    </div>
                                    <div class="col">
                                        <a href="{{ route('home') }}" class="btn btn-secondary">
                                            {{ __('general.cancel') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
