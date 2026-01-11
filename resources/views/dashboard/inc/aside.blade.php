<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow"
     role="navigation" data-menu="menu-wrapper">

    <div class="navbar-container main-menu-content" data-menu="menu-container">
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">

            {{-- الرئيسية --}}
            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="la la-home"></i>
                    <span>الرئيسية</span>
                </a>
            </li>

            {{-- الإعدادات --}}
            <li class="nav-item {{ request()->routeIs('setting') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('setting') }}">
                    <i class="la la-cog"></i>
                    <span>الإعدادات</span>
                </a>
            </li>

            {{-- إعدادات الصفحة الرئيسية --}}
            <li class="dropdown nav-item
                {{ request()->routeIs('home-hero.*') || request()->routeIs('home-stats.*') ? 'active' : '' }}"
                data-menu="dropdown">

                <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">
                    <i class="la la-layout"></i>
                    <span>إعدادات الصفحة الرئيسية</span>
                </a>

                <ul class="dropdown-menu">

                    {{-- هيرو الصفحة الرئيسية --}}
                    <li class="{{ request()->routeIs('home-hero.edit') ? 'active' : '' }}">
                        <a class="dropdown-item" href="{{ route('home-hero.edit') }}">
                            <i class="la la-image"></i>
                            <span>هيرو الصفحة الرئيسية</span>
                        </a>
                    </li>

                    {{-- الاستراتيجيات / الإحصائيات --}}
                    <li class="{{ request()->routeIs('home-stats.*') ? 'active' : '' }}">
                        <a class="dropdown-item" href="{{ route('home-stats.edit') }}">
                            <i class="la la-chart-bar"></i>
                            <span>الاستراتيجيات</span>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- الخدمات --}}
            <li class="nav-item {{ request()->routeIs('home-services.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home-services.index') }}">
                    <i class="la la-cubes"></i>
                    <span>الخدمات</span>
                </a>
            </li>

            {{-- القطاعات --}}
            <li class="nav-item {{ request()->routeIs('sectors.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('sectors.index') }}">
                    <i class="la la-th-large"></i>
                    <span>القطاعات</span>
                </a>
            </li>

        </ul>
    </div>
</div>
