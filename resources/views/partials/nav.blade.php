<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand center" href="{{ url('/') }}">
            <img class="img-5" src="https://www.moi.gov.kw/main/images/assets/common/logo-moi.svg"
                 alt="{{ config('app.name') }}">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="@lang('general.toggle_navigation')">
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
                    <a class="nav-link" href="{{ route('home') }}">@lang('general.home')</a>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('login') }}">@lang('general.login')</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('register', ['is_officer' => false]) }}">@lang('general.public_register')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('register', ['is_officer' => true]) }}">@lang('general.officer_register')</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('report.index') }}">@lang('general.reports')</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.edit', auth()->id()) }}">
                                <i class="fa fa-fw fa-1x fa-user-edit ml-1"></i>
                                {{ trans('general.edit') }} {{ trans('general.profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('user.edit', auth()->id()) }}">
                                <i class="fa fa-fw fa-1x fa-edit ml-1"></i>
                                {{ trans("general.account_type") }} : {{ auth()->user()->userType }} - {{ auth()->id() }}
                            </a>
                            @can('isAdmin')
                                <a class="dropdown-item" href="{{ route('type.index') }}">
                                    <i class="fa fa-fw fa-list-alt ml-1"></i>
                                    {{ trans('general.report_types') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('user.index',['is_officer' => 0]) }}">
                                    <i class="fa fa-fw fa-users ml-1"></i>
                                    {{ trans('general.users') }} {{ trans("general.regular") }}
                                </a>
                                <a class="dropdown-item" href="{{ route('user.index',['is_officer' => 1 ]) }}">
                                    <i class="fa fa-fw fa-users ml-1"></i>
                                    {{ trans('general.officers') }}
                                </a>
                            @endcan
                            <a class="dropdown-item" href="{{ route('password.request') }}">
                                <i class="fa fa-fw fa-1x fa-passport ml-1"></i>
                                @lang('general.reset_password')
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-fw fa-1x fa-sign-out-alt ml-1"></i>
                                @lang('general.logout')
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
