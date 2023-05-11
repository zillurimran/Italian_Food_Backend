@extends('frontend.layout.master')

@section('title', '| Change Password')

@section('main')

<!-- Contact Section -->
<section class="section-gap section-border section-border--top">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-8 mx-auto">
                <div class="section-header text-center">
                    <div class="icon-box d-inline-block mb-4">
                        <i class="bi bi-lock"></i>
                    </div>
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                    <h1 class="section-header__title section-header__title--lg text-capitalize">Créer un nouveau mot de passe</h1>
                </div>
                <form action="{{ route('update.password') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="input-group bg-white">
                            <input type="hidden" value="{{ $user_id }}" name="user_id">
                            <input type="hidden" value="{{ $code_id }}" name="code_id">
                            <input data-target="password" type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                            <div class="input-group-append">
                                <button data-toggle="password" type="button" class="btn btn-outline-dark rounded-0 shadow-none">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group bg-white">
                            <input data-target="password" type="password" name="password_confirm" class="form-control" placeholder="Confirmez le mot de passe" required>
                            <div class="input-group-append">
                                <button data-toggle="password" type="button" class="btn btn-outline-dark rounded-0 shadow-none">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="primary-btn primary-btn--has-icon primary-btn--dark btn-block">
                        Confirmer
                        <i class="bi bi-check-lg primary-btn__icon"></i>
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
