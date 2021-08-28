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
                        <form method="post" action="{{ route('report.store') }}" enctype="multipart/form-data">
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
                            <div class="form-group row ">
                                <label for="created_at"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.location') }}</label>
                                <div class="col-md-6">
                                    <input type="text" id="address-input" name="address_address"
                                           class="form-control map-input" value="Kuwait">
                                    <input type="hidden" name="latitude" id="address-latitude" value="29.3187128"/>
                                    <input type="hidden" name="longitude" id="address-longitude" value="47.9971457"/>
                                    <div id="address-map-container" style="width:100%;height:300px; ">
                                        <div style="width: 100%; height: 100%" id="address-map"></div>
                                    </div>
                                </div>
                            </div>

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
                                {{--                             speed limit --}}
                                <div class="form-group row">
                                    <label for="speed_limit"
                                           class="col-md-4 col-form-label text-md-right">{{ __('general.speed_limit') }}</label>

                                    <div class="col-md-6">
                                        <input id="speed_limit" type="string"
                                               class="form-control @error('speed_limit') is-invalid @enderror"
                                               name="speed_limit"
                                               value="{{ old('speed_limit') }}"
                                               value="" autocomplete="speed_limit"
                                        >
                                        @error('speed_limit')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

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
                                <div class="form-group row">
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

@section('scripts')
    @parent
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
        async defer></script>
    <script>
        function initialize() {

            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
            const locationInputs = document.getElementsByClassName("map-input");

            const autocompletes = [];
            const geocoder = new google.maps.Geocoder;
            for (let i = 0; i < locationInputs.length; i++) {

                const input = locationInputs[i];
                const fieldKey = input.id.replace("-input", "");
                const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

                const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || 29.3187128;
                const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 47.9971457;

                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 13
                });
                const marker = new google.maps.Marker({
                    map: map,
                    position: {lat: latitude, lng: longitude},
                });

                marker.setVisible(isEdit);

                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.key = fieldKey;
                autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
            }

            for (let i = 0; i < autocompletes.length; i++) {
                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;
                const map = autocompletes[i].map;
                const marker = autocompletes[i].marker;

                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                    marker.setVisible(false);
                    const place = autocomplete.getPlace();

                    geocoder.geocode({'placeId': place.place_id}, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            const lat = results[0].geometry.location.lat();
                            const lng = results[0].geometry.location.lng();
                            setLocationCoordinates(autocomplete.key, lat, lng);
                        }
                    });

                    if (!place.geometry) {
                        window.alert("No details available for input: '" + place.name + "'");
                        input.value = "";
                        return;
                    }

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);

                });
            }
        }
    </script>
@stop
