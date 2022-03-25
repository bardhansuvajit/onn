@extends('layouts.app')

@section('page', 'Cart')

@section('content')
<style>
.cart-item.item-qty .qty-box a {
    width: 30px;
    height: 30px;
    border: none;
    background: #101010;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding: 3px;
}
.cart-item.item-qty .qty-box a:hover {
    background: #c10909;
}
</style>

@if(count($data) > 0)
<section class="cart-header mt-5 mb-3 mb-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h4>Shopping Cart</h4>
            </div>
            {{-- <div class="col-sm-9">
                <ul class="cart-flow">
                    <li class="active"><a href="javascript: void(0)"><span>Cart</span></a></li>
                    <li><a href="javascript: void(0)"><span>Checkout</span></a></li>
                    <li><a href="javascript: void(0)"><span>Shipping</span></a></li>
                    <li><a href="javascript: void(0)"><span>Payment</span></a></li>
                </ul>
            </div> --}}
        </div>
    </div>
</section>

<section class="cart-wrapper">
    <div class="container">
        {{-- @if (Session::get('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if (Session::get('failure'))
        <div class="alert alert-danger">{{Session::get('failure')}}</div>
        @endif --}}

        <div class="cart-holder">
            <div class="cart-row cart-row--header">
                <div class="cart-item item-thumb">Image</div>
                <div class="cart-item item-title">Name and Style</div>
                <div class="cart-item item-attr">Size</div>
                <div class="cart-item item-attr">Color</div>
                <div class="cart-item item-price">Price</div>
                <div class="cart-item item-qty">Quantity</div>
                <div class="cart-item item-price">Amount</div>
                <div class="cart-item item-remove">Action</div>
            </div>

            @php
                $subTotal = $grandTotal = $couponCodeDiscount = 0;
                $shippingCharges = 0;
                $taxPercent = 0;
            @endphp

            @foreach($data as $cartKey => $cartValue)
            <div class="cart-row">
                <div class="cart-item item-thumb">
                    <figure>
                        <img src="{{$cartValue->product_image}}">
                    </figure>
                </div>
                <div class="cart-item item-title">
                    <h4>{{$cartValue->product_name}}</h4>
                    <h6>Style # OF {{$cartValue->product_style_no}}</h6>
                </div>
                @if ($cartValue->cartVariationDetails)
                    <div class="cart-item item-attr">
                        <div class="cart-text">Size</div>
                        <h4>{{$cartValue->cartVariationDetails->sizeDetails->name}}</h4>
                    </div>
                @endif
                @if ($cartValue->cartVariationDetails)
                <div class="cart-item item-attr">
                    <div class="cart-text">Colour</div>
                    <h4>{{ucwords($cartValue->cartVariationDetails->colorDetails->name)}}</h4>
                </div>
                @endif
                <div class="cart-item item-price">
                    <div class="cart-text">Price</div>
                    <h4>&#8377;{{$cartValue->offer_price}}</h4>
                </div>
                <div class="cart-item item-qty">
                    <div class="cart-text">Quantity</div>
                    <div class="qty-box">
                        <a href="{{ route('front.cart.quantity', [$cartValue->id, 'decr']) }}" class="decrement" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </a>
                        <input class="counter" type="number" value="{{$cartValue->qty}}">
                        <a href="{{ route('front.cart.quantity', [$cartValue->id, 'incr']) }}" class="increment" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </a>
                    </div>
                </div>
                <div class="cart-item item-price">
                    <div class="cart-text">Amount</div>
                    <h4>&#8377;{{$cartValue->offer_price * $cartValue->qty}}</h4>
                </div>
                <div class="cart-item item-remove">
                    <a href="{{route('front.cart.delete', $cartValue->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg><span>Remove</span></a>
                </div>
            </div>

            @php
                // subtotal calculation
                $subTotal += (int) $cartValue->offer_price * $cartValue->qty;

                // coupon code calculation
                if (!empty($data[0]->coupon_code_id)) {
                    $couponCodeDiscount = (int) $data[0]->couponDetails->amount;
                }

                // grand total calculation
                $grandTotalWithoutCoupon = $subTotal;
                $grandTotal = $subTotal - $couponCodeDiscount;
            @endphp

            @endforeach
        </div>
    </div>
    <div class="container mt-3 mt-sm-5">
        <div class="cart-summary">
            <div class="row justify-content-between flex-sm-row-reverse">
                <div class="col-sm-5">
                    <div class="w-100">
                        <div class="cart-total">
                            <div class="cart-total-label">
                                Subtotal
                            </div>
                            <div class="cart-total-value">
                                &#8377;<span id="subTotalAmount">{{$subTotal}}</span>
                            </div>
                        </div>
                        <div class="cart-total">
                            <div class="cart-total-label">
                                Shipping Charges
                            </div>
                            <div class="cart-total-value">
                                &#8377;{{$shippingCharges}}
                            </div>
                        </div>
                        <div class="cart-total">
                            <div class="cart-total-label">
                                Tax and Others - <strong>{{$taxPercent}}%</strong><br/>
                                <small>(Inclusive of all taxes)</small>
                            </div>
                            <div class="cart-total-value"></div>
                        </div>
                        <div id="appliedCouponHolder">
                        @if (!empty($data[0]->coupon_code_id))
                            <div class="cart-total">
                                <div class="cart-total-label">
                                    COUPON APPLIED - <strong>{{$data[0]->couponDetails->coupon_code}}</strong><br/>
                                    <a href="javascript:void(0)" onclick="removeAppliedCoupon()"><small>(Remove this coupon)</small></a>
                                </div>
                                <div class="cart-total-value">- {{$data[0]->couponDetails->amount}}</div>
                            </div>
                        @endif
                        </div>
                        <div class="cart-total">
                            <div class="cart-total-label">
                                Total
                            </div>
                            <div class="cart-total-value">
                                <input type="hidden" value="{{$grandTotalWithoutCoupon}}" name="grandTotalWithoutCoupon">
                                &#8377;<span id="displayGrandTotal">{{$grandTotal}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <ul class="cart-summary-list">
                        <li>
                            <img src="img/delivery-truck.png" />
                            <h5><span>&#8377;60</span> Apply Below order &#8377;499</h5>
                            <a href="{{route('front.content.shipping')}}">See all Shipping charges and policies</a>
                        </li>
                        <li>
                            <img src="img/coupon.png" />
                            <div class="coupon-block">
                                <input type="text" class="coupon-text" name="couponText" id="couponText" placeholder="Enter coupon code here" value="{{ (!empty($data[0]->coupon_code_id)) ? $data[0]->couponDetails->coupon_code : '' }}" {{ (!empty($data[0]->coupon_code_id)) ? 'disabled' : '' }}>
                                @if (!empty($data[0]->coupon_code_id))
                                    <button id="applyCouponBtn" style="background: #c1080a" disabled="true">Applied</button>
                                @else
                                    <button id="applyCouponBtn">Apply</button>
                                @endif
                                {{-- $('#applyCouponBtn').text('APPLIED').css('background', '#c1080a').attr('disabled', true); --}}
                            </div>
                            @error('lname')<p class="small text-danger mb-0 mt-2">{{$message}}</p>@enderror
                            <a href="{{route('front.user.coupon')}}" class="d-inline-block mt-2">Get latest coupon from here</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-sm-12 text-right mt-4">
                    <form action="{{route('front.checkout.index')}}" method="GET">
                        <button type="submit" class="btn checkout-btn">Proceed to checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@else
<section class="cart-header mb-3 mb-sm-5"></section>
<section class="cart-wrapper">
    <div class="container">
        <div class="complele-box">
            <figure>
                <img src="{{asset('img/empty-cart.png')}}" height="100">
            </figure>
            <figcaption>
                <h2>Your cart is empty</h2>
                <p>Shop now to get 30% OFF.</p>
                <a href="{{route('front.home')}}">Back to Home</a>
            </figcaption>
        </div>
    </div>
</section>
@endif

@endsection

@section('script')
    <script>
        // cart page coupon
        $('#applyCouponBtn').on('click', (e) => {
            e.preventDefault()
            let couponCode = $('input[name="couponText"]').val();
            if (couponCode.length > 0) {
                $.ajax({
                    url: '{{ route('front.cart.coupon.check') }}',
                    method: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        code: couponCode
                    },
                    beforeSend: function() {
                        $('#applyCouponBtn').text('Checking');
                        // $('#applyCouponBtn').text('Checking').attr('disabled', true);
                    },
                    success: function(result) {
                        // console.log(result);

                        if (result.type == 'success') {
                            $('#applyCouponBtn').text('APPLIED').css('background', '#c1080a').attr('disabled', true);

                            $('input[name="couponText"]').attr('disabled', true);
                            let beforeCouponValue = parseInt($('#displayGrandTotal').text());
                            let couponDiscount = parseInt(result.amount);
                            let discountedGrandTotal = beforeCouponValue - couponDiscount;
                            $('#displayGrandTotal').text(discountedGrandTotal);

                            /* $('input[name="coupon_code_id"]').val(result.id);
                            let grandTotal = $('input[name="grandTotal"]').val();
                            let discountedGrandTotal = parseInt(grandTotal) - parseInt(result.amount);
                            $('input[name="grandTotal"]').val(discountedGrandTotal);
                            $('#displayGrandTotal').text(discountedGrandTotal); */

                            let couponContent = `
                            <div class="cart-total">
                                <div class="cart-total-label">
                                    COUPON APPLIED - <strong>${couponCode}</strong><br/>
                                    <a href="javascript:void(0)" onclick="removeAppliedCoupon()"><small>(Remove this coupon)</small></a>
                                </div>
                                <div class="cart-total-value">- ${result.amount}</div>
                            </div>
                            `;

                            $('#appliedCouponHolder').html(couponContent);
                            toastFire(result.type, result.message);
                        } else {
                            toastFire(result.type, result.message);
                            $('#applyCouponBtn').text('Apply');
                        }
                    }
                });
            }
        });
    </script>
@endsection