<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand center" href="{{ url('/') }}">
            <img class="img-5" src="https://www.moi.gov.kw/main/images/assets/common/logo-moi.svg"
                 alt="{{ config('app.name') }}">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('general.toggle_navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                {{--                    <a class="navbar-brand center" href="{{ url('/') }}">--}}
                {{--                        <img class="img-5" src="https://www.moi.gov.kw/main/images/assets/common/logo-moi.svg" alt="{{ config('app.name') }}">--}}
                {{--                    </a>--}}
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('general.home') }}</a>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('general.login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('general.register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('report.index') }}">{{ __('general.reports') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.edit', auth()->id()) }}">
                                <img class="img-xxs"
                                     src="{{ auth()->user()->getImageThumbLinkAttribute('personal_image') }}"
                                     alt="{{ auth()->user()->name }}"/>
                                {{ trans('general.edit') }} {{ trans('general.profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('report.create') }}">
                                <i class="fa fa-fw fa-plus-square"></i>
                                {{ trans('general.create_new_report') }}
                            </a>
                            @can('isAdmin')
                                <a class="dropdown-item" href="{{ route('type.index') }}">
                                    <i class="fa fa-fw fa-list-alt"></i>
                                    {{ trans('general.report_types') }}
                                </a>
                            @endcan
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-fw fa-sign-out-alt"></i>
                                {{ __('general.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('language.change', getOtherLang()) }}">{{ trans('general.'.getOtherLang()) }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
