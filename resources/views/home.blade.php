@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>
                        {{ __('general.report_type') }}
                    </h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach($elements as $element)
                            <div class="col-lg-4 mb-3">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="{{ $element->getImageThumbLinkAttribute() }}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a href="{{ route('report.create') }}">
                                                {{ $element->name }}
                                            </a></h5>
                                        <h5 class="card-title">
                                               {{ trans('general.hot_line') }} :  {{ $element->hot_line }}
                                            </h5>
                                        <p class="card-text" style="height: 8em;">{{ $element->description }}</p>
                                        <a href="{{ route('report.create', ['report_type_id' => $element->id]) }}"
                                           class="btn btn-danger {{ getOtherLang() === 'en' ? 'float-left' : 'float-right' }}">{{ trans('general.process_report') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
