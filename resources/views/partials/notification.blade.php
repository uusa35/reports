@section('notification')

    @if (isset($success) || $success = session()->get('success'))
        <div class="col">
            <div class="alert alert-success alert-block" role="alert">

                <div class="col-lg-1">
                    <i class="fa fa-2x fa-check-circle-o fa-fw"></i>
                </div>
                <div class="col-lg-11">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @if(is_array($success))
                        @foreach ($success as $m)
                            {{ $m }}
                        @endforeach
                    @else
                        {{ $success }}
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if (isset($error) || $error = session()->get('error'))
        <div class="col">
            <div class="alert alert-danger alert-block">

                <div class="col-lg-1">
                    <i class="fa fa-1x fa-exclamation-triangle fa-fw"></i>
                </div>
                <div class="col-lg-11">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @if(is_array($error))
                        @foreach ($error as $m)
                            {{ $m }}
                        @endforeach
                    @else
                        {{ $error }}
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if (isset($errors) && $errors->count() > 0)
        <div class="col">
            <div class="alert alert-danger alert-block">

                <div class="col-lg-1">
                    <i class="fa fa-2x fa-exclamation-triangle fa-fw"></i>
                </div>
                <div class="col-lg-11">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach ($errors->all() as $m)
                        <li>{{ $m }}  </li>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if (isset($warning) || $warning = session()->get('warning'))
        <div class="col">
            <div class="alert alert-warning alert-block">

                <div class="col-lg-1">
                    <i class="fa fa-2x fa-exclamation fa-fw"></i>
                </div>
                <div class="col-lg-11">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @if(is_array($warning))
                        @foreach ($warning as $m)
                            {{ $m }}
                        @endforeach
                    @else
                        {{ $warning }}
                    @endif
                </div>
            </div>
        </div>
    @endif

    @if (isset($info) || $info = session()->get('info'))
        <div class="alert alert-info alert-block">
            <div class="col">
                <div class="col-lg-1">
                    <i class="fa fa-2x fa-info-circle fa-fw"></i>
                </div>
                <div class="col-lg-11">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @if(is_array($info))
                        @foreach ($info as $m)
                            {{ $m }}
                        @endforeach
                    @else
                        {{ $info }}
                    @endif
                </div>
            </div>
        </div>
        <hr>
    @endif

@show
