<!-- Footer Section -->
<footer class="footer">
    <div class="footer__top">
        <div class="container">
            <div class="row">
                <div class="footer__block col-lg-4 col-sm-6">
                    <a href="{{ route('frontend.index') }}" class="footer__logo">
                        <img src="{{ asset('uploads/generalSettings') }}/{{ generalsettings()->logo }}" alt="logo" height="40" class="footer__logo__image" />
                    </a>
                    <ul class="footer__nav">
                        <li class="footer__nav__item">
                            <div>
                                <strong class="footer__nav__text">Téléphone:</strong>
                                <a href="tel:+0123456789" class="footer__nav__link">{{ generalsettings()->phone }}</a>
                            </div>
                        </li>
                        <li class="footer__nav__item">
                            <div>
                                <strong class="footer__nav__text">Email:</strong>
                                <a href="mailto:demo@demo.com" class="footer__nav__link">{{ generalsettings()->email }}</a>
                            </div>
                        </li>
                        <li class="footer__nav__item">
                            <div>
                                <strong class="footer__nav__text">Adresse:</strong>
                                <span class="footer__nav__link">{{ generalsettings()->address }}</span>
                            </div>
                        </li>
                        <li class="footer__nav__item">
                            <div>
                                <strong class="footer__nav__text d-block">Jours/heures de travail:</strong>
                                <span class="footer__nav__link">Lun - Sam / 14:00 - 23:00</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="footer__block col-lg-4 col-sm-6">
                    <h3 class="footer__title">Liens utiles</h3>
                    <ul class="footer__nav">
                        <li class="footer__nav__item">
                            <a href="{{ \Request::route()->getName() != 'frontend.index' ? route('frontend.index') .'/' : '' }}#feature-section" class="footer__nav__link">Fonctionnalité</a>
                        </li>
                        <li class="footer__nav__item">
                            <a href="{{ \Request::route()->getName() != 'frontend.index' ? route('frontend.index') .'/' : '' }}#app-section" class="footer__nav__link">App</a>
                        </li>
                        <li class="footer__nav__item">
                            <a href="{{ \Request::route()->getName() != 'frontend.index' ? route('frontend.index') .'/' : '' }}#testimonial-section" class="footer__nav__link">Témoignage</a>
                        </li>
                        <li class="footer__nav__item">
                            <a href="{{ \Request::route()->getName() != 'frontend.index' ? route('frontend.index') .'/' : '' }}#contact-section" class="footer__nav__link">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="footer__block col-lg-4 col-sm-6">
                    <div class="pl-lg-5">
                        <h3 class="footer__title">Abonnez-vous à notre newsletter</h3>
                        <form action="" method="post" class="footer__form my-2" id="footer__form">
                            @csrf
                            <input type="email" name="subscriber_email" id="subscriber_email" class="footer__form__input" placeholder="Adresse e-mail">
                            <button type="submit" class="footer__form__btn subscribe">
                                <span class="footer__form__btn__text">S'abonner</span>
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </form>
                        <div class="msgContainer w-100"></div>

                        {{-- <div class="footer__app-wrapper d-sm-flex align-content-center justify-content-end text-center">
                            <a href="#!" target="_blank" class="footer__app d-inline-block">
                                <img src="https://sticko.fr/ecommerce_assets/images/app--apple.png" alt="app icon" class="footer__app__image img-fluid">
                            </a>
                            <a href="#!" target="_blank" class="footer__app d-inline-block">
                                <img src="https://sticko.fr/ecommerce_assets/images/app--play.png" alt="app icon" class="footer__app__image img-fluid">
                            </a>
                        </div> --}}

                        <ul class="social-nav justify-content-center justify-content-sm-end my-2">
                            @foreach(socialurls() as $item)
                            <li class="social-nav__item">
                                <a href="{{ $item->link }}" target="_blank" class="social-nav__link">
                                    {!! $item->icon !!}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            <p class="footer__copyright text-center mb-0">{{ config('app.name') }} © {{ date("Y") }}. Tous les droits sont réservés. <a href="https://soclose.co/" target="_blank" class="footer__copyright__link">Conception par SoClose</a></p>
        </div>
    </div>
</footer>
