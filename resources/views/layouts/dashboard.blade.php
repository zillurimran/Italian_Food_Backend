<!DOCTYPE html>
<html class="loaded {{ themesettings(Auth::id())->theme }}" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Digital Tech">

    <title>@yield('title')</title>


    <link rel="apple-touch-icon" href="{{ asset('uploads/generalSettings') }}/{{ generalSettings()->favicon }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/generalSettings') }}/{{ generalSettings()->favicon }}">

    <!-- Google Fonts Link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- BEGIN: Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/css/plugins/charts/chart-apex.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/css/apex.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/vendors/css/forms/select/select2.min.css') }}">
    @stack('vendor-css')

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/css/themes/dark-layout.css') }}">
    @stack('theme-css')

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/assets/css/style.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->

    @stack('css')

    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static menu-{{ themesettings(Auth::id())->nav }}" data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item d-none d-lg-block">
                    <a id="dark" class="nav-link nav-link-style">
                        <i class="ficon" data-feather="moon"></i>
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-notification mr-25 d-none">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
                        <i class="ficon" data-feather="bell"></i>
                        <span class="badge badge-pill badge-danger badge-up">5</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                                <div class="badge badge-pill badge-light-primary">6 New</div>
                            </div>
                        </li>
                        <li class="scrollable-container media-list">
                            <a class="d-flex" href="javascript:void(0)">
                                <div class="media d-flex align-items-start">
                                    <div class="media-left">
                                        <div class="avatar">
                                            <img src="{{ asset('dashboard_assets/app-assets/images/portrait/small/avatar-s-15.jpg') }}" alt="avatar" width="32" height="32">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading"><span class="font-weight-bolder">Congratulation Sam 🎉</span>winner!</p><small class="notification-text"> Won the monthly best seller badge.</small>
                                    </div>
                                </div>
                            </a>
                            <div class="media d-flex align-items-center">
                                <h6 class="font-weight-bolder mr-auto mb-0">System Notifications</h6>
                                <div class="custom-control custom-control-primary custom-switch">
                                    <input class="custom-control-input" id="systemNotification" type="checkbox" checked="">
                                    <label class="custom-control-label" for="systemNotification"></label>
                                </div>
                            </div>
                            <a class="d-flex" href="javascript:void(0)">
                                <div class="media d-flex align-items-start">
                                    <div class="media-left">
                                        <div class="avatar bg-light-danger">
                                            <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading">
                                            <span class="font-weight-bolder">Server down</span>&nbsp;registered
                                        </p>
                                        <small class="notification-text"> USA Server is down due to hight CPU usage</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="javascript:void(0)">Read all notifications</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name font-weight-bolder">{{ ucfirst(Auth::user()->name) }}</span>
                            {{-- <span class="user-status">{{ ucfirst(Auth::user()->role) }}</span> --}}
                        </div>
                        <span class="avatar">
                            <img class="round" src="{{ Auth::user()->profile_photo_url }}" alt="Profile Photo" height="40" width="40">
                            <span class="avatar-status-online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        {{-- <a class="dropdown-item" href="#!" data-toggle="modal" data-target="#topUpModal" ><i class="mr-50" data-feather="shopping-cart"></i> TopUp</a>
                        <a class="dropdown-item" href="#!"><i class="mr-50" data-feather="credit-card"></i> Balance : {{ Auth::user()->total_sms - Auth::user()->send_message }}</a> --}}
                        <a class="dropdown-item" href="{{ route('my-profile') }}"><i class="mr-50" data-feather="user"></i> Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="mr-50" data-feather="power"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Searchbar Dropdown -->
    {{-- <ul class="main-search-list-defaultlist d-none">
        <li class="d-flex align-items-center">
            <a href="javascript:void(0);">
                <h6 class="section-label mt-75 mb-0">Files</h6>
            </a>
        </li>
        <li class="auto-suggestion">
            <a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="mr-75"><img src="../../../app-assets/images/icons/xls.png" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing Manager</small>
                    </div>
                </div><small class="search-data-size mr-50 text-muted">&apos;17kb</small>
            </a>
        </li>
    </ul>
    <ul class="main-search-list-defaultlist-other-list d-none">
        <li class="auto-suggestion justify-content-between">
            <a class="d-flex align-items-center justify-content-between w-100 py-50">
                <div class="d-flex justify-content-start">
                    <span class="mr-75" data-feather="alert-circle"></span>
                    <span>No results found.</span>
                </div>
            </a>
        </li>
    </ul> --}}

    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        <span>
                            <img src="{{ asset('uploads/generalSettings') }}/{{ generalSettings()->logo }}" width="150" alt="Logo">
                        </span>
                        {{-- <h2 class="brand-text">Food App</h2> --}}
                    </a>
                </li>
                <li class="nav-item nav-toggle">
                    <a id="toggle" class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                        <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                        <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="{{ url('/') }}">
                        <i data-feather='eye'></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">View Website</span>
                    </a>
                </li>
                <li class="nav-item @yield('dashboard')">
                    <a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                        <i data-feather='database'></i>
                        <span class="menu-title text-truncate" data-i18n="Email">Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="navigation-header">
                        <span>Blogs</span>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather='book'></i>
                            <span class="menu-title text-truncate">Blogs</span>
                        </a>
                        <ul class="menu-content">
                            <li class="@yield('blogCategory')">
                                <a class="d-flex align-items-center" href="{{ route('blog_categories.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Categorys</span>
                                </a>
                            </li>
                            <li class="@yield('blogTag')">
                                <a class="d-flex align-items-center" href="{{ route('blog_tags.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Tags</span>
                                </a>
                            </li>
                            <li class="@yield('blogList')">
                                <a class="d-flex align-items-center" href="{{ route('blog.list.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Blogs List</span>
                                </a>
                            </li>
                            <li class="@yield('blogCreate')">
                                <a class="d-flex align-items-center" href="{{ route('blog.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Blog Create</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="navigation-header">
                        <span>Packages</span>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather='folder'></i>
                            <span class="menu-title text-truncate">Packages</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item @yield('pricing')">
                                <a class="d-flex align-items-center" href="{{ route('packages.index') }}">
                                    <i data-feather='shield'></i>
                                    <span class="menu-title text-truncate">Package Pricing</span>
                                </a>
                            </li>
                            <li class="nav-item @yield('item')">
                                <a class="d-flex align-items-center" href="{{ route('packages.item') }}">
                                    <i data-feather='twitch'></i>
                                    <span class="menu-title text-truncate">Package Item</span>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                @endif
                <li class="navigation-header">
                    <span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>
                {{-- <li class="nav-item @yield('contacts')">
                    <a class="d-flex align-items-center" href="{{ route('contacts.index') }}">
                        <i data-feather='user-plus'></i>
                        <span class="menu-title text-truncate">Contacts</span>
                    </a>
                </li>
                <li class="nav-item @yield('subscribers')">
                    <a class="d-flex align-items-center" href="{{ route('subscribers.index') }}">
                        <i data-feather='users'></i>
                        <span class="menu-title text-truncate">Subscribers</span>
                    </a>
                </li> --}}
                <li class="nav-item @yield('planning')">
                    <a class="d-flex align-items-center" href="{{ route('planning.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                        <span class="menu-title text-truncate">Planning Order</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item @yield('banners')">
                        <a class="d-flex align-items-center" href="{{ route('banners.index') }}">
                            <i data-feather='circle'></i>
                            <span class="menu-title text-truncate">Banner Setting</span>
                        </a>
                    </li>
                    <li class="nav-item @yield('users')">
                        <a class="d-flex align-items-center" href="{{ route('users.index') }}">
                            <i data-feather='users'></i>
                            <span class="menu-title text-truncate">Users</span>
                        </a>
                    </li>
                @endif
                {{-- <li class="nav-item @yield('groups')">
                    <a class="d-flex align-items-center" href="{{ route('groups.index') }}">
                        <i data-feather='user-plus'></i>
                        <span class="menu-title text-truncate">Groups</span>
                    </a>
                </li>
                <li class="nav-item @yield('numbers')">
                    <a class="d-flex align-items-center" href="{{ route('phone-directories.index') }}">
                        <i data-feather='circle'></i>
                        <span class="menu-title text-truncate">Numbers</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item @yield('nexmo')">
                        <a class="d-flex align-items-center" href="{{ route('nexmo.index') }}">
                            <i data-feather='settings'></i>
                            <span class="menu-title text-truncate">Nexmo</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item @yield('createSms')">
                    <a class="d-flex align-items-center" href="{{ route('create-sms') }}">
                        <i data-feather='database'></i>
                        <span class="menu-title text-truncate">Create SMS</span>
                    </a>
                </li> --}}
                <li class="navigation-header">
                    <span>Food Offer</span>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='aperture'></i>
                        <span class="menu-title text-truncate">Food Offer</span>
                    </a>
                    <ul class="menu-content">
                        <li class="nav-item @yield('foodOffers')">
                            <a class="d-flex align-items-center" href="{{ route('foodOffers.index') }}">
                                <i data-feather='server'></i>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg> --}}
                                <span class="menu-title text-truncate">Food Offers List</span>
                            </a>
                        </li>
                        <li class="nav-item @yield('foodOfferCreate')">
                            <a class="d-flex align-items-center" href="{{ route('foodOffers.create') }}">
                                <i data-feather='loader'></i>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg> --}}
                                <span class="menu-title text-truncate">Create Food Offer</span>
                            </a>
                        </li>
                        <li class="nav-item @yield('allergies')">
                            <a class="d-flex align-items-center" href="{{ route('allergies.index') }}">
                                <i data-feather='zap'></i>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg> --}}
                                <span class="menu-title text-truncate">Allergies</span>
                            </a>
                        </li>
                        <li class="nav-item @yield('myOrders')">
                            <a class="d-flex align-items-center" href="{{ route('myOrders.index') }}">
                                <i data-feather='package'></i>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg> --}}
                                <span class="menu-title text-truncate">My Orders</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (Auth::user()->role == 'admin')
                    {{-- <li class="nav-item @yield('comments')">
                        <a class="d-flex align-items-center" href="{{ route('comments.index') }}">
                            <i data-feather='book-open'></i>
                            <span class="menu-title text-truncate">Comments</span>
                        </a>
                    </li> --}}
                    <li class="navigation-header">
                        <span>Pickup Address</span>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather='map-pin'></i>
                            <span class="menu-title text-truncate">Pickup Addresses</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item @yield('pickupAddress')">
                                <a class="d-flex align-items-center" href="{{ route('pickup_address.index') }}">
                                    <i data-feather='shield'></i>
                                    <span class="menu-title text-truncate">Boutiques List</span>
                                </a>
                            </li>
                            <li class="nav-item @yield('pickupAddressCreate')">
                                <a class="d-flex align-items-center" href="{{ route('pickup_address.create') }}">
                                    <i data-feather='twitch'></i>
                                    <span class="menu-title text-truncate">Create Boutique</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="navigation-header">
                        <span>Tutorial Steps</span>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather='navigation'></i>
                            <span class="menu-title text-truncate">Tutorial Steps </span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item @yield('tutorials')">
                                <a class="d-flex align-items-center" href="{{ route('tutorialSteps.index') }}">
                                    <i data-feather='shield'></i>
                                    <span class="menu-title text-truncate">Tutorial Steps List</span>
                                </a>
                            </li>
                            <li class="nav-item @yield('tutorialStepsCreate')">
                                <a class="d-flex align-items-center" href="{{ route('tutorialSteps.create') }}">
                                    <i data-feather='twitch'></i>
                                    <span class="menu-title text-truncate">Create Tutorial</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li class="navigation-header">
                        <span data-i18n="Apps &amp; Pages">Google Ratings</span>
                        <i data-feather="more-horizontal"></i>
                    </li> --}}
                    {{-- <li class="navigation-header">
                        <span>Google Ratings</span>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather='star'></i>
                            <span class="menu-title text-truncate">Google Ratings </span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item @yield('googleRatings')">
                                <a class="d-flex align-items-center" href="{{ route('googleRatings.index') }}">
                                    <i data-feather='anchor'></i>
                                    <span class="menu-title text-truncate">Ratings List</span>
                                </a>
                            </li> --}}
                            {{-- <li class="nav-item @yield('tutorialStepsCreate')">
                                <a class="d-flex align-items-center" href="{{ route('tutorialSteps.create') }}">
                                    <i data-feather='twitch'></i>
                                    <span class="menu-title text-truncate">Create Tutorial</span>
                                </a>
                            </li> --}}
                        {{-- </ul>
                    </li>   --}}


                    {{-- <li class="nav-item @yield('pricing')">
                        <a class="d-flex align-items-center" href="{{ route('packages.index') }}">
                            <i data-feather='shield'></i>
                            <span class="menu-title text-truncate">Package Pricing</span>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item @yield('subscribers')">
                        <a class="d-flex align-items-center" href="{{ route('subscribers.index') }}">
                            <i data-feather='mail'></i>
                            <span class="menu-title text-truncate">Subscribes</span>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item @yield('location')">
                        <a class="d-flex align-items-center" href="{{ route('location.index') }}">
                            <i data-feather='map-pin'></i>
                            <span class="menu-title text-truncate">Location</span>
                        </a>
                    </li> --}}

                    {{-- Site Settings --}}
                    <li class="navigation-header">
                        <span data-i18n="Apps &amp; Pages">Site Settings</span>
                        <i data-feather="more-horizontal"></i>
                    </li>
                    {{-- <li class="nav-item @yield('adminProfileSettings')">
                        <a class="d-flex align-items-center" href="{{ route('adminProfileSettings.index') }}">
                            <i data-feather='settings'></i>
                            <span class="menu-title text-truncate">Admin Profile Settings</span>
                        </a>
                    </li> --}}
                    <li class="nav-item @yield('generalSettings')">
                        <a class="d-flex align-items-center" href="{{ route('generalSettings.index') }}">
                            <i data-feather='settings'></i>
                            <span class="menu-title text-truncate">General Settings</span>
                        </a>
                    </li>
                    <li class="nav-item @yield('colorSettings')">
                        <a class="d-flex align-items-center" href="{{ route('colorSettings.index') }}">
                            <i data-feather='codesandbox'></i>
                            <span class="menu-title text-truncate">Color Settings</span>
                        </a>
                    </li>
                    <li class="nav-item @yield('socialurls')">
                        <a class="d-flex align-items-center" href="{{ route('socialurls.index') }}">
                            <i data-feather='coffee'></i>
                            <span class="menu-title text-truncate">Social Urls</span>
                        </a>
                    </li>
                    <li class="nav-item @yield('stripeSettings')">
                        <a class="d-flex align-items-center" href="{{ route('stripe.index') }}">
                            <i data-feather='activity'></i>
                            <span class="menu-title text-truncate">Stripe Settings</span>
                        </a>
                    </li>
                    <li class="nav-item @yield('features')">
                        <a class="d-flex align-items-center" href="{{ route('features.index') }}">
                            <i data-feather='feather'></i>
                            <span class="menu-title text-truncate">Features</span>
                        </a>
                    </li>
                    <li class="nav-item @yield('privacy.policy')">
                        <a class="d-flex align-items-center" href="{{ route('privacy.index') }}">
                            <i data-feather='feather'></i>
                            <span class="menu-title text-truncate">Privacy Policy</span>
                        </a>
                    </li>
                @endif


            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            @yield('breadcrumb')
                            {{-- <h2 class="content-header-title float-left mb-0">Admin Dashboard</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Layouts</a>
                                    </li>
                                </ol>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block">
                    <div class="form-group breadcrumb-right">

                    </div>
                </div>
            </div>
            <div class="content-body">
                {{-- Content Start From Here --}}
                    @yield('content')
                {{-- Content End Here --}}
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0">
            <span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; {{ now()->year }}
                <a class="ml-25" href="https://soclose.co/" target="_blank">SoClose</a>
                <span class="d-none d-sm-inline-block">, All rights Reserved</span>
            </span>
        </p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button">
        <i data-feather="arrow-up"></i>
    </button>
    <!-- END: Footer-->
    {{-- <div class="modal fade" id="topUpModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="topUpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Balance TopUp</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                   <form action="{{ route('user.balance.topup') }}" method="POST">
                    @csrf
                    @php
                    $packages = \App\Models\PackageType::all();
                    @endphp
                    <div class="form-group">
                        <label for="name">Package</label>
                        <select name="package_id" class="form-control" required>
                            <option value="" disabled selected>Select</option>
                            @foreach ($packages as $package)
                                <option value="{{ $package->id }}">{{ $package->package_type }} - €{{ $package->package_price }}/{{ $package->sms_quantity }} sms</option>
                            @endforeach
                        </select>
                    </div>
               </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
            </div>
        </div>
        </div>
    </div> --}}
    @stack('all-modals')


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/forms/form-select2.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    @stack('vendor-js')
    <!-- END Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('dashboard_assets/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/js/chart-apex.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    @stack('page-js')
    <!-- END: Page JS-->

    <!-- Global AjaxSetup Script-->
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>

    <!-- IMPORTANT Ajax Script  DO NOT DELETE  DARK MODE / LIGHT MODE && MENU EXPAND / COLLAPSE IMPORTANT AJAX-->
    <script>
        $(document).ready(function(){
            $('#dark').click(function(){
                $.ajax({
                    url: "{{ route('theme.color') }}",
                    type: "GET",
                    success: function(data){}
                })
            });
            $('#toggle').click(function(){
                $.ajax({
                    url: "{{ route('theme.toggle') }}",
                    type: "GET",
                    success: function(data){}
                })
            });
        })
    </script>

    <!-- Feather Icon Script-->
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: '1em',
                    height: '1em'
                });
            }
        });
    </script>

    <!-- Inner Table Dropdown probolem solve functions -->
    <script>
        $(document).ready(function() {
            $('table').on('shown.bs.dropdown', function (e){
                $(this).closest('[class*="col"]').addClass("position-static")
            });
            $('table').on('hide.bs.dropdown', function () {
                $(this).closest('[class*="col"]').removeClass("position-static")
            });
        });
    </script>

    <!-- Toastr Message Script-->
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        $(window).on("load", function(){
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}');
                @endforeach
            @endif

            @if(session()->get('error'))
                toastr.error('{{ session()->get('error') }}');
            @endif

            @if(session()->get('success'))
                toastr.success('{{ session()->get('success') }}');
            @endif
        });
    </script>

    <script>
        $(document).ready(function (){
            (function(){
                if($(".custom-editor-wrapper").length){
                    $(".custom-editor-wrapper").each(function (index, element) {
                        let quillEditor = new Quill(element.children[0], {
                            modules: {
                                imageResize: {
                                    displaySize: true
                                },
                                toolbar: [
                                    [{ header: [1, 2, 3, 4, 5, 6, false] }],
                                    ["bold", "italic", "underline", "strike"],
                                    ["blockquote", "code-block"],
                                    ["image", "video"],
                                    ["link"],
                                    [{ script: "sub" }, { script: "super" }],
                                    [{ list: "ordered" }, { list: "bullet" }],
                                    [{ color: [] }, { background: [] }],
                                    [{ align: [] }],
                                    ["clean"]
                                ]
                            },
                            theme: "snow"
                        });
                        quillEditor.on("text-change", function (delta, source) {
                            $(element).find(".custom-editor-input").val(quillEditor.root.innerHTML);
                        });
                    });
                }
            })();
        })
    </script>

    @stack('js')
</body>
<!-- END: Body-->

</html>
