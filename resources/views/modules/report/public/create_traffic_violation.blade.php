@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4
                            class="display-6 text-center">{{ __('general.create_new_report') }}
                            - {{ $currentType->name }}</h4></div>
                    <div class="card-body">
                        <form method="post" action="{{ route('public.store') }}" enctype="multipart/form-data">
                            @csrf
                            @can('isOfficer')
                                <input type="hidden" name="officer_id" value="{{ auth()->id() }}"/>
                            @endcan
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="report_type_id" value="{{ request()->report_type_id }}">
                            {{-- date and time --}}
                            <div class="form-group row">
                                <label for="created_at"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.date_and_time') }}</label>

                                <div class="col-md-6">
                                    <input id="created_at" type="datetime-local"
                                           class="form-control @error('created_at') is-invalid @enderror"
                                           name="created_at"
                                           value="{{ old('created_at') }}" autocomplete="created_at"
                                           maxlength="2">
                                    @error('created_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{--                             location --}}
                            @include('modules.report.map_input')

                            <div class="form-group row">
                                <label for="electricity_pole_no"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.electricity_pole_no') }}</label>

                                <div class="col-md-6">
                                    <input id="electricity_pole_no" type="string"
                                           class="form-control @error('electricity_pole_no') is-invalid @enderror"
                                           name="electricity_pole_no"
                                           value="{{ old('electricity_pole_no') }}"
                                           autocomplete="electricity_pole_no"
                                    >
                                    @error('electricity_pole_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{--                             address city --}}

                            <div class="form-group row">
                                <label for="area"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.city') }}</label>

                                <div class="col-md-6">
                                    <input id="area" type="text"
                                           class="form-control @error('area') is-invalid @enderror" name="area"
                                           value="{{ old('area') }}" autocomplete="area">

                                    @error('area')
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
                                           class="form-control @error('street') is-invalid @enderror" name="street"
                                           value="{{ old('street') }}" autocomplete="street">

                                    @error('street')
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
                                           class="form-control @error('block') is-invalid @enderror" name="block"
                                           value="{{ old('block') }}" autocomplete="block">

                                    @error('block')
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
                                                value="{{ $governate->id }}">{{ $governate->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('governate_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row d-none">
                                <label for="injuries_no"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.injuries_no') }}
                                    {{ trans('general.if_exist') }}</label>

                                <div class="col-md-6">
                                    <input id="injuries_no" type="number"
                                           class="form-control @error('injuries_no') is-invalid @enderror"
                                           name="injuries_no"
                                           value="{{ old('injuries_no') }}" autocomplete="injuries_no"
                                           maxlength="2">
                                    @error('injuries_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if(!$currentType->is_traffic)
                                {{--                            @if($currentType->is_ambulance)--}}
                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.has_injuries') }}</label>
                                    <div class="col-6 ">
                                        <div class="col pt-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="has_injuries"
                                                       id="inlineRadio1" value="1">
                                                <label class="form-check-label"
                                                       for="inlineRadio1">{{ trans('general.yes') }}</label>
                                            </div>
                                            <div class="form-check form-check-inline ml-5">
                                                <input class="form-check-input" type="radio" name="has_injuries"
                                                       id="inlineRadio1" value="0" checked>
                                                <label class="form-check-label"
                                                       for="inlineRadio1">{{ trans('general.no') }}</label>
                                            </div>
                                        </div>
                                        @error('has_injuries')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            @if($currentType->is_fire || $currentType->is_damage)
                                <div class="form-group row">
                                    <label for="building_no"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.building_no') }}</label>

                                    <div class="col-md-6">
                                        <input id="building_no" type="text"
                                               class="form-control @error('building_no') is-invalid @enderror"
                                               name="building_no"
                                               value="{{ old('building_no') }}" autocomplete="building_no">

                                        @error('building_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                {{--                             pole no --}}
                            @endif
                            {{--                            @endif--}}
                            @if($currentType->is_traffic)

                                {{--                             weither --}}
                                {{--                                <div class="form-group row">--}}
                                {{--                                    <label for="exampleFormControlSelect1"--}}
                                {{--                                           class="col-md-4 col-form-label text-md-right">--}}
                                {{--                                        {{ trans("general.weather") }} </label>--}}
                                {{--                                    <div class="col-md-6">--}}
                                {{--                                        <select class="form-control" id="exampleFormControlSelect1" name="weather">--}}
                                {{--                                            <option value="wind">{{ trans("general.wind") }}</option>--}}
                                {{--                                            <option value="mist/fog">{{ trans("general.mist/fog") }}</option>--}}
                                {{--                                            <option value="cloudy">{{ trans("general.cloudy") }}</option>--}}
                                {{--                                            <option value="light rain">{{ trans("general.light rain") }}</option>--}}
                                {{--                                            <option value="heavy rain">{{ trans("general.heavy rain") }}</option>--}}
                                {{--                                            <option value="smoke">{{ trans("general.smoke") }}</option>--}}
                                {{--                                            <option value="strong wind">{{ trans("general.strong wind") }}</option>--}}
                                {{--                                        </select>--}}
                                {{--                                        @error('weather')--}}
                                {{--                                        <span class="invalid-feedback" role="alert">--}}
                                {{--                                        <strong>{{ $message }}</strong>--}}
                                {{--                                    </span>--}}
                                {{--                                        @enderror--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

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
                                <div class="form-group row d-none">
                                    <label for="exampleFormControlSelect1"
                                           class="col-md-4 col-form-label text-md-right">
                                        {{ trans("general.primary_contributory") }} </label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="exampleFormControlSelect1"
                                                name="primary_contributory">
                                            <option
                                                value="@lang('hit_and_run')">{{ trans("general.hit_and_run") }}</option>
                                            <option
                                                value="@lang('run_over')">{{ trans("general.run_over") }}</option>
                                            <option
                                                value="@lang('anonynos')">{{ trans("general.anonynos") }}</option>
                                            <option
                                                value="@lang('group_of_vehicles')">{{ trans("general.group_of_vehicles") }}</option>
                                        </select>
                                        @error('primary_contributory')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row d-none">
                                    <label for="vehicle_no_2"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.number_of_vehicles_in_accident') }}</label>
                                    <div class="col-md-6">
                                        <input id="number_of_vehicles" type="number"
                                               max="4"
                                               class="form-control @error('number_of_vehicles') is-invalid @enderror"
                                               name="number_of_vehicles"
                                               value="{{ old('number_of_vehicles') }}"
                                               autocomplete="number_of_vehicles">

                                        @error('number_of_vehicles')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                            @endif
                            {{--                             descirption --}}
                            <div class="form-group row d-none">
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
                            {{--                             notes --}}
                            <div class="form-group row d-none">
                                <label for="notes"
                                       class="col-md-4 col-form-label text-md-right ">{{ __('general.notes') }}</label>

                                <div class="col-md-6">
                                    <textarea id="notes" type="text"
                                              class="form-control @error('notes') is-invalid @enderror"
                                              name="notes"
                                              autocomplete="notes"
                                              autofocus
                                              rows="5"
                                    >{{ old('notes') }}</textarea>

                                    @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            {{--                             mobile --}}
                            <div class="form-group row d-none">
                                <label for="mobile"
                                       class="col-md-4 col-form-label text-md-right ">{{ __('general.mobile') }}</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="number"
                                           class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                           value="{{ old('mobile') }}" autocomplete="mobile"
                                           autofocus>
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if(!$currentType->is_traffic)
                                {{--                             image  --}}
                                <div class="form-group row d-none">
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
                                        <span class="text-info text-muted my-5" role="alert">
                                        <strong>@lang('general.upload_up_to_one_minute')</strong>
                                    </span>
                                    </div>
                                </div>
                                {{--                             images --}}
                                <div class="form-group row">
                                    <label for="file"
                                           class="col-md-4 col-form-label text-md-right ">{{ trans('general.images') }}</label>
                                    <div class="col-md-6">
                                        <input class="form-control tooltips" data-container="body"
                                               data-placement="top"
                                               name="images[]" placeholder="images" type="file"
                                               multiple/>
                                        <span class="text-info text-muted my-5" role="alert">
                                        <strong>@lang('general.upload_up_to_six_images')</strong>
                                    </span>
                                        @error('images')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                            @endif

                            <div class="container">
                                <div class="row text-center">
                                    <div class="col offset-2">
                                        <button type="submit" class="btn btn-danger">
                                            {{ $currentType->is_traffic ? trans('general.next') : trans('general.save')}}
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

