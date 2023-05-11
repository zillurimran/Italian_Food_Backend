@extends('frontend.layout.master')

@section('title', '| Contact Us')

@section('header-active--contact', 'active')

@section('main')

<!-- Sub Banner Section -->
<section class="sub-banner" style="background-image: url('https://sticko.fr/uploads/ecommerce/settings/contact-us.jpg')">
    <div class="container">
        <div class="sub-banner__content text-center">
            <h1 class="sub-banner__title">Contact Us</h1>
            <ul class="breadcrumb justify-content-center">
                <li class="breadcrumb-item">
                    <a href="{{ route('frontend.index') }}" class="breadcrumb-link"><i class="bi bi-house-door"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ul>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact section-gap">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <aside class="contact__card">
                    <div class="contact__card__item">
                        <h3 class="contact__card__title">Address</h3>
                        <p>{{ generalsettings()->address }}</p>
                    </div>
                    <div class="contact__card__item">
                        <h3 class="contact__card__title">Phone Number</h3>
                        <a href="tel:+123456789" class="contact__card__link">{{ generalsettings()->phone }}</a>
                        {{-- <a href="tel:+123456789" class="contact__card__link">+123456789</a> --}}
                    </div>
                    <div class="contact__card__item">
                        <h3 class="contact__card__title">Support</h3>
                        <a href="mailto:demo@demo.com" class="contact__card__link">{{ generalsettings()->email }}</a>
                        {{-- <a href="mailto:demo@demo.com" class="contact__card__link">demo@demo.com 24*7</a> --}}
                    </div>
                </aside>
            </div>
            <div class="col-xl-9 col-lg-8">
                <h1 class="section-header__title mb-2">Let’s Connect</h1>
                <p>Your email address will not be published. Required fields are marked *</p>
                <form action="#!">
                    <div class="form-group">
                        <textarea name="comment" class="form-control" placeholder="Comment *" rows="6" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Name *" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email *" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="primary-btn  primary-btn--has-icon">
                        Post your comment
                        <i class="bi bi-arrow-right primary-btn__icon"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Embed Map Section -->
<div class="iframe-section">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14605.143049103855!2d90.34589758036894!3d23.77283635325142!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0bcdf50fd59%3A0x9ab0a63bb3267107!2sAdabar%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1675528532574!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

@endsection

@push('custom-js')
    <script>
        $(document).ready(function(){
        })
    </script>
@endpush
