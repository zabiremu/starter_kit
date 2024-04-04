@php
    $company= App\Models\CompanyInformation::first();
@endphp
<style>
     ul#side_navbar li{
        margin: 4px 0;
    }
    ul#side_navbar:hover li{
        margin: 4px 0;
    }
</style>
{{-- sidebar section start  --}}
<nav class="sidebar sidebar-offcanvas" id="sidebar" >
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{ route('dashboard') }}">
            <img src="{{ isset($company->logo) ? asset($company->logo) : '' }}" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="{{ route('dashboard') }}">
            <img src="{{ isset($company->logo) ? asset($company->logo) : '' }}" alt="logo" /></a>
    </div>
    <ul class="nav" id="side_navbar" style="position: fixed; width:14%;">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle "
                            src="{{ Auth::user()->image ? asset(Auth::user()->image) : 'https://api.dicebear.com/8.x/adventurer/svg?seed=' . Auth::user()->name }}"
                            alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal"> {{ Auth::user()->name ? Auth::user()->name : 'none' }}</h5>
                    </div>
                </div>


            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{route('dashboard')}}">
                <span class="menu-icon">
                    <i class="text-success mdi mdi-view-dashboard"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        {{-- users menu start --}}
         <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
                <span class="menu-icon">
                    <i class="mdi mdi-account-circle text-success"></i>
                </span>
                <span class="menu-title">User</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="users">

                <ul class="nav flex-column sub-menu">
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('users.create') }}">Create User</a></li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('users.index') }}">User List</a></li>
                </ul>
            </div>
        </li>
        {{-- users menu End --}}


        {{-- setting menu start --}}
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
                <span class="menu-icon">
                    <i class="mdi mdi-settings text-success"></i>
                </span>
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="settings">

                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.profile.index') }}">Profile Settings</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.password.index') }}">Password Password</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.general-information.index') }}">General Information</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('company-information.index') }}">Company
                            Information</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('mail-settings.index') }}">Mail
                            Settings</a></li>
                </ul>
            </div>
        </li>
        {{-- setting menu End --}}

        {{-- roles menu start --}}
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#roles" aria-expanded="false" aria-controls="settings">
                <span class="menu-icon">
                    <i class="mdi mdi-account-group text-success"></i>
                </span>
                <span class="menu-title">Roles & Permission</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="roles">

                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.permissions') }}">Permissions</a></li>
                </ul>
            </div>
        </li>
        {{-- setting menu End --}}
    </ul>
</nav>
{{-- sidebar section end  --}}
