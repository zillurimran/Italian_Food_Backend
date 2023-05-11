<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Site Meta Data -->
    <meta name="author" content="SoClose">
    <meta name="description" content="{{ generalsettings()->meta_description }}">
    <meta name="keywords" content="SoClose">
    <meta name="title" content="{{ generalsettings()->meta_title }}">

	<!-- Site Title -->
	<title>{{ config('app.name') }} @yield('title')</title>
	<!-- Favicon Link -->
	<link rel="icon" type="image/png" sizes="512x512" href="{{ asset('uploads/generalSettings') }}/{{ generalsettings()->favicon }}">
	<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('uploads/generalSettings') }}/{{ generalsettings()->favicon }}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uploads/generalSettings') }}/{{ generalsettings()->favicon }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('uploads/generalSettings') }}/{{ generalsettings()->favicon }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/generalSettings') }}/{{ generalsettings()->favicon }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/generalSettings') }}/{{ generalsettings()->favicon }}">
	<link rel="icon" type="image/x-icon" href="{{ asset('uploads/generalSettings') }}/{{ generalsettings()->favicon }}">

	<!-- All CSS -->
	<link rel="stylesheet" href="{{ asset('frontend_assets/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    @stack('plugins-css')

    <style>
        :root{
            --color-body: #F9F9F8;
            --color-btn-text: {{ colorSettings()->button_color }};
            --color-primary: {{ colorSettings()->primary_color }};
            --color-btn-hover: {{ colorSettings()->hover_color }};
            --color-secondary: {{ colorSettings()->bg_color }};
            --color-title: {{ colorSettings()->secondary_color }};
            --color-text: {{ colorSettings()->text_color }};
        }
    </style>
	<link rel="stylesheet" href="{{ asset('frontend_assets/assets/css/style.min.css') }}">
    @stack('custom-css')
</head>
<body data-spy="scroll" data-target="#scroll-spy-container" data-offset="100">
    @include('frontend.layout.header')

    @yield('main')

    @include('frontend.layout.footer')

	<!-- All Modals Section -->
    @stack('all-modals')

    <!-- Scroll To Top Button -->
    <div class="scroll-top position-fixed">
        <button class="scroll-top__btn border-0 d-inline-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-up"></i>
        </button>
    </div>

	<!-- All Scripts -->
	<script src="{{ asset('frontend_assets/assets/js/jquery-1.12.4.min.js') }}"></script>
	<script src="{{ asset('frontend_assets/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @stack('plugins-js')
	<script src="{{ asset('frontend_assets/assets/js/script.js') }}"></script>

    <!-- Login Modal -->
    <script>
        $(document).ready(function(){
            @if($errors->has('email') || $errors->has('name')|| $errors->has('register_email') || $errors->has('register_password') || $errors->has('confirm_password'))
            $('#authModal').modal('show');
            @if($errors->has('email'))
            $('#pills-login-btn').tab('show');
            @else
            $('#pills-register-btn').tab('show');
                @endif
            @endif

            @if(session('password'))
            $('#authModal').modal('show');
            $('#pills-login-btn').tab('show');
            @endif
        })
    </script>
    {{-- Subscribe --}}
    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
    <script>
        $(document).ready(function(){
           $('.subscribe').on('click', function(e){
            e.preventDefault();
            let subscriber_email = $('#subscriber_email').val();

            $.ajax({

                method: 'post',
                url: "{{ route('subscribers.store') }}",
                data: {'subscriber_email':subscriber_email},
                success:function(res){
                    if(res.status == 'success'){
                        $('#footer__form')[0].reset();
                        $('.msgContainer').removeClass('alert alert-danger').text('');
                        $('.msgContainer').addClass('alert alert-success text-center').text('Subscription Successful');
                        //

                    }
                },error:function(err){
                        let error = err.responseJSON;
                        $.each(error.errors,function(index, value){
                        $('.msgContainer').removeClass('alert alert-success text-center').text('');
                        $('.msgContainer').addClass('alert alert-danger').text(value);
                    })
                }
            })
           })
        })
    </script>
    @stack('custom-js')
</body>
</html>
