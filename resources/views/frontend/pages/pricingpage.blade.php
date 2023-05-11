@extends('frontend.layout.master')

@section('title', '| Pricing')

@section('header-active--pricing', 'active')

@section('main')

<!-- Breadcrumb Section -->
<div class="breadcrumb-section" aria-label="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('frontend.index') }}" class="breadcrumb-link"><i class="bi bi-house-door"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Pricing</li>
        </ul>
    </div>
</div>

@include('frontend.sections.pricing', ['class' => 'pt-0'])

<!-- Blog Section -->
<section class="section-gap section-gap--fix">
    <div class="container">
        <div class="section-header">
            <h1 class="section-header__title text-center">Form Our Blog</h1>
        </div>
        <div class="row justify-content-center">
            @for($i = 0; $i < 4; $i++)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10">
                <article class="blog-card">
                    <a href="{{ route('frontend.blog-details') }}" class="blog-card__header">
                        <img src="https://sticko.fr/uploads/ecommerce/blogs/3550.jpg" alt="blog preview" loading="lazy" class="blog-card__header__image">
                    </a>
                    <div class="blog-card__body">
                        <div class="blog-card__body__meta">
                            on <a href="#" class="blog-card__body__meta__link">November 02, 2022</a>
                        </div>
                        <h3 class="blog-card__body__title">
                            <a href="{{ route('frontend.blog-details') }}" class="blog-card__body__title__link">CUSTOMIZABLE NFC STICKER</a>
                        </h3>
                        <p class="blog-card__body__text">Sticko NFC stickers may be THE solution that will save you money, be enviro...</p>
                        <a href="{{ route('frontend.blog-details') }}" class="text-btn">
                            Read More
                            <i class="bi bi-arrow-right text-btn__icon"></i>
                        </a>
                    </div>
                </article>
            </div>
            @endfor
        </div>
    </div>
</section>

@endsection
