<!-- Pricing Section -->
<section @isset($id)id="{{ $id }}"@endisset class="pricing section-gap section-gap--fix @isset($class){{ $class }}@endisset">
    <div class="container">
        <div class="section-header">
            <h1 class="section-header__title text-center">Our offers</h1>
        </div>
        <div class="row justify-content-center">
            {{-- <div class="col-12 text-center mb-5">
                <div class="pricing-plan-toggler d-inline-block">
                    <label class="pricing-plan-toggler__btn">
                        <input type="radio" name="current_plan" value="monthly" class="pricing-plan-toggler__btn__input" checked="">
                        <span class="pricing-plan-toggler__btn__label">
                            Monthly
                        </span>
                    </label>
                    <label class="pricing-plan-toggler__btn">
                        <input type="radio" name="current_plan" value="yearly" class="pricing-plan-toggler__btn__input">
                        <span class="pricing-plan-toggler__btn__label">
                            Yearly
                        </span>
                    </label>
                </div>
            </div> --}}
            @foreach ($packagePricings as $packagePricing)
            <div class="col-lg-4 col-md-6 col-sm-9">
                <div class="{{ $packagePricing->id == '2' ? 'pricing-card pricing-card--featured' : 'pricing-card'}}">
                    <div class="text-center">
                        <div class="pricing-card__badge">{{ $packagePricing->package_type }}</div>
                    </div>
                    <h1 class="pricing-card__title">
                        <span class="pricing-card__title--month">
                            {{  $packagePricing->package_price }}€ <small class="pricing-card__title__sub-text">{{ $packagePricing->sms_quantity }} SMS</small>
                        </span>
                        {{-- <span class="pricing-card__title--year">
                            120€ <small class="pricing-card__title__sub-text">Year</small>
                        </span> --}}
                    </h1>
                    <p class="pricing-card__text">{{ $packagePricing->package_purpose }}</p>
                    <hr class="pricing-card__hr">
                    <ul class="pricing-card__list pricing-card__list--icon">

                        @foreach ($packageItems as $packageItem)
                        <li class="pricing-card__list__item">
                            <span class="pricing-card__list__item__icon">
                                <i class="bi bi-check-square-fill"></i>
                            </span>
                            {{$packageItem->package_items }}
                        </li>
                        @endforeach
                    </ul>
                    <form action="#!" method="POST">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $packagePricing->id }}">
                        <button type="button" class="{{ $packagePricing->id == '2' ? 'primary-btn btn-block' : 'primary-btn primary-btn--dark btn-block' }}">Buy Now</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- @push('all-modals')
<div class="modal fade" id="getUserInfoModal-{{ $packagePricing->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="modal__close" data-dismiss="modal" aria-label="Close">
                <i class="bi bi-x-lg"></i>
            </button>
            <div class="modal-body">
                <form action="{{ route('order.store') }}" method="POST" class="form">

                    @csrf

                    <input type="hidden" name="package_id" value="{{  $packagePricing->id }}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <span class="text-danger">*</span>
                        <input type="text" name="name" class="form-control"  required>
                        <div class="alert alert-danger">
                            <div class="alert-body">Name is requred</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Phone</label>
                        <span class="text-danger">*</span>
                        <input type="text" name="phone" class="form-control" required>
                        <div class="alert alert-danger">
                            <div class="alert-body">Phone is requred</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <span class="text-danger">*</span>
                        <input type="email" name="email" class="form-control"  required>
                        <div class="alert alert-danger">
                            <div class="alert-body">Email is requred</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Address</label>
                        <span class="text-danger">*</span>
                        <input type="text" name="address" class="form-control"  required>
                        <div class="alert alert-danger">
                            <div class="alert-body">Address is requred</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="primary-btn primary-btn--dark btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endpush --}}

@push('custom-js')
    {{-- <script>
        function TogglePrice(planState){
            $('.plan_type').val(planState);
            if(planState == "yearly"){
                $(".pricing-card__title--year").show()
                $(".pricing-card__title--month").hide()
            }else{
                $(".pricing-card__title--year").hide()
                $(".pricing-card__title--month").show()
            }
        };

        $(window).on("load", TogglePrice($(".pricing-plan-toggler__btn__input:checked").val()));

        $(document).ready(function(){
            $(".pricing-plan-toggler__btn__input").on("change", function(){
                if($(this).prop("checked")){
                    TogglePrice($(this).val())
                }
            })
        })
    </script> --}}
@endpush
