<!-- Testimonial Section -->
<section @isset($id)id="{{ $id }}"@endisset class="testimonial section-gap">
    <div class="container">
        <div class="section-header">
            <h1 class="section-header__title text-center">Témoignage</h1>
        </div>
        <div class="testimonial__slider">
            <article class="testimonial__slide">
                <div class="row justify-content-center">
                    <div class="col-lg-7 text-center pb-5">
                        <div class="testimonial__slide__header d-inline-block">
                            <span class="testimonial__slide__header__icon">
                                <i class="bi bi-quote"></i>
                            </span>
                            <figure class="testimonial__slide__avatar rounded-circle overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name=EN&color=FFFFFF&background=44680E&size=90" alt="avatar" width="90" height="90" loading="lazy" draggable="false" class="testimonial__slide__avatar__image">
                            </figure>
                        </div>
                        <ul class="testimonial__slide__list nav justify-content-center">
                            <li class="testimonial__slide__list__item">
                                <i class="bi bi-star-fill"></i>
                            </li>
                            <li class="testimonial__slide__list__item">
                                <i class="bi bi-star-fill"></i>
                            </li>
                            <li class="testimonial__slide__list__item">
                                <i class="bi bi-star-fill"></i>
                            </li>
                            <li class="testimonial__slide__list__item">
                                <i class="bi bi-star-fill"></i>
                            </li>
                            <li class="testimonial__slide__list__item">
                                <i class="bi bi-star-fill"></i>
                            </li>
                        </ul>
                        <h2 class="testimonial__slide__title">Nom de l'examinateur</h2>
                        <blockquote class="testimonial__slide__description">Toujours à l'affût des derniers nouveautés technologique, j'avoue avoir été charmé par la façon dont avez remis au goût du jour le système nfc. J'étais parti pour tester un ou deux de vos produits, mais plus j'imagine la façon dont je vais utiliser vos stickers et plus je me dis que les possibilités sont illimitées ne serait-ce que dans mon quotidien !! Franchement, j'adore bravo à vous !!!</blockquote>
                        <img src="{{ asset('frontend_assets/assets/images/logos/google-reviews-logo.png') }}" alt="google review" height="50" loading="lazy" draggable="false" class="testimonial__slide__image mx-auto">
                    </div>
                </div>
            </article>
            <article class="testimonial__slide">
                <div class="row justify-content-center">
                    <div class="col-lg-7 text-center pb-5">
                        <div class="testimonial__slide__header d-inline-block">
                            <span class="testimonial__slide__header__icon">
                                <i class="bi bi-quote"></i>
                            </span>
                            <figure class="testimonial__slide__avatar rounded-circle overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name=EN&color=FFFFFF&background=09122a&size=90" alt="avatar" width="90" height="90" loading="lazy" draggable="false" class="testimonial__slide__avatar__image">
                            </figure>
                        </div>
                        <ul class="testimonial__slide__list nav justify-content-center">
                            <li class="testimonial__slide__list__item">
                                <i class="bi bi-star-fill"></i>
                            </li>
                            <li class="testimonial__slide__list__item">
                                <i class="bi bi-star-fill"></i>
                            </li>
                            <li class="testimonial__slide__list__item">
                                <i class="bi bi-star-fill"></i>
                            </li>
                            <li class="testimonial__slide__list__item">
                                <i class="bi bi-star-fill"></i>
                            </li>
                            <li class="testimonial__slide__list__item">
                                <i class="bi bi-star-fill"></i>
                            </li>
                        </ul>
                        <h2 class="testimonial__slide__title">Nom de l'examinateur</h2>
                        <blockquote class="testimonial__slide__description">Toujours à l'affût des derniers nouveautés technologique, j'avoue avoir été charmé par la façon dont avez remis au goût du jour le système nfc. J'étais parti pour tester un ou deux de vos produits, mais plus j'imagine la façon dont je vais utiliser vos stickers et plus je me dis que les possibilités sont illimitées ne serait-ce que dans mon quotidien !! Franchement, j'adore bravo à vous !!!</blockquote>
                        <img src="{{ asset('frontend_assets/assets/images/logos/google-reviews-logo.png') }}" alt="google review" height="50" loading="lazy" draggable="false" class="testimonial__slide__image mx-auto">
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

@push('custom-js')
    <script>
        $(document).ready(function () {
            /*  Testimonial slider */
            $(".testimonial__slider").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 8000,
                speed: 500,
                arrows: false,
                dots: true,
                pauseOnHover: false,
                pauseOnFocus: false,
                infinite: true,
            });
        });
    </script>
@endpush
