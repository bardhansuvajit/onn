@extends('layouts.app')

@section('page', 'Checkout')

@section('content')
<style>
.cart-flow li:before {
    width: calc(1200px / 3);
}
</style>

<section class="cart-header mb-3 mb-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h4>Shopping Checkout</h4>
            </div>
            <div class="col-sm-9">
                <ul class="cart-flow">
                    <li class="active"><a href="#"><span>Cart</span></a></li>
                    <li class="active"><a href="#"><span>Checkout</span></a></li>
                    {{-- <li><a href="#"><span>Shipping</span></a></li> --}}
                    {{-- <li><a href="#"><span>Payment</span></a></li> --}}
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="cart-wrapper">
    <div class="container">
        <form class="checkout-form" method="POST" action="{{route('front.checkout.store')}}">@csrf
            <div class="row justify-content-between flex-sm-row-reverse">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <h4 class="cart-heading">Cart Summary</h4>
                    <ul class="cart-summary">
                        @php
                            $subTotal = 0;
                            $shippingCharges = 0;
                            $taxPercent = 0;
                        @endphp

                        @foreach ($cartData as $cartKey => $cartValue)
                        <li>
                            <figure>
                                <img src="{{$cartValue->product_image}}" />
                            </figure>
                            <figcaption>
                                <div class="cart-info">
                                    <h4>{{$cartValue->product_name}}</h4>
                                    <h6>Style # OF {{$cartValue->product_style_no}}</h6>
                                    @if ($cartValue->cartVariationDetails)
                                        <p>{{$cartValue->cartVariationDetails->sizeDetails->name.', '.ucwords($cartValue->cartVariationDetails->colorDetails->name)}}</p>
                                    @endif
                                </div>
                                <div class="card-meta">
                                    <h4>&#8377;{{$cartValue->offer_price * $cartValue->qty}}</h4>
                                </div>
                            </figcaption>
                        </li>
                        @php $subTotal += $cartValue->offer_price * $cartValue->qty @endphp
                        @endforeach
                    </ul>
                    <div class="w-100">
                        <div class="cart-total">
                            <div class="cart-total-label">
                                Subtotal
                            </div>
                            <div class="cart-total-value">
                                &#8377;{{$subTotal}}
                            </div>
                        </div>
                        <div class="cart-total-label mt-3 mb-3">
                            Shipping Method
                        </div>
                        <ul class="checkout-meta mb-2">
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shipping_method" id="flexRadioDefault1" value="standard" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Standard
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shipping_method" id="flexRadioDefault2" value="standard_cod">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Standard Shipping (Cash on Delivery)
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shipping_method" id="flexRadioDefault3" value="express_shipping">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Express Shipping
                                    </label>
                                </div>
                            </li>
                        </ul>
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
                            <div class="cart-total-value">

                            </div>
                        </div>
                        <div class="cart-total">
                            <div class="cart-total-label">
                                Total
                            </div>
                            <div class="cart-total-value">
                                &#8377;{{$subTotal}}
                            </div>
                        </div>
                        <div class="cart-total-label mt-3 mb-3">
                            Payment Method
                        </div>
                        <ul class="checkout-meta mb-2">
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="payment_method_cod" value="cash_on_delivery" checked>
                                    <label class="form-check-label" for="payment_method_cod">
                                        Cash on Delivery (COD)
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="payment_method_online" value="online_payment">
                                    <label class="form-check-label" for="payment_method_online">
                                        Razorpay (Cards, UPI, NetBanking, Wallets, Paypal)
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h4 class="cart-heading">Contact Information</h4>
                    <div class="row mb-5">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="fname" value="@auth{{Auth::guard('web')->user()->fname}}@else{{old('fname')}}@endauth" placeholder="First Name">
                                <label class="floating-label">First Name</label>
                            </div>
                            @error('fname')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="lname" value="@auth{{Auth::guard('web')->user()->lname}}@else{{old('lname')}}@endauth" placeholder="Last Name">
                                <label class="floating-label">Last Name</label>
                            </div>
                            @error('lname')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Enter Your Email Address" value="@auth{{Auth::guard('web')->user()->email}}@else{{old('email')}}@endauth">
                                <label class="floating-label">Enter Your Email Address</label>
                            </div>
                            @error('email')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="tel" class="form-control" name="mobile" placeholder="Enter Your Contact Number" value="@auth{{Auth::guard('web')->user()->mobile}}@else{{old('mobile')}}@endauth">
                                <label class="floating-label">Enter Your Contact Number</label>
                            </div>
                            @error('mobile')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                    </div>

                    <h4 class="cart-heading">Billing address</h4>

                    @if (isset($addressData))
                    @foreach ($addressData as $addressKey => $addressValue)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="existing_billing_address" id="existing_billing_address.{{$addressValue->id}}" value="{{$addressValue->id}}" {{$addressKey == 0 ? 'checked' : ''}}>
                            <label class="form-check-label" for="existing_billing_address.{{$addressValue->id}}">
                                <span class="billing_address">{{$addressValue->address}}</span>, 
                                <span class="billing_country">{{$addressValue->country ? $addressValue->country.', ' : ''}}</span>
                                <span class="billing_landmark">{{$addressValue->landmark ? $addressValue->landmark.', ' : ''}}</span>, 
                                <span class="billing_city">{{$addressValue->city}}</span>, 
                                <span class="billing_state">{{$addressValue->state}}</span>, 
                                <span class="billing_pin">{{$addressValue->pin}}</span>
                            </label>
                        </div>
                    @endforeach
                    @endif

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="billing_country" value="{{old('billing_country')}}" placeholder="Country/Region">
                                <label class="floating-label">Country/Region</label>
                            </div>
                            @error('billing_country')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        {{-- <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="email"  value="{{old('email')}}" placeholder="Company (Optional)">
                                <label class="floating-label">Company (Optional)</label>
                            </div>
                        </div> --}}
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="billing_address" value="{{old('billing_address')}}" placeholder="Address">
                                <label class="floating-label">Address</label>
                            </div>
                            @error('billing_address')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="billing_landmark" value="{{old('billing_landmark')}}" placeholder="Landmark">
                                <label class="floating-label">Landmark</label>
                            </div>
                            @error('billing_landmark')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="billing_city" value="{{old('billing_city')}}" placeholder="City">
                                <label class="floating-label">City</label>
                            </div>
                            @error('billing_city')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="billing_state" value="{{old('billing_state')}}" placeholder="State">
                                <label class="floating-label">State</label>
                            </div>
                            @error('billing_state')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="billing_pin" value="{{old('billing_pin')}}" placeholder="Pin Code">
                                <label class="floating-label">Pin Code</label>
                            </div>
                            @error('billing_pin')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                    </div>

                    <h4 class="cart-heading">Shipping address</h4>

                    {{-- @if (isset($addressData))
                    @foreach ($addressData as $addressKey => $addressValue)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="existing_shipping_address" id="existing_shipping_address.{{$addressValue->id}}" value="{{$addressValue->id}}" {{$addressKey == 0 ? 'checked' : ''}}>
                            <label class="form-check-label" for="existing_shipping_address.{{$addressValue->id}}">
                                <span class="billing_address">{{$addressValue->address}}</span>, 
                                <span class="billing_country">{{$addressValue->country ? $addressValue->country.', ' : ''}}</span>
                                <span class="billing_landmark">{{$addressValue->landmark ? $addressValue->landmark.', ' : ''}}</span>, 
                                <span class="billing_city">{{$addressValue->city}}</span>, 
                                <span class="billing_state">{{$addressValue->state}}</span>, 
                                <span class="billing_pin">{{$addressValue->pin}}</span>
                            </label>
                        </div>
                    @endforeach
                    @endif --}}

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" name="shippingSameAsBilling" type="checkbox" value="1" id="flexCheckDefault" checked>
                                    <label class="form-check-label" for="flexCheckDefault" >
                                        Same as Billing Address
                                    </label>
                                </div>
                            </div>
                            @error('shippingSameAsBilling')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                    </div>

                    <div class="row s-add">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="shipping_country" value="{{old('shipping_country')}}" placeholder="Country/Region">
                                <label class="floating-label">Country/Region</label>
                            </div>
                            @error('shipping_country')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="shipping_address" value="{{old('shipping_address')}}" placeholder="Address">
                                <label class="floating-label">Address</label>
                            </div>
                            @error('shipping_address')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="shipping_landmark" value="{{old('shipping_landmark')}}" placeholder="Landmark">
                                <label class="floating-label">Landmark</label>
                            </div>
                            @error('shipping_landmark')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="shipping_city" value="{{old('shipping_city')}}" placeholder="City">
                                <label class="floating-label">City</label>
                            </div>
                            @error('shipping_city')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="shipping_state" value="{{old('shipping_state')}}" placeholder="State">
                                <label class="floating-label">State</label>
                            </div>
                            @error('shipping_state')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="shipping_pin" value="{{old('shipping_pin')}}" placeholder="Pin Code">
                                <label class="floating-label">Pin Code</label>
                            </div>
                            @error('shipping_pin')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                    </div>

                    <div class="row align-items-center justify-content-between">
                        <div class="col-sm-auto">
                            <button type="submit" class="btn checkout-btn">Complete Order</button>
                        </div>
                        <div class="col-sm-auto mt-3 mt-sm-0">
                            <a href="{{route('front.cart.index')}}">Return to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- <div class="container mt-3 mt-sm-5">
    </div> --}}
</section>
@endsection