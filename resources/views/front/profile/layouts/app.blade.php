@extends('layouts.app')

@section('page', 'Profile')

@section('content')
<section class="cart-header mb-3 mb-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h4>Account Information</h4>
            </div>
        </div>
    </div>
</section>

<section class="cart-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="name-card">
                    <h4>{{Auth::guard('web')->user()->name}}</h4>
                    <h5>{{Auth::guard('web')->user()->email}}</h5>
                    <h5>{{Auth::guard('web')->user()->mobile}}</h5>
                </div>

                <ul class="account-list">
                    <li class="active">
                        <a href="{{route('front.user.profile')}}">Overview</a>
                    </li>
                    <li>
                        <span>Orders</span>
                        <ul><li><a href="{{route('front.user.order')}}">Orders & Returns</a></li></ul>
                    </li>
                    <li>
                        <span>Credits</span>
                        <ul>
                            <li><a href="{{route('front.user.coupon')}}">Coupons</a></li>
                        </ul>
                    </li>
                    <li>
                        <span>Account</span>
                        <ul>
                            <li><a href="{{route('front.user.manage')}}">Profile</a></li>
                            <li><a href="{{route('front.user.address')}}">Address</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                        </ul>
                    </li>
                    <li>
                        <span>Legal</span>
                        <ul>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            @yield('profile-content')

        </div>
    </div>
</section>
@endsection