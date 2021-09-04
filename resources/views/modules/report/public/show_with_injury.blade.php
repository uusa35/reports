@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">{{ trans('general.report_no') }} : {{ $element->reference_id }}</h4>
                    <p class="card-text text-right">{{ trans('general.created_at') }} {{ $element->created_at->format('l jS F Y h:i A') }}</p>
                </div>
                <div class="card-body">
                    <div class="card-group">
                        @cannot('isUser')
                            <div class="card col-6">
                                <img class="card-img-top align-content-center  img-fluid"
                                     src="{{ $element->officer->getImageThumbLinkAttribute('personal_image') }}"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold  text-center">{{ trans('general.officer') }} {{ trans('general.responsible') }}</h5>
                                    <h5 class="card-title font-weight-bold ">{{ $element->officer->name}}</h5>
                                    @if(!auth()->user()->is_officer)
                                        <p class="card-text">{{ str_limit($element->officer->description, 80) }}</p>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endcan
                            @can('isUser')
                                <div class="card col-6">
                                    <img class="card-img-top align-content-center  img-fluid"
                                         src="{{ $element->owner->getImageThumbLinkAttribute('personal_image') }}"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold  text-center">{{ trans('general.owner') }} {{ trans('general.responsible') }}</h5>
                                        <h5 class="card-title font-weight-bold ">{{ $element->owner->name}}</h5>
                                        @if(!auth()->user()->is_user)
                                            <p class="card-text">{{ str_limit($element->owner->description, 80) }}</p>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endcan
                        @can('isAdmin')
                            <div class="card col-6">
                                <img class="card-img-top  align-content-center img-fluid"
                                     src="{{ $element->owner->getImageThumbLinkAttribute('personal_image') }}"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold  text-center">{{ trans('general.report_owner') }}</h5>
                                    <h5 class="card-title font-weight-bold ">{{ $element->owner->name }}</h5>
                                    <p class="card-text">{{ trans('general.mobile') }}
                                        : {{ str_limit($element->owner->mobile, 80) }}</p>
                                    <p class="card-text">{{ trans('general.email') }}
                                        : {{ str_limit($element->owner->email, 80) }}</p>
                                    <p class="card-text">{{ trans('general.civil_id') }}
                                        : {{ str_limit($element->owner->civil_id_no, 80) }}</p>
                                    <p class="card-text">{{ str_limit($element->owner->description, 80) }}</p>
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="justify-content-center">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center">{{ trans('general.report_details') }}</h4>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold ">{{ trans('general.report_type')}}
                                    : {{ $element->type->name}}</h5>
                                {{--                                <h5 class="card-title font-weight-bold ">{{ trans('general.reference_id')}}--}}
                                {{--                                    : {{ $element->reference_id}}</h5>--}}
                                <h5 class="card-title font-weight-bold ">{{ trans('general.description')}} :
                                    <p>{{ $element->description}}</p></h5>
{{--                                @if($element->notes)--}}
{{--                                    <h5 class="card-title font-weight-bold ">{{ trans('general.notes')}} :--}}
{{--                                        <p>{{ $element->notes}}</p>--}}
{{--                                    </h5>--}}
{{--                                @endif--}}
                                <hr>
                                <h5 class="card-title font-weight-bold ">@lang('general.area') : {{ $element->city }}
                                    -  {{ $element->area }} - @lang('general.street')
                                    : {{ $element->street }} - B : {{ $element->block }}</h5>
                                @can('isAdmin')
                                    <h5 class="card-title font-weight-bold ">{{ trans('general.mobile') .' '. trans('general.report_owner') }}
                                        : {{ $element->owner->mobile}}</h5>
                                    <h5 class="card-title font-weight-bold ">{{ trans('general.report_owner')}}
                                        : {{ $element->owner->name}}</h5>
                                @endif
{{--                                <h5 class="card-title font-weight-bold ">{{ trans('general.created_at')}}--}}
{{--                                    : {{ $element->created_at->format('d/m/Y')}}</h5>--}}
{{--                                @if($element->has_injuries)--}}
{{--                                    <h5 class="card-title font-weight-bold ">{{ trans('general.has_injuries')}}--}}
{{--                                        : {{ $element->has_injuries ? trans('general.yes') : trans('general.no') }}</h5>--}}
{{--                                    <h5 class="card-title font-weight-bold ">{{ trans('general.injuries_no') }}--}}
{{--                                        : {{ $element->injuries_no }}</h5>--}}
{{--                                @endif--}}
                                @if($element->weather)
                                    {{--                                    <h5 class="card-title font-weight-bold ">{{ trans('general.weather')}}--}}
                                    {{--                                        : {{ $element->weather }}</h5>--}}
                                @endif
                                <h5 class="card-title font-weight-bold ">{{ trans('general.primary_contributory')}}
                                    : {{ $element->primary_contributory }}</h5>
                                {{--                                <h5 class="card-title font-weight-bold ">{{ trans('general.traffic_offences')}}--}}
                                {{--                                    : {{ $element->traffic_offences }}</h5>--}}
                                {{--                                <h5 class="card-title font-weight-bold ">{{ trans('general.hit_and_run')}}--}}
                                {{--                                    : {{ $element->hit_and_run ? trans('general.yes') : trans('general.no') }}</h5>--}}


                                <h5 class="card-title font-weight-bold ">{{ trans('general.status')}}: <span
                                        class="badge badge-{{ $element->is_closed ? 'danger' : 'info' }} text-lg">
                                        {{ !$element->is_closed ? trans('general.open') : trans('general.closed') }}
                                    </span></h5>
                                @if($element->vehicles->isNotEmpty())

                                    <h5>@lang('general.vehicles') / @lang('general.injuries') : </h5>

                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang('general.vehicle_information')</th>
                                            {{--                                            <th scope="col">@lang('general.model')</th>--}}
                                            {{--                                            <th scope="col">@lang('general.model_year')</th>--}}
{{--                                            <th scope="col">@lang('general.driver_information')</th>--}}
                                            <th scope="col">@lang('general.images')</th>
                                            <th scope="col">@lang('general.videos')</th>
                                            {{--                                            <th scope="col">@lang('general.injured')</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($element->vehicles as $v)
                                            <tr>
                                                <th scope="row">@lang('general.vehicle') .{{ ($loop->index+1) }}</th>
                                                <td>
                                                    <ul>
{{--                                                        <li>@lang('general.owner') : {{ $v->user->name }}</li>--}}
{{--                                                        <li>@lang('general.driving_license_no') : {{ $v->user->driving_license_no }}</li>--}}
                                                        <li>@lang('general.vehicle_plate_no')
                                                            : {{ $v->plate_no }}</li>
{{--                                                        <li>@lang('general.model') : {{ $v->model }}</li>--}}
{{--                                                        <li>@lang('general.model_year') : {{ $v->model_year }}</li>--}}
{{--                                                        <li>@lang('general.insurance_no') : {{ $v->insurance_no }}</li>--}}
{{--                                                        <li>@lang('general.insurance_company') : {{ $v->insurance_company }}</li>--}}
{{--                                                        <li>@lang('general.insurance_expiry_date') : {{ $v->insurance_expiry_date }}</li>--}}
                                                    </ul>
                                                </td>
                                                {{--                                                <td>{{ $v->plate_no }}</td>--}}
                                                {{--                                                <td>{{ $v->model }}</td>--}}
                                                {{--                                                <td>{{ $v->model_year }}</td>--}}
                                                <td class="d-none">
{{--                                                    {{ $v->user->first_name }} {{ $v->user->father_name }}--}}
                                                    <ul>
{{--                                                        <li>@lang('general.civil_id_no')--}}
{{--                                                            : {{ $v->user->civil_id_no }}</li>--}}
{{--                                                        <li>@lang('general.age') : {{ $v->user->age }}</li>--}}
{{--                                                        <li>@lang('general.nationality')--}}
{{--                                                            : {{ $v->user->nationality }}</li>--}}
{{--                                                        <li>@lang('general.driving_license_no')--}}
{{--                                                            : {{ $v->user->driving_license_no }}</li>--}}
{{--                                                        <li>@lang('general.driving_license_issuance')--}}
{{--                                                            : {{ $v->user->driving_license_issuance }}</li>--}}
{{--                                                        <li>@lang('general.driving_license_expiry')--}}
{{--                                                            : {{ $v->user->driving_license_expiry }}</li>--}}
{{--                                                        <li>@lang('general.driver_license_no')--}}
{{--                                                            : {{ $v->pivot->driver_license }}</li>--}}
                                                        <div class="card d-none">
                                                            <div class="card-header">
                                                                {{ trans('injuries') }}
                                                            </div>
                                                            <div class="card-body">
                                                                <li>@lang('general.injury_civil_id')
                                                                    : {{ $v->pivot->injury_civil_id }}</li>
                                                                <li>@lang('general.injury_name')
                                                                    : {{ $v->pivot->injury_name_1 }}</li>
                                                                <li>@lang('general.type_of_injury')
                                                                    : {{ $v->pivot->injured_1 }}</li>
                                                                <hr>
                                                                <li>@lang('general.injury_civil_id')
                                                                    : {{ $v->pivot->injury_civil_id }}</li>
                                                                <li>@lang('general.injury_name')
                                                                    : {{ $v->pivot->injury_name_2 }}</li>
                                                                <li>@lang('general.type_of_injury')
                                                                    : {{ $v->pivot->injured_2 }}</li>
                                                                <hr>
                                                                <li>@lang('general.injury_civil_id')
                                                                    : {{ $v->pivot->injury_civil_id }}</li>
                                                                <li>@lang('general.injury_name')
                                                                    : {{ $v->pivot->injury_name_3 }}</li>
                                                                <li>@lang('general.type_of_injury')
                                                                    : {{ $v->pivot->injured_3 }}</li>
                                                                <hr>
                                                            </div>
                                                        </div>
                                                    </ul>
                                                </td>
                                                <td>
                                                    @if($v->pivot->image)
                                                        <img class="img-thumbnail img-xs"
                                                             src="{{ asset(env('THUMBNAIL').$v->pivot->image) }}"
                                                             alt="">
                                                    @else
                                                        <label class="label label-warning">N/A</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($v->pivot->path)
                                                        <video width="100%" height="300" controls autoplay>
                                                            <source src="/{{ env('FILE').$v->pivot->path }}"
                                                                    type="video/mp4">
                                                        </video>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                {{--                                                <td><label--}}
                                                {{--                                                        class="label {{ $v->pivot->injured ? 'label-danger' : 'label-default' }}">{{ $v->pivot->injured  ? 'Yes' : 'No'}}</label>--}}
                                                {{--                                                </td>--}}
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @if($element->path)
                    <div class="col-md-12">
                        <h5 class="card-title font-weight-bold  mt-3 text-center">{{ trans('general.video')}} {{ trans('general.report') }}</h5>
                        <video width="100%" controls autoplay>
                            <source src="/{{ env('FILE').$element->path }}" type="video/mp4">
                        </video>
                    </div>
                @endif
                @if($element->images->isNotEmpty())
                    <hr>
                    <h5 class="card-title font-weight-bold  mt-3 text-center">{{ trans('general.images')}} {{ trans('general.report') }}</h5>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($element->images as $img)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}"
                                    class="active"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach($element->images as $img)
                                <div class="carousel-item {{ $loop->index === 0 ? 'active' : null }}">
                                    <img class="d-block w-100" src="{{ $img->getImageThumbLinkAttribute('image') }}"
                                    />
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
@endsection
