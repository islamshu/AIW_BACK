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
            {{-- إدارة المستخدمين والصلاحيات --}}
<li class="dropdown nav-item
    {{ request()->routeIs('dashboard.users.*')
    || request()->routeIs('dashboard.roles.*')
    || request()->routeIs('dashboard.permissions.*')
    ? 'active' : '' }}"
    data-menu="dropdown">

    <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">
        <i class="la la-users-cog"></i>
        <span>إدارة المستخدمين</span>
    </a>

    <ul class="dropdown-menu">

        {{-- المستخدمين --}}
        <li class="{{ request()->routeIs('dashboard.users.*') ? 'active' : '' }}">
            <a class="dropdown-item" href="{{ route('dashboard.users.index') }}">
                <i class="la la-users"></i>
                <span>المستخدمين</span>
            </a>
        </li>

        {{-- الأدوار --}}
        <li class="{{ request()->routeIs('dashboard.roles.*') ? 'active' : '' }}">
            <a class="dropdown-item" href="{{ route('dashboard.roles.index') }}">
                <i class="la la-user-shield"></i>
                <span>الأدوار</span>
            </a>
        </li>

        {{-- الصلاحيات --}}
        <li class="{{ request()->routeIs('dashboard.permissions.*') ? 'active' : '' }}">
            <a class="dropdown-item" href="{{ route('dashboard.permissions.index') }}">
                <i class="la la-key"></i>
                <span>الصلاحيات</span>
            </a>
        </li>

    </ul>
</li>


            {{-- إعدادات الصفحة الرئيسية --}}
            <li class="dropdown nav-item
                {{ request()->routeIs('home-hero.*')
                || request()->routeIs('home-stats.*')
                || request()->routeIs('home-services.*')
                || request()->routeIs('sectors.*')
                ? 'active' : '' }}"
                data-menu="dropdown">

                <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">
                <i class="la la-layer-group"></i>
                <span>إعدادات الصفحة الرئيسية</span>
                </a>

                <ul class="dropdown-menu">

                    {{-- هيرو الصفحة الرئيسية --}}
                    <li class="{{ request()->routeIs('home-hero.*') ? 'active' : '' }}">
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

                    {{-- الخدمات --}}
                    <li class="{{ request()->routeIs('home-services.*') ? 'active' : '' }}">
                        <a class="dropdown-item" href="{{ route('home-services.index') }}">
                            <i class="la la-cubes"></i>
                            <span>الخدمات</span>
                        </a>
                    </li>

                    {{-- القطاعات --}}
                    <li class="{{ request()->routeIs('sectors.*') ? 'active' : '' }}">
                        <a class="dropdown-item" href="{{ route('sectors.index') }}">
                            <i class="la la-th-large"></i>
                            <span>القطاعات</span>
                        </a>
                    </li>

                </ul>
            </li>
            {{-- إدارة الصفحات --}}
<li class="nav-item {{ request()->routeIs('dashboard.pages.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard.pages.index') }}">
        <i class="la la-file-alt"></i>
        <span>إدارة الصفحات</span>
    </a>
</li>

{{-- إدارة الوظائف --}}
<li class="nav-item {{ request()->routeIs('dashboard.jobs.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard.jobs.index') }}">
        <i class="la la-briefcase"></i>
        <span>إدارة الوظائف</span>
    </a>
</li>


        </ul>
    </div>
</div>
