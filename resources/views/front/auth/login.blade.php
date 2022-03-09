@extends('layouts.app')

@section('page', 'Login')

@section('content')
<section class="register-wrapper">
    <div class="register-left">
        <!-- <div class="register-collection__thumb swiper-container">
            <div class="slider swiper-wrapper">
                <div class="register-collection__thumb-single swiper-slide">
                    <h3>Grandde Collection</h3>
                    <p><a href="listing.html">View All Products</a></p>
                    <img src="img/range3.png"  class="img-fluid">
                </div>
                <div class="register-collection__thumb-single swiper-slide">
                    <h3>Stretchz Collection</h3>
                    <p><a href="listing.html">View All Products</a></p>
                    <img src="img/range3.png"  class="img-fluid">
                </div>
                <div class="register-collection__thumb-single swiper-slide">
                    <h3>Sport Collection</h3>
                    <p><a href="listing.html">View All Products</a></p>
                    <img src="img/range3.png"  class="img-fluid">
                </div>
                <div class="register-collection__thumb-single swiper-slide">
                    <h3>Comfortz Collection</h3>
                    <p><a href="listing.html">View All Products</a></p>
                    <img src="img/range3.png"  class="img-fluid">
                </div>
                <div class="register-collection__thumb-single swiper-slide">
                    <h3>Platina Collection</h3>
                    <p><a href="listing.html">View All Products</a></p>
                    <img src="img/range2.png"  class="img-fluid">
                </div>
                <div class="register-collection__thumb-single swiper-slide">
                    <h3>Acttive Collection</h3>
                    <p><a href="listing.html">View All Products</a></p>
                    <img src="img/range5.png"  class="img-fluid">
                </div>
                <div class="register-collection__thumb-single swiper-slide">
                    <h3>Relaxz Collection</h3>
                    <p><a href="listing.html">View All Products</a></p>
                    <img src="img/range6.png"  class="img-fluid">
                </div>
                <div class="register-collection__thumb-single swiper-slide">
                    <h3>Footkins Collection</h3>
                    <p><a href="listing.html">View All Products</a></p>
                    <img src="img/range4.png"  class="img-fluid">
                </div>
                <div class="register-collection__thumb-single swiper-slide">
                    <h3>Thermal Collection</h3>
                    <p><a href="listing.html">View All Products</a></p>
                    <img src="img/range.png"  class="img-fluid">
                </div>
                <div class="register-collection__thumb-single swiper-slide">
                    <h3>Winter Collection</h3>
                    <p><a href="listing.html">View All Products</a></p>
                    <img src="img/range1.png"  class="img-fluid">
                </div>
            </div>
        </div> -->
    </div>
    <div class="register-right">
        <form method="POST" action="{{route('front.user.check')}}">@csrf
            <div class="register-block">
                <div class="register-logo">
                    <img src="{{asset('img/logo.png')}}">
                </div>
                <h3>Login</h3>
                <h4>Welcome to ONN</h4>

                <div class="register-card">
                    <div class="register-group">
                        <input type="email" class="register-box" name="email" placeholder="Email id" value="{{old('email')}}" autofocus>
                        <label class="floating-label">Email id</label>
                        @error('email') <p class="small text-danger mb-0">{{$message}}</p> @enderror
                    </div>
                    <div class="register-group">
                        <input type="password" class="register-box" name="password" placeholder="Password">
                        <label class="floating-label">Password</label>
                        @error('password') <p class="small text-danger mb-0">{{$message}}</p> @enderror
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-5">
                        <a href="#">Login with OTP</a>
                    </div>
                    <div class="col-7">
                        <button type="submit">Login</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection