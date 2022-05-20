@extends('front.profile.layouts.app')

@section('profile-content')
<div class="col-sm-7">
    <div class="profile-card">
        <h3>Order History</h3>

        @forelse($data as $orderKey => $orderValue)

        @php
        $orderSTatus = "Unknown";
        switch($orderValue->status) {
            case 1: $orderSTatus = "New";break;
            case 2: $orderSTatus = "Confirmed";break;
            case 3: $orderSTatus = "Shipped";break;
            case 4: $orderSTatus = "Delivered";break;
            case 5: $orderSTatus = "Cancelled";break;
            default: $orderSTatus = "Unknown";break;
        }
        @endphp

        <div class="order-card">
            <div class="order-card-header">
                <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                </figure>
                <figcaption>
                    <h5 class="{{ ($orderSTatus == "Cancelled" ? 'text-danger' : 'text-success') }}">Status : {{$orderSTatus}}</h5>
                    <p>Ordered On {{date('D, j M Y', strtotime($orderValue->created_at))}}</p>
                </figcaption>
            </div>
            <div class="order-card-body">
                @foreach($orderValue->orderProducts as $productKey => $productValue)

                @php
                    $variation = '';
                    if($productValue->productVariationDetails) {
                        $variation = '| Color: <span>'.ucwords($productValue->productVariationDetails->colorDetails->name).'</span> | Size: <span>'.$productValue->productVariationDetails->sizeDetails->name.'</span>';
                    }
                @endphp

                <div class="order-product-card">
                    <figure>
                        <img src="{{asset($productValue->product_image)}}" />
                    </figure>
                    <figcaption>
                        {{-- <h6>Style # OF {{$productValue->product_style_no}}</h6> --}}
                        <h4>{{$productValue->product_name}}</h4>
                        <h5>Price: <span>&#8377;{{$productValue->offer_price}}</span> {!!$variation!!} | Qty: <span>{{$productValue->qty}}</span></h5>
                    </figcaption>
                </div>
                @endforeach
            </div>
            <div class="order-card-footer">
                <div class="row">
                    <div class="col-sm-6">
                        Order # {{$orderValue->order_no}}
                    </div>
                    <div class="col-sm-6 text-sm-right">
                        Total Order Price: &#8377; {{$orderValue->final_amount}}
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p>No orders found</p>
        @endforelse

        {{-- <div class="order-card">
            <div class="order-card-header">
                <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                </figure>
                <figcaption>
                    <h5 class="text-success">Order Delivered</h5>
                    <p>On Tue, 30 Mar 2021</p>
                </figcaption>
            </div>
            <div class="order-card-body">
                <div class="order-product-card">
                    <figure>
                        <img src="img/v_neck_tshirt.png" />
                    </figure>
                    <figcaption>
                        <h6>Style # OF NC423</h6>
                        <h4>V Neck T-shirt</h4>
                        <h5>Price: <span>&#8377;450</span> | Size: <span>XXL</span> | Color: <span>Red</span> | Qty: <span>1</span></h5>
                    </figcaption>
                </div>
                <div class="order-product-card">
                    <figure>
                        <img src="img/v_neck_tshirt.png" />
                    </figure>
                    <figcaption>
                        <h6>Style # OF NC423</h6>
                        <h4>V Neck T-shirt</h4>
                        <h5>Price: <span>&#8377;450</span> | Size: <span>XXL</span> | Color: <span>Red</span> | Qty: <span>1</span></h5>
                    </figcaption>
                </div>
            </div>
            <div class="order-card-footer">
                <div class="row">
                    <div class="col-sm-6">
                        Order # 0NN20221234
                    </div>
                    <div class="col-sm-6 text-sm-right">
                        Total Order Price: &#8377; 900
                    </div>
                </div>
            </div>
        </div>

        <div class="order-card">
            <div class="order-card-header">
                <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </figure>
                <figcaption>
                    <h5 class="text-danger">Order Cancelled</h5>
                    <p>On Tue, 30 Mar 2021</p>
                </figcaption>
            </div>
            <div class="order-card-body">
                <div class="order-product-card">
                    <figure>
                        <img src="img/v_neck_tshirt.png" />
                    </figure>
                    <figcaption>
                        <h6>Style # OF NC423</h6>
                        <h4>V Neck T-shirt</h4>
                        <h5>Price: <span>&#8377;450</span> | Size: <span>XXL</span> | Color: <span>Red</span> | Qty: <span>1</span></h5>
                    </figcaption>
                </div>
            </div>
            <div class="order-card-footer">
                <div class="row">
                    <div class="col-sm-6">
                        Order # 0NN20221234
                    </div>
                    <div class="col-sm-6 text-sm-right">
                        Total Order Price: &#8377; 900
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection