@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">{{ trans('general.report_no') }} : {{ $element->reference_id }}</h4>
                </div>
                <div class="card-body">
                    <div class="card-group">
                        @cannot('isUser')
                            <div class="card col-6">
                                <img class="card-img-top align-content-center  img-fluid"
                                     src="{{ $element->officer->getImageThumbLinkAttribute('personal_image') }}"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{ trans('general.officer') }} {{ trans('general.responsible') }}</h5>
                                    <h5 class="card-title">{{ $element->officer->name}}</h5>
                                    <p class="card-text">{{ str_limit($element->officer->description, 80) }}</p>
                                    <p class="card-text text-right"><small
                                            class="text-muted">{{ trans('general.created_at') }} {{ $element->created_at->diffForHumans() }}</small>
                                    </p>
                                </div>
                            </div>
                        @endcan
                        <div class="card col-6">
                            <img class="card-img-top  align-content-center img-fluid"
                                 src="{{ $element->owner->getImageThumbLinkAttribute('personal_image') }}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ trans('general.report_owner') }}</h5>
                                <h5 class="card-title">{{ $element->owner->name }}</h5>
                                <p class="card-text">{{ trans('general.mobile') }}
                                    : {{ str_limit($element->owner->mobile, 80) }}</p>
                                <p class="card-text">{{ trans('general.email') }}
                                    : {{ str_limit($element->owner->email, 80) }}</p>
                                <p class="card-text">{{ trans('general.civil_id') }}
                                    : {{ str_limit($element->owner->civil_id_no, 80) }}</p>
                                <p class="card-text">{{ str_limit($element->owner->description, 80) }}</p>
                                <p class="card-text text-right"><small
                                        class="text-muted">{{ trans('general.created_at') }} {{ $element->owner->created_at->diffForHumans() }}</small>
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
                                <h5 class="card-title">{{ trans('general.report_type')}}
                                    : {{ $element->type->name}}</h5>
                                <h5 class="card-title">{{ trans('general.reference_id')}}
                                    : {{ $element->reference_id}}</h5>
                                <h5 class="card-title">{{ trans('general.description')}} :
                                    <p>{{ $element->description}}</p></h5>
                                @if($element->notes)
                                    <h5 class="card-title">{{ trans('general.notes')}} : <p>{{ $element->notes}}</p>
                                    </h5>
                                @endif
                                <hr>
                                <h5 class="card-title">{{ trans('general.address')}} : {{ $element->address}}</h5>
                                <h5 class="card-title">{{ trans('general.mobile') .' '. trans('general.report_owner') }}
                                    : {{ $element->owner->mobile}}</h5>
                                <h5 class="card-title">{{ trans('general.report_owner')}}
                                    : {{ $element->owner->name}}</h5>
                                <h5 class="card-title">{{ trans('general.created_at')}}
                                    : {{ $element->created_at->format('d/m/Y')}}</h5>
                                <h5 class="card-title">{{ trans('general.status')}}
                                    : {{ !$element->is_closed ? trans('general.report_open') : trans('general.closed') }}</h5>
                                <h5 class="card-title">{{ trans('general.has_injuries')}}
                                    : {{ $element->has_injuries ? trans('general.yes') : trans('general.no') }}</h5>
                                @if($element->has_injuries)
                                    <h5 class="card-title">{{ trans('general.injuries_no') }}
                                        : {{ $element->injuries_no }}</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="card-title mt-3 text-center">{{ trans('general.images')}} {{ trans('general.report') }}</h5>
                <hr>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ $element->getImageThumbLinkAttribute('image') }}"
                                 alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ $element->getImageThumbLinkAttribute('image_two') }}"
                                 alt="Second slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
@endsection
