<!DOCTYPE html>
  <html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .alert:empty{
            display: none;
        }
        .alert{
            margin-top: 1rem;
            margin-bottom: 0;
        }
        .form-control:disabled, .form-control[readonly] {
            background-color: #ffffff;
            opacity: 1;
        }
    </style>
  </head>
  <body>
    <div class="bg-light d-flex min-vh-100">
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-7 mx-auto py-5">
                    <div class="card">
                        <div class="card-body">
                            <form id="payment-form">    
                                {{-- <input autocomplete="false" name="hidden" type="text" style="display:none;"> --}}
                                {{-- <input type="hidden" value="{{ $data['package_id'] }}"  id="package_id">
                                <input type="hidden" value="{{ $data['phone'] }}"  id="phone" name="phone">
                                <input type="hidden" value="{{ $data['address'] }}"  id="address" name="address">
                                <input type="hidden" value="{{ $data['amount'] }}"  id="net_address"> --}}
                                <div id="emailSuccesAlert" class="alert alert-info" role="alert"></div>
                                <div class="form-group">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" id="name" name="name"  class="form-control">
                                    <input type="hidden" id="loginStatus" value="0">
                                    <div id="err_name" class="alert alert-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="email">Email Address</label>
                                    <input type="email" id="email" name="email"  class="form-control">
                                    <div id="err_email" class="alert alert-danger"></div>
                                </div>
                                <div id="loginUserWrap">
                                    <div class="form-group">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password" autocomplete="new-password"  class="form-control">
                                        <div id="err_password" class="alert alert-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="phone">Phone Number</label>
                                        <input type="number" id="phone" name="phone"  class="form-control">
                                        <div id="err_phone" class="alert alert-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="address">Address</label>
                                        <input type="text" id="address" name="address"  class="form-control">
                                        <div id="err_address" class="alert alert-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" value="€ {{ $data['amount'] }}"  id="amount" name="amount"  readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <div id="card-element"></div>
                                </div>
                                <button id="submit" class="paynow btn btn-success btn-block">Pay Now</button>
                                <div id="card-errors" class="alert alert-danger" role="alert"></div>
                                <div id="card-thank" class="alert alert-success" role="alert"></div>
                                <div id="card-message" class="alert alert-warning" role="alert"></div>
                                <div id="card-success" class="alert alert-success" role="alert"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">

        $('#card-success').text('');
        $('#card-errors').text('');
        var stripe = Stripe("{{ $data['stripe_setting']->stripe_key }}");
        var elements = stripe.elements();
        $('#submit').prop('disabled', true);
        // Set up Stripe.js and Elements to use in checkout form
        var style = {
            base: {
                color: "#32325d",
            }
        };

        var card = elements.create("card", { style: style });
        card.mount("#card-element");


        card.addEventListener('change', ({error}) => {
        const displayError = document.getElementById('card-errors');
        if (error) {
            displayError.textContent = error.message;
            $('#submit').prop('disabled', true);

        } else {
            displayError.textContent = '';
            $('#submit').prop('disabled', false);

        }
        });

        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(ev) {
            $('.loading').css('display','block');

            ev.preventDefault();
            let nameError = true, emailError = true, passwordError = true, phoneError = true, addressError = true;
            // validation Start from here
            // var  name = $('#name').val();
            // var  email = $('#email').val();
            // var  password = $('#password').val();
            // var  phone = $('#phone').val();
            // var  address = $('#address').val();

            function check_name(){
               var regex = /^[a-zA-z]*$/;
               var name = $('#name').val();
               if(regex.test(name) && name !== ''){
                    $('#err_name').hide();
                    nameError = false;
                }else{              
                    $('#err_name').text('Name should contain only characters');
                    $('#err_name').show();
                    nameError = true;
                
               }
            }

            function check_email(){
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                var email = $('#email').val();
                if (regex.test(email) && email !== ''){
                    emailError = false;
                    $('#err_email').hide();
                }else{
                    $('#err_email').html('Invalid Email');
                    $('#err_email').show();
                    emailError = true;
                    
                };
            }

            function check_password(){
                var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$/;
                var password_len = $('#password').val().length;
                if(password_len >= 6){
                    // var password = $('#password').val();
                    // if(regex.test(password) && password !== ''){
                        $('#err_password').hide();
                        passwordError = false;
                    // }
                }else{
                    $('#err_password').html('Minimum 6 character is required for password');
                    $('#err_password').show();
                    passwordError = true;
                    
                }
            }

            function check_address(){
                // var regex = /^[a-zA-Z0-9_-]$/;
                var address = $('#address').val();
                if (address !== ''){
                    $('#err_address').hide();
                    addressError = false;
                }else{
                    $('#err_address').html('Address is required');
                    $('#err_address').show();                 
                    addressError = true;
                };

            }

            function check_phone(){
                var regex = /[0-9]/;
                var phone = $('#phone').val();
                if(regex.test(phone) && phone !== ''){
                    $('#err_phone').hide();
                    phoneError = false;
                }else{
                    $('#err_phone').html('Phone should contain only numbers');
                    $('#err_phone').show();
                    phoneError = true;
                    
                }
            }


            check_name();
            check_email();
            if($('#loginStatus').val() == '0'){
                check_password();
                check_phone();
                check_address();
            }

            if($('#loginStatus').val() == '1'){
                passwordError = false, phoneError = false, addressError = false;
            }
            if(!nameError && !emailError && !passwordError && !phoneError && !addressError){ 
                //cardnumber,exp-date,cvc 
                stripe.confirmCardPayment('{{ $data["client_secret"] }}', {
                    payment_method: {
                    card: card,
                    billing_details: {
                        name: $('#name').val(),
                        email: $('#email').val()
                    }
                    },
                    setup_future_usage: 'off_session'
                }).then(function(result) {
                    $('.loading').css('display','none');
    
                    if (result.error) {
    
                    $('#card-errors').text(result.error.message);
    
                    } else {
                    if (result.paymentIntent.status === 'succeeded') {
    
                        let amount = result.paymentIntent.amount/100;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url : "{{ route('pamment.success') }}",
                            data : { 
                                name        : $('#name').val(),
                                email       : $('#email').val(),
                                password    : $('#password').val(),
                                phone       : $('#phone').val(), 
                                address     : $('#address').val(),
                                amount      : amount,
                            },
                            success : response => {
                                $('#card-success').text("payment successfully completed.");
                                setTimeout(() => {
                                    window.location.href = "{{ route('frontend.index')}}";
                                }, 500);
                            },
                        });
                    //   console.log(card);
                        // setTimeout(
                        //   function(){ window.location.href = "{{url('/success')}}";
                        // }, 2000);
                    }
                    return false;
                    }
                });

            }

        });

        $(document).ready(function(){
            $('#email').on('blur', function(){
                $('#emailSuccesAlert').text('');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url : "{{ route('user.email.check') }}",
                    data : { 
                        email   : $(this).val(),
                    },
                    success : response => {
                        if(response == 'found'){
                            $('#emailSuccesAlert').text('You have already an account with us');
                            $('#loginUserWrap').slideUp();
                            $('#loginStatus').val('1');
                        }else{
                            $('#loginUserWrap').slideDown();
                            $('#loginStatus').val('0');
                        }
                    },
                });
            });
        });
    </script>

</body>
</html>
