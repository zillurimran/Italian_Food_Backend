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
                        <div class="card-header">
                            <h3 class="card-title">
                                TopUp Your Balance 
                            </h3>
                        </div>
                        <div class="card-body">
                            <form id="payment-form"> 
                                <div class="form-group">
                                    <input type="text" value="€ {{ $data['amount'] }}"  id="amount" name="amount" required readonly class="form-control">
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

            // validation Start from here

            //cardnumber,exp-date,cvc
            stripe.confirmCardPayment('{{ $data["client_secret"] }}', {
                payment_method: {
                card: card,
                billing_details: {
                    name: "{{ Auth::user()->name }}",
                    email: "{{ Auth::user()->email }}"
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
                        url : "{{ route('topup.success') }}",
                        data : {  
                            amount      : amount,
                        },
                        success : response => {
                            $('#card-success').text("payment successfully completed.");
                            setTimeout(() => {
                                window.location.href = "{{ route('dashboard')}}";
                            }, 500);
                        }
                    });
                //   console.log(card);
                    // setTimeout(
                    //   function(){ window.location.href = "{{url('/success')}}";
                    // }, 2000);
                }
                return false;
                }
            });
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
                        }else{
                            $('#loginUserWrap').slideDown();
                        }
                    },
                });
            });
        });
    </script>

</body>
</html>
