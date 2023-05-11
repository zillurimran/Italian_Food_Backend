@extends('frontend.layout.master')

@section('title', '| Blog Details')

@section('header-active--blog', 'active')

@section('main')

<!-- Breadcrumb Section -->
<div class="breadcrumb-section pt-0" aria-label="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('frontend.index') }}" class="breadcrumb-link"><i class="bi bi-house-door"></i></a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('frontend.blog') }}" class="breadcrumb-link">Blogs</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
        </ul>
    </div>
</div>

<section class="section-gap section-gap--fix pt-0">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <article class="blog-card blog-card--lg">
                            <div class="blog-card__header">
                                <img src="https://sticko.fr/uploads/ecommerce/blogs/3550.jpg" alt="blog preview" loading="lazy" class="blog-card__header__image">
                            </div>
                            <div class="blog-card__body">
                                <div class="blog-card__body__meta">
                                    by <a href="#" class="blog-card__body__meta__link">Sticko</a> on <a href="#" class="blog-card__body__meta__link">November 02, 2022</a>
                                </div>
                                <h3 class="blog-card__body__title">CUSTOMIZABLE NFC STICKER</h3>
                                <div class="editor-text">
                                    <p>Les autocollants NFC Sticko sont peut-être LA solution qui vous fera économiser de l’argent, une solution respectueuse de l’environnement et qui vous apporte des solutions afin d’améliorer vos expériences clients.</p>
                                    <p>Un autocollant papier NFC personnalisable sur métal avec une large gamme de formes, de tailles et de types de puces NFC.</p>
                                    <p>La plupart des types de puces NFC sont disponibles. Les personnalisations peuvent inclure des logos, des lettres, des chiffres et du texte en couleur ou noir et blanc. L'épaisseur de la couche de ferrite et la qualité de notre Stickers NFC est adapté pour avoir une durée de vie de 15 ans.</p>
                                    <p>La puce NFC est placées d’une certainement façon de lui proposer une grande résistance à l'eau.</p>
                                    <p>La couche de ferrite est elle nécessaire pour que l'autocollant NFC fonctionne sur des surfaces métalliques, électroniques ou magnétiques. Cette couche de ferrite est bien entendu inclus dans notre sticker NFC.</p>
                                    <p>Vous pouvez personnaliser votre sticker NFC est l’utiliser de la façon que vous le souhaitez sachant que le lien est complètement modifiable et à volonté à la différence d’un simple QRcode.</p>
                                    <p>Stickers NFC Sticko à utiliser pour inciter les gens à vous suivre sur les réseaux en quelques secondes (ils ont juste à poser leur téléphone directement sur votre sticker.) ou bien à mettre sur les tables de votre restaurant afin qu’ils puissent lire votre menu digital.</p>
                                </div>
                            </div>
                        </article>
                    </div>
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
                                        <li class="underline-list__item">
                                            <a href="#!" class="underline-list__link">Pins NFC</a>
                                        </li>
                                        <li class="underline-list__item">
                                            <a href="#!" class="underline-list__link">Carte de visite NFC</a>
                                        </li>
                                        <li class="underline-list__item">
                                            <a href="#!" class="underline-list__link">Porte Clef NFC</a>
                                        </li>
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
                                        <a href="#!" class="badge--tag">Tag 1</a>
                                        <a href="#!" class="badge--tag">Tag 2</a>
                                        <a href="#!" class="badge--tag">Tag 3</a>
                                        <a href="#!" class="badge--tag">Tag 4</a>
                                        <a href="#!" class="badge--tag">Tag 1</a>
                                        <a href="#!" class="badge--tag">Tag 2</a>
                                        <a href="#!" class="badge--tag">Tag 3</a>
                                        <a href="#!" class="badge--tag">Tag 4</a>
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
