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
                                    <p class="card-text">{{ str_limit($element->officer->description, 80) }}</p>
                                    </p>
                                </div>
                            </div>
                        @endcan
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
                    </div>
                </div>
                <div class="col-10 offset-1">
                    <div class="justify-content-center">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center">{{ trans('general.report_details') }}
                                    : {{ $element->reference_id }}</h4>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold ">{{ trans('general.report_type')}}
                                    : {{ $element->type->name}}</h5>
                                <h5 class="card-title font-weight-bold ">{{ trans('general.reference_id')}}
                                    : {{ $element->reference_id}}</h5>
                                <h5 class="card-title font-weight-bold ">{{ trans('general.description')}} :
                                    <p>{{ $element->description}}</p></h5>
                                @if($element->notes)
                                    <h5 class="card-title font-weight-bold ">{{ trans('general.notes')}} :
                                        <p>{{ $element->notes}}</p>
                                    </h5>
                                @endif
                                <hr>
                                <h5 class="card-title font-weight-bold ">{{ trans('general.address')}}:</h5>
                                <h5 class="card-title font-weight-bold ">@lang('general.city') : {{ $element->city }}
                                    - @lang('general.area') : {{ $element->area }} - @lang('general.street')
                                    : {{ $element->street }}</h5>
                                <h5 class="card-title font-weight-bold ">{{ trans('general.mobile') .' '. trans('general.report_owner') }}
                                    : {{ $element->owner->mobile}}</h5>
                                <h5 class="card-title font-weight-bold ">{{ trans('general.report_owner')}}
                                    : {{ $element->owner->name}}</h5>
                                <h5 class="card-title font-weight-bold ">{{ trans('general.created_at')}}
                                    : {{ $element->created_at->format('d/m/Y')}}</h5>
                                <h5 class="card-title font-weight-bold ">{{ trans('general.status')}}
                                    : {{ !$element->is_closed ? trans('general.report_open') : trans('general.closed') }}</h5>
                                <h5 class="card-title font-weight-bold ">{{ trans('general.has_injuries')}}
                                    : {{ $element->has_injuries ? trans('general.yes') : trans('general.no') }}</h5>
                                @if($element->has_injuries)
                                    <h5 class="card-title font-weight-bold ">{{ trans('general.injuries_no') }}
                                        : {{ $element->injuries_no }}</h5>
                                @endif
                                <h5 class="card-title font-weight-bold ">{{ trans('general.weather')}}
                                    : {{ $element->weather }}</h5>
                                <h5 class="card-title font-weight-bold ">{{ trans('general.primary_contributory')}}
                                    : {{ $element->primary_contributory }}</h5>
                                <h5 class="card-title font-weight-bold ">{{ trans('general.traffic_offences')}}
                                    : {{ $element->traffic_offences }}</h5>
                                <h5 class="card-title font-weight-bold ">{{ trans('general.hit_and_run')}}
                                    : {{ $element->hit_and_run ? trans('general.yes') : trans('general.no') }}</h5>
                                <h5 class="card-title font-weight-bold ">{{ trans('general.speed_limit')}}
                                    : {{ $element->speed_limit }}</h5>
                                @if($element->vehicles->isNotEmpty())

                                    <h5>@lang('general.vehicles') / @lang('general.injuries') : </h5>

                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang('general.plate_no')</th>
                                            <th scope="col">@lang('general.model')</th>
                                            <th scope="col">@lang('general.model_year')</th>
                                            <th scope="col">@lang('general.owner')</th>
                                            <th scope="col">@lang('general.injured')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($element->vehicles as $v)
                                            <tr>
                                                <th scope="row">@lang('general.vehicle') .{{ ($loop->index+1) }}</th>
                                                <td>{{ $v->plate_no }}</td>
                                                <td>{{ $v->model }}</td>
                                                <td>{{ $v->model_year }}</td>
                                                <td>
                                                    {{ $v->user->first_name }} {{ $v->user->father_name }}
                                                    <ul>
                                                        <li>@lang('general.civil_id_no')
                                                            : {{ $v->user->civil_id_no }}</li>
                                                        <li>@lang('general.age') : {{ $v->user->age }}</li>
                                                        <li>@lang('general.nationality')
                                                            : {{ $v->user->nationality }}</li>
                                                        <li>@lang('general.driving_license_no')
                                                            : {{ $v->user->driving_license_no }}</li>
                                                        <li>@lang('general.driving_license_issuance')
                                                            : {{ $v->user->driving_license_issuance }}</li>
                                                        <li>@lang('general.driving_license_expiry')
                                                            : {{ $v->user->driving_license_expiry }}</li>
                                                    </ul>
                                                </td>
                                                <td><label
                                                        class="label {{ $v->injured ? 'label-danger' : 'label-default' }}">{{ $v->injured  ? 'Yes' : 'No'}}</label>
                                                </td>
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
