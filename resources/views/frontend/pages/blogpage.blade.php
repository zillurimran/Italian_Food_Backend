@extends('frontend.layout.master')

@section('title', '| Blogs')

@section('header-active--blog', 'active')

@section('main')

<!-- Breadcrumb Section -->
<div class="breadcrumb-section pt-0" aria-label="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('frontend.index') }}" class="breadcrumb-link"><i class="bi bi-house-door"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Blogs</li>
        </ul>
    </div>
</div>

<section class="section-gap section-gap--fix pt-0">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="row">
                    @for($i = 0; $i < 4; $i++)
                    <div class="col-lg-12 col-md-6">
                        <article class="blog-card blog-card--lg">
                            <a href="{{ route('frontend.blog-details') }}" class="blog-card__header">
                                <img src="https://sticko.fr/uploads/ecommerce/blogs/3550.jpg" alt="blog preview" loading="lazy" class="blog-card__header__image">
                            </a>
                            <div class="blog-card__body">
                                <div class="blog-card__body__meta">
                                    by <a href="{{ route('frontend.blog-details') }}" class="blog-card__body__meta__link">Sticko</a> on <a href="{{ route('frontend.blog-details') }}" class="blog-card__body__meta__link">November 02, 2022</a>
                                </div>
                                <h3 class="blog-card__body__title">
                                    <a href="{{ route('frontend.blog-details') }}" class="blog-card__body__title__link">CUSTOMIZABLE NFC STICKER</a>
                                </h3>
                                <p class="blog-card__body__text">Sticko NFC stickers may be THE solution that will save you money, be environmentally friendly and provide you with solutions to improve your customer experience.</p>
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
            <div class="col-xl-3 col-lg-4">
                <aside class="page-aside">
                    <form action="#!" class="input-group mb-3">
                        <input type="search" name="blog_search" class="form-control" placeholder="Search in blog">
                        <div class="input-group__item input-group__item--right">
                            <button type="submit" class="btn shadow-none">
                              <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="accordion" id="accordionParent">
                        <div class="accordion-card">
                            <button class="accordion-card__header" type="button" data-toggle="collapse" data-target="#collapse-1" aria-expanded="true">
                                Blog Categories
                                <span class="accordion-card__header__icon"></span>
                            </button>
                            <div id="collapse-1" class="collapse show" data-parent="#accordionParent">
                                <div class="accordion-card__body">
                                    <ul class="underline-list">
                                        @forelse($categories as $category)
                                        <li class="underline-list__item">
                                            <a href="#!" class="underline-list__link">{{ $category->name }}</a>
                                        </li>
                                        @empty
                                        <li class="underline-list__item">
                                            <div class="alert alert-danger">
                                                <div class="alert-body">No category found</div>
                                            </div>
                                        </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-card">
                            <button class="accordion-card__header" type="button" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false">
                                Popular Posts
                                <span class="accordion-card__header__icon"></span>
                            </button>
                            <div id="collapse-2" class="collapse" data-parent="#accordionParent">
                                <div class="accordion-card__body">
                                    <article class="aside-card">
                                        <div class="aside-card__header">
                                            <img src="https://sticko.fr/uploads/ecommerce/blogs/3550.jpg" alt="blog" draggable="false" loading="lazy" class="aside-card__header__image">
                                        </div>
                                        <div class="aside-card__body">
                                            <time class="aside-card__meta">Jan 10, 2023</time>
                                            <a href="{{ route('frontend.blog-details') }}" class="aside-card__title">AUTOCOLLANT NFC PERONNALISABLE</a>
                                        </div>
                                    </article>
                                    <article class="aside-card">
                                        <div class="aside-card__header">
                                            <img src="https://sticko.fr/uploads/ecommerce/blogs/3550.jpg" alt="blog" draggable="false" loading="lazy" class="aside-card__header__image">
                                        </div>
                                        <div class="aside-card__body">
                                            <time class="aside-card__meta">Jan 10, 2023</time>
                                            <a href="{{ route('frontend.blog-details') }}" class="aside-card__title">AUTOCOLLANT NFC PERONNALISABLE</a>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-card">
                            <button class="accordion-card__header" type="button" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false">
                                Tag Cloud
                                <span class="accordion-card__header__icon"></span>
                            </button>
                            <div id="collapse-3" class="collapse" data-parent="#accordionParent">
                                <div class="accordion-card__body">
                                    <div class="tag-group">
                                        @forelse($tags as $tag)
                                        <a href="#!" class="badge--tag">{{ $tag->name }}</a>
                                        @empty
                                        <div class="alert alert-danger w-100 mb-0">
                                            <div class="alert-body">No tag found</div>
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

@endsection

@push('custom-js')
    <script>
    </script>
@endpush
