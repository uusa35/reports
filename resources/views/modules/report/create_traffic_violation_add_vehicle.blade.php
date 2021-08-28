@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4
                            class="display-6 text-center">{{ trans('general.add_vehicles') }} {{ $element->type->is_ambulance ? '/ '.trans('general.injuries')  : null }}</h4>
                        <h4>@lang('general.vehicle_no') : {{ $element->vehicles->count() + 1 }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('add.vehicle') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="report_id" value="{{ request()->id }}">
                            {{--                             pole no --}}

                            <div class="form-group row">
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
                            <div class="form-group row">
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
                            <div class="form-group row">
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
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.suspended') }} @lang('general.if_exist')</label>

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
                            <div class="form-group row">

                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.suspended') }}
                                    -
                                </label>
                                <div class="col-6 ">
                                    <div class="col pt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="injured_1"
                                                   id="inlineRadio1" value="driving_license" checked>
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.driving_license') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="checkbox" name="injured_2"
                                                   id="inlineRadio1" value="vehicle">
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.vehicle') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="checkbox" name="injured_3"
                                                   id="inlineRadio1" value="vehicle_registration_permit">
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.vehicle_registration_permit') }}</label>
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

                            <div class="container">
                                <div class="row text-center">
                                    <div class="col-lg-12 offset-3 text-center">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3">
                                                <button type="submit" class="btn btn-success">
                                                    + {{ trans('general.save') }}
                                                    {{--                                            {{ __('general.save') }} --}}
                                                </button>
                                            </div>
                                            <div class="row">

                                                <div class="col-6">
                                                    <a href="{{ route('report.edit', $element->id) }}"
                                                       class=" btn btn-warning">
                                                        {{ __('general.back') }}
                                                    </a>
                                                </div>
                                                <div class="col-6 d-none">
                                                    <a href="{{ route('home') }}" class="btn btn-secondary">
                                                        {{ __('general.finish') }}
                                                    </a>
                                                </div>
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
