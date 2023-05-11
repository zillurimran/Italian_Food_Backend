@extends('frontend.layout.master')

@section('title', '| Code Verify')

@section('main')

<!-- Contact Section -->
<section class="section-gap section-border section-border--top">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-8 mx-auto">
                <div class="section-header text-center">
                    <div class="icon-box d-inline-block mb-4">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <h1 class="section-header__title section-header__title--lg text-capitalize">Le code de vérification</h1>
                    <p>Entrez le code envoyé par email</p>
                </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <input id="one" type="text" maxlength="1" name="one" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input id="two" type="text" maxlength="1" name="two" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input id="three" type="text" maxlength="1" name="three" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input id="four" type="text" maxlength="1" name="four" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input id="five" type="text" maxlength="1" name="five" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <button id="verifyCode" class="primary-btn primary-btn--has-icon primary-btn--dark btn-block">
                        Vérifier
                        <i class="bi bi-arrow-right primary-btn__icon"></i>
                    </button>
                @if(session('user_id'))
                    <form action="{{ route('send.code') }}" method="post">
                        @csrf
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <button id="check" type="submit" class="primary-btn primary-btn--has-icon primary-btn--dark btn-block mt-2">
                            Renvoyer le code
                            <i class="bi bi-arrow-right primary-btn__icon"></i>
                        </button>
                    </form>
                @else
                <a id="resend" href="{{ route('forgot.password') }}" class="primary-btn primary-btn--has-icon primary-btn--dark btn-block mt-3">
                    Renvoyer le code
                    <i class="bi bi-arrow-right primary-btn__icon"></i>
                </a>
                @endif


                {{-- Error message --}}
                <div id="invalid" class="alert alert-danger d-none mt-3">
                    <strong>Code invalide</strong>
                </div>
                <div id="spinner" class="text-center mt-3 d-none">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@push('custom-js')
    <script>
        $(document).ready(function(){



            $("#verifyCode").click(function(){

                $("#verifyCode").addClass('d-none');
                $("#invalid").addClass('d-none');
                $("#resend").addClass('d-none');
                $("#check").addClass('d-none');

                $("#spinner").removeClass('d-none');
                setTimeout(function(){
                    $("#spinner").addClass('d-none');
                }, 3000);

                var code = $("#one").val() + $("#two").val() + $("#three").val() + $("#four").val() + $("#five").val();
                var user_id = $("#five").val();

                $.ajax({
                    url: "{{ route('validate.code') }}",
                    type: "POST",
                    data: {
                        code: code,
                        user_id : user_id,
                    },
                    success: function(result){
                        if(!result){

                            $("#spinner").addClass('d-none');
                            $("#invalid").removeClass('d-none');
                            $("#resend").removeClass('d-none');
                            $("#check").removeClass('d-none');
                            $("#verifyCode").removeClass('d-none');
                        }
                        else{
                            window.location.href = "{{ route('change.password') }}";
                        }

                    }
                })

            })


        })
    </script>
@endpush
