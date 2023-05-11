<!-- Header Section -->
<header class="header" id="scroll-spy-container">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="1em" height="1em" viewBox="0 0 24 24">
                    <path d="M21 7H3C1.7 7 1.7 5 3 5h18c1.3 0 1.3 2 0 2zM18 13H3c-1.3 0-1.3-2 0-2h15c1.3 0 1.3 2 0 2zM12 19H3c-1.3 0-1.3-2 0-2h9c1.3 0 1.3 2 0 2z" fill="currentColor"></path>
                </svg>
            </button>
            <a class="navbar-brand" href="{{ route('frontend.index') }}">
                <img src="{{ asset('uploads/generalSettings') }}/{{ generalsettings()->logo }}" alt="logo" height="40" class="navbar-brand__image" />
            </a>
            <div class="navbar-mobile-list d-lg-none">
                @if(Auth::user() && Auth::user()->role == 'admin')
                <a href="{{ route('dashboard') }}" class="navbar-mobile-list__icon">
                    <i class="bi bi-person-circle"></i>
                </a>
                @endif
                <a href="tel:{{ generalsettings()->phone }}" class="navbar-mobile-list__icon">
                    <i class="bi bi-telephone-fill"></i>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbarToggler">
                {{-- <form action="#!" class="navbar__form">
                    <input type="search" name="search" class="navbar__form__input" autocomplete="off" placeholder="Search your keyword..." required>
                    <button type="submit" class="navbar__form__btn">
                        <i class="bi bi-search"></i>
                    </button>
                </form> --}}
                <ul class="navbar-nav mx-auto">
                    @if(hideshow()->banner_status == 1)
                    <li class="nav-item">
                        <a class="nav-link @yield('header-active--home')" href="{{ \Request::route()->getName() != 'frontend.index' ? route('frontend.index') .'/' : '' }}#banner-section">Accueil</a>
                    </li>
                    @endif
                    @if(hideshow()->banner_bottom_status == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ \Request::route()->getName() != 'frontend.index' ? route('frontend.index') .'/' : '' }}#feature-section">Fonctionnalité</a>
                    </li>
                    @endif
                    {{-- @if(hideshow()->pricing_status == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ \Request::route()->getName() != 'frontend.index' ? route('frontend.index') .'/' : '' }}#pricing-section">Pricing</a>
                    </li>
                    @endif --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ \Request::route()->getName() != 'frontend.index' ? route('frontend.index') .'/' : '' }}#app-section">App</a>
                    </li>
                    @if(hideshow()->testimonial_status == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ \Request::route()->getName() != 'frontend.index' ? route('frontend.index') .'/' : '' }}#testimonial-section">Témoignage</a>
                    </li>
                    @endif
                    @if(hideshow()->contact_status == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ \Request::route()->getName() != 'frontend.index' ? route('frontend.index') .'/' : '' }}#contact-section">Contact</a>
                    </li>
                    @endif
                    {{-- <li class="nav-item dropdown d-lg-none">
                        <button type="button" class="nav-icon text-center text-md-left dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('frontend_assets/assets/images/flags/fr-flag.svg') }}" alt="fr" class="dropdown-image">
                        </button>
                        <div class="dropdown-menu">
                            <a href="#!" class="dropdown-item">
                                <img src="{{ asset('frontend_assets/assets/images/flags/en-flag.svg') }}" alt="en" class="dropdown-image">
                                <small class="ml-1">EN</small>
                            </a>
                            <a href="#!" class="dropdown-item">
                                <img src="{{ asset('frontend_assets/assets/images/flags/fr-flag.svg') }}" alt="fr" class="dropdown-image">
                                <small class="ml-1">FR</small>
                            </a>
                        </div>
                    </li> --}}
                </ul>
                <ul class="navbar-nav navbar-nav--icon align-items-center">
                    {{-- <li class="nav-item dropdown">
                        <button type="button" class="nav-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-search"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <form action="#!" class="dropdown-menu__form">
                                <input type="search" name="search" class="dropdown-menu__form__input" autocomplete="off" placeholder="Search your keyword..." required>
                                <button type="submit" class="dropdown-menu__form__btn">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                        </div>
                    </li> --}}
                    @if(Auth::user() && Auth::user()->role == 'admin')
                        <li class="nav-item">
                            {{-- @auth
                            <a href="{{ route('dashboard') }}" class="nav-icon">
                                <i class="bi bi-person-square"></i>
                            </a>
                            @else
                            <button type="button" class="nav-icon" data-toggle="modal" data-target="#authModal">
                                <i class="bi bi-person-circle"></i>
                            </button>
                            @endauth --}}
                            <a href="{{ route('dashboard') }}" class="nav-icon">
                                <i class="bi bi-person-square"></i>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="tel:{{ generalsettings()->phone }}" class="primary-btn primary-btn--has-icon rounded-pill">
                            <i class="bi bi-telephone-fill"></i>
                            {{ generalsettings()->phone }}
                        </a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <button type="button" class="nav-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('frontend_assets/assets/images/flags/fr-flag.svg') }}" alt="fr" class="dropdown-image">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right min-width:max-content">
                            <a href="#!" class="dropdown-item px-0">
                                <img src="{{ asset('frontend_assets/assets/images/flags/en-flag.svg') }}" alt="en" class="dropdown-image">
                                <small class="ml-1">EN</small>
                            </a>
                            <a href="#!" class="dropdown-item px-0">
                                <img src="{{ asset('frontend_assets/assets/images/flags/fr-flag.svg') }}" alt="fr" class="dropdown-image">
                                <small class="ml-1">FR</small>
                            </a>
                        </div>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>
    <button type="button" class="mobile-menu-close" data-toggle="collapse" data-target="#navbarToggler" aria-expanded="false">
        <i class="bi bi-x-lg"></i>
    </button>
</header>
<!-- Off Canvas Menu Toggler -->
<div class="offCanvasMenuCloser position-fixed" data-toggle="collapse" data-target="#navbarToggler" role="button" aria-expanded="false"></div>
<!-- Header Section End -->

@push('all-modals')
    <div class="modal fade" id="authModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="modal__close" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
                <div class="modal-body">
                    <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-toggle="pill" href="#pills-login" id="pills-login-btn" role="tab" aria-selected="true">Connexion</a>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="pill" href="#pills-register" id="pills-register-btn" role="tab" aria-selected="false">Register</a>
                        </li> --}}
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        @if(session('password'))

                          <div class="alert">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Succès!</strong> {{ session('password') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                          </div>
                        </div>
                        @endif
                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel">
                            <form action="{{ route('login') }}" method="POST" class="form">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email *" required>
                                    @error('email')
                                    <div class="alert alert-danger">
                                        <div class="alert-body">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group bg-white">
                                        <input data-target="password" type="password" name="password" class="form-control" placeholder="Mot de passe *" required>
                                        <div class="input-group-append">
                                            <button data-toggle="password" type="button" class="btn btn-outline-dark rounded-0 shadow-none">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('password')
                                    <div class="alert alert-danger">
                                        <div class="alert-body">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group text-right">
                                    <a href="{{ route('forgot.password') }}" class="link">Mot de passe oublié</a>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="primary-btn primary-btn--dark btn-block">Connexion</button>
                                </div>
                            </form>
                            {{-- <div class="divider mb-3">
                                <span class="divider__text">Or login with</span>
                            </div>
                            <a href="#!" class="primary-btn primary-btn--google btn-block"><i class="bi bi-google"></i>oogle</a> --}}
                        </div>
                        {{-- <div class="tab-pane fade" id="pills-register" role="tabpanel">
                            <form action="{{ route('user.store') }}" method="post" class="form">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Your name *" required>
                                    @error('name')
                                    <div class="alert alert-danger">
                                        <div class="alert-body">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" name="register_email" class="form-control" value="{{ old('register_email') }}" placeholder="Your email address *" required>
                                    @error('register_email')
                                    <div class="alert alert-danger">
                                        <div class="alert-body">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input data-target="password" type="password" name="register_password" class="form-control" placeholder="Password *" required>
                                        <div class="input-group-append">
                                            <button data-toggle="password" type="button" class="btn btn-outline-dark rounded-0 shadow-none">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('register_password')
                                    <div class="alert alert-danger">
                                        <div class="alert-body">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input data-target="password" type="password" name="confirm_password" class="form-control" placeholder="Confirm password *" required>
                                        <div class="input-group-append">
                                            <button data-toggle="password" type="button" class="btn btn-outline-dark rounded-0 shadow-none">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('confirm_password')
                                    <div class="alert alert-danger">
                                        <div class="alert-body">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="primary-btn primary-btn--dark btn-block register">Register</button>
                                </div>
                            </form>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
