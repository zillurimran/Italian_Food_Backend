@extends('frontend.layout.master')

@section('title', '| Forgot Password')

@section('main')

<!-- Contact Section -->
<section class="section-gap section-border section-border--top">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-8 mx-auto">
                <div class="section-header text-center">
                    <div class="icon-box d-inline-block mb-4">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <h1 class="section-header__title section-header__title--lg text-capitalize">Mettre à jour le mot de passe</h1>
                    <p>Renseignez l'email associé à votre compte, nous vous envoyons un code à 5 chiffres pour mettre à jour votre mot de passe</p>
                </div>
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form action="{{ route('send.code') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <button type="submit" class="primary-btn primary-btn--has-icon primary-btn--dark btn-block">
                        Envoyer le code
                        <i class="bi bi-arrow-right primary-btn__icon"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('custom-js')
    <script>
        $(document).ready(function(){
        })
    </script>
@endpush
