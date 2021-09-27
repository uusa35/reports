@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4
                            class="display-6 text-center">{{ trans('general.add_injuries') }}</h4>
                        <h4>@lang('general.injury') : {{ $element->vehicles->count() + 1 }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('public.add.vehicle') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="report_id" value="{{ request()->id }}">
                            {{--                             pole no --}}

                            <div class="form-group row d-none">
                                <label for="plate_no"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.vehicle_plate_no') }} @lang('general.if_exist')</label>

                                <div class="col-md-6">
                                    <input id="vehicle" type="string"
                                           class="form-control @error('vehicle') is-invalid @enderror"
                                           name="plate_no"
                                           value=""
                                           placeholder="{{ $element->owner->vehicles->isNotEmpty() ? $element->owner->vehicles->random()->plate_no : rand(1111,9999) }}"
                                           autocomplete="vehicle"
                                    >
                                    @error('vehicle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- traffic offenses --}}
                            <div class="form-group row d-none">
                                <label for="exampleFormControlSelect1"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ trans("general.traffic_offences") }} </label>
                                <div class="col-md-6">
                                    <select class="form-control" id="exampleFormControlSelect1"
                                            name="traffic_offences">
                                        <option value="No Parking">{{ trans("general.No Parking") }}</option>
                                        <option
                                            value="Handicapped Parking">{{ trans("general.Handicapped Parking") }}</option>
                                        <option value="Honking">{{ trans("general.Honking") }}</option>
                                        <option
                                            value="Documents & License Plates">{{ trans("general.Documents & License Plates") }}</option>
                                        <option
                                            value="Dangerous Overtaking">{{ trans("general.Dangerous Overtaking") }}</option>
                                        <option value="Others">{{ trans("general.Others") }}</option>
                                    </select>
                                    @error('weather')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{--                             driving license --}}
                            <div class="form-group row d-none">
                                <label for="driver_license_no"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.driver_license_no') }}</label>

                                <div class="col-md-6">
                                    <input id="driver_license" type="string"
                                           class="form-control @error('driver_license') is-invalid @enderror"
                                           name="driver_license"
                                           value=""
                                           placeholder="{{ $element->owner->driving_license_no }}"
                                           autocomplete="driver_license"
                                    >
                                    @error('driver_license')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- injury civil id --}}
                            <div class="form-group row d-none">
                                <label for="vehicle"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.injury_civil_id') }} @lang('general.if_exist')</label>

                                <div class="col-md-6">
                                    <input id="injury_civil_id" type="string"
                                           class="form-control @error('vehicle') is-invalid @enderror"
                                           name="injury_name_1"
                                           value=""
                                           placeholder="@lang('general.injury_civil_id')"
                                           autocomplete="vehicle"
                                    >
                                    @error('injury_civil_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- iinjuired --}}
                            <div class="form-group row d-none">

                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.injury_sever') }}
                                    -
                                </label>
                                <div class="col-6 ">
                                    <div class="col pt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="injured_1"
                                                   id="inlineRadio1" value="minor" checked>
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.minor') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="radio" name="injured_1"
                                                   id="inlineRadio1" value="severe">
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.severe') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="radio" name="injured_1"
                                                   id="inlineRadio1" value="death">
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.death') }}</label>
                                        </div>
                                    </div>
                                    @error('has_injuries')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- injury civil id  2--}}
                            <div class="form-group row">
                                <label for="vehicle"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.injury_civil_id') }} @lang('general.if_exist')</label>

                                <div class="col-md-6">
                                    <input id="injury_civil_id" type="string"
                                           class="form-control @error('vehicle') is-invalid @enderror"
                                           name="injury_civil_id_1"
                                           value=""
                                           placeholder="@lang('general.injury_civil_id')"
                                           autocomplete="vehicle"
                                    >
                                    @error('injury_name_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- iinjuired --}}
                            <div class="form-group row d-none">

                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.injury_sever') }}
                                    -
                                </label>
                                <div class="col-6 ">
                                    <div class="col pt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="injured_2"
                                                   id="inlineRadio1" value="minor" checked>
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.minor') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="radio" name="injured_1"
                                                   id="inlineRadio1" value="severe">
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.severe') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="radio" name="injured_2"
                                                   id="inlineRadio1" value="death">
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.death') }}</label>
                                        </div>
                                    </div>
                                    @error('has_injuries')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            {{--                             3 --}}
                            {{-- injury civil id --}}
                            <div class="form-group row d-none">
                                <label for="vehicle"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.injury_civil_id') }} @lang('general.if_exist')</label>

                                <div class="col-md-6">
                                    <input id="injury_civil_id" type="string"
                                           class="form-control @error('vehicle') is-invalid @enderror"
                                           name="injury_name_1"
                                           value=""
                                           placeholder="@lang('general.injury_civil_id')"
                                           autocomplete="vehicle"
                                    >
                                    @error('injury_civil_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- iinjuired --}}
                            <div class="form-group row d-none">

                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.injury_sever') }}
                                    -
                                </label>
                                <div class="col-6 ">
                                    <div class="col pt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="injured_2"
                                                   id="inlineRadio1" value="minor" checked>
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.minor') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="radio" name="injured_2"
                                                   id="inlineRadio1" value="severe">
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.severe') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="radio" name="injured_2"
                                                   id="inlineRadio1" value="death">
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.death') }}</label>
                                        </div>
                                    </div>
                                    @error('has_injuries')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            {{--                             image --}}
                            <div class="form-group row">
                                <label for="file"
                                       class="col-md-4 col-form-label text-md-right ">{{ trans('general.image') }}</label>
                                <div class="col-md-6">
                                    <input class="form-control tooltips" data-container="body"
                                           data-placement="top"
                                           name="image" placeholder="images" type="file"
                                    />
                                </div>
                            </div>
                            {{--                             video  --}}

                            <div class="form-group row">
                                <label for="file"
                                       class="col-md-4 col-form-label text-md-right ">{{ trans('general.video') }}</label>
                                <div class="col-md-6">
                                    <input class="form-control tooltips" data-container="body"
                                           data-placement="top"
                                           name="path" placeholder="images" type="file"
                                    />
                                </div>
                            </div>

                            <div class="form-group row d-none">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right ">{{ __('general.notes') }}</label>

                                <div class="col-md-6">
                                    <textarea id="notes" type="text"
                                              class="form-control @error('notes') is-invalid @enderror"
                                              name="notes"
                                              autocomplete="notes"
                                              autofocus
                                              rows="5"
                                    >{{ old('notes') }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right ">{{ __('general.description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description"
                                              autocomplete="description"
                                              autofocus
                                              rows="5"
                                    >{{ old('description') }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="container">
                                <div class="row text-center">
                                    <div class="col-lg-12 offset-3 text-center">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3 my-5">
                                                <button type="submit" class="btn btn-success">
                                                    + {{ trans('general.add_another_injury') }}
                                                    {{--                                            {{ __('general.save') }} --}}
                                                </button>
                                            </div>
                                            <div class="col-sm-12 col-md-4 my-2">
                                                <a href="{{ route('report.index') }}"
                                                   class=" btn btn-warning">
                                                    {{ __('general.back') }}
                                                </a>
                                                <a href="{{ route('home') }}" class="btn btn-secondary my-5">
                                                    {{ __('general.finish') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="container">
                            <div class="row text-center">
                                <div class="col-lg-12 offset-3 text-center">
                                    <div class="row">
                                        <form action="{{ route('report.destroy', $element->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button
                                                type="submit"
                                                class="btn btn-danger">
                                                {{ __('general.cancel') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

