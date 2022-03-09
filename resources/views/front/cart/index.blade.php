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

<section class="cart-header mb-3 mb-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h4>Shopping Cart</h4>
            </div>
            <div class="col-sm-9">
                <ul class="cart-flow">
                    <li class="active"><a href="#"><span>Cart</span></a></li>
                    <li><a href="#"><span>Checkout</span></a></li>
                    {{-- <li><a href="#"><span>Shipping</span></a></li> --}}
                    {{-- <li><a href="#"><span>Payment</span></a></li> --}}
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="cart-wrapper">
    @if(count($data) > 0)
    <div class="container">
        @if (Session::get('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if (Session::get('failure'))
        <div class="alert alert-danger">{{Session::get('failure')}}</div>
        @endif

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
                $subTotal = 0;
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
            $subTotal += $cartValue->offer_price * $cartValue->qty;
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
                                &#8377;{{$subTotal}}
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
                    </div>
                </div>
                <div class="col-sm-5">
                    <ul class="cart-summary-list">
                        <li>
                            <img src="img/delivery-truck.png" />
                            <h5><span>&#8377;60</span> Apply Below order &#8377;499</h5>
                            <p>See all Shipping charges and policies</p>
                        </li>
                        <li>
                            <img src="img/coupon.png" />
                            <form class="coupon-block">
                                <input type="text" class="coupon-text">
                                <button type="submit">Apply</button>
                            </form>
                            <h5>Apply your coupon</h5>
                            <p>Get latest coupon from here</p>
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
    @else
    <div class="container">
        <p>Your cart is empty</p>
    </div>
    @endif
</section>
@endsection