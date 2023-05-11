<!-- Feature Section -->
<section @isset($id)id="{{ $id }}"@endisset class="feature section-gap">
    <div class="container">
        <div class="row flex-lg-row-reverse">
            <div class="col-lg-6 col-md-7">
                <h3 class="feature__sub-title">{{ $features->sub_title }}</h3>
                <h1 class="feature__title">{{ $features->title }}</h1>
                <p>{{ $features->description }}</p>
                <ul class="feature__list">
                    @foreach ($featureSpecs as $featureSpec)
                    <li class="feature__list__item">{{ $featureSpec->feature }}</li>
                    @endforeach
                </ul>
                <div class="d-flex flex-wrap justify-content-center justify-content-md-start app-card__btn-group pt-0">
                    <a href="#!" class="app-btn">
                        <span class="app-btn__icon">
                            <i class="bi bi-apple"></i>
                        </span>
                        <span class="app-btn__content">
                            <strong class="app-btn__text">Free Download</strong>
                            <span class="app-btn__title">App Store</span>
                        </span>
                    </a>
                    <a href="#!" class="app-btn">
                        <span class="app-btn__icon">
                            <i class="bi bi-google-play"></i>
                        </span>
                        <span class="app-btn__content">
                            <strong class="app-btn__text">Free Download</strong>
                            <span class="app-btn__title">Google Play</span>
                        </span>
                    </a>
                </div>
                {{-- <a href="#contact-section" class="primary-btn w-100 w-sm-auto" >Request a quote</a> --}}
            </div>
            <div class="col-lg-6 col-md-5 pt-5 pt-lg-0">
                <div class="feature-figure user-select-none">
                    <span class="feature-figure__bg">
                        <svg class="feature-figure__bg__image" width="1em" height="1em" viewBox="0 0 642 637" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M454.75 104.291C344.429 69.4298 352.432 10.3048 254.193 1.04643C181.868 -5.6819 102.237 26.8781 80.3835 151.664C55.8627 291.694 0.468512 355.347 0.166012 447.298C-0.136488 538.085 34.706 610.831 147.236 631.356C259.876 651.916 316.975 609.64 401.263 519.449C485.559 429.46 582.598 497.293 628.559 356.016C666.344 239.93 627.991 159.868 454.75 104.291Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <div class="feature-figure__main">
                        <div class="feature-figure__main__container">
                            <img src="{{ asset('uploads/features') }}/{{ $features->image }}" alt="Main Food" class="feature-figure__main__container__image" loading="lazy" draggable="false">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
