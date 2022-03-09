<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ONN Total Comfort | @yield('page')</title>

    <link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('css/plugin.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/select2/dist/css/select2.min.css') }}">
    <link rel='stylesheet' href='{{ asset('node_modules/lightbox2/dist/css/lightbox.min.css?ver=5.8.2') }}'>
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('scss/css/preload.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <header>
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="nav-toggle">
                    <span></span>
                </div>
                <div class="col-auto">
                    <a href="{{ route('front.home') }}" class="logo">
                        <img src="{{ asset('img/logo.png') }}">
                    </a>
                </div>
                <div class="col-auto d-none d-md-block ml-auto">
                    <nav class="main-nav">
                        <ul>
                            <li>
                                <a href="{{ route('front.home') }}" class="home"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a>
                            </li>
                            <li>
                                <a href="{{ route('front.collection.detail', $collections[0]->slug) }}">Collection <i class="far fa-angle-down"></i></a>
                                <div class="sub-menu mega-menu">
                                    <aside>
                                        <ul>
                                            @foreach($collections as $collectionKey => $collectionValue)
                                                <li><a data-src="{{asset($collectionValue->image_path)}}" href="{{ route('front.collection.detail', $collectionValue->slug) }}">{{$collectionValue->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </aside>
                                    <content>
                                        <img src="{{ asset($collections[0]->image_path) }}" id="bgimage"  class="img-fluid">
                                    </content>
                                </div>
                            </li>
                            <li>
                                <a href="{{ route('front.category.detail', $categories[0]->slug) }}">Categories <i class="far fa-angle-down"></i></a>
                                <div class="sub-menu mega-menu">
                                    <aside>
                                        <ul>
                                            @foreach($categories as $categoryKey => $categoryValue)
                                                <li><a data-src="{{asset($categoryValue->image_path)}}" href="{{ route('front.category.detail', $categoryValue->slug) }}">{{$categoryValue->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </aside>
                                    <content>
                                        <img src="{{ asset($categories[0]->image_path) }}" id="bgimage"  class="img-fluid">
                                    </content>
                                </div>
                            </li>
                            <li>
                                <a href="listing.html">Sale</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-auto">
                    <nav class="account-nav">
                        <ul>
                            <li>
                                <a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('front.user.login')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="{{ (Auth::guard('web')->check()) ? '#c10909' : 'currentColor' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('front.cart.index')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <div class="overlay">
        <div class="overlay__close">
            <i class="fal fa-times"></i>
        </div>
        <div class="menu__row">
            <div class="menu__block">
                <div class="menu__text">Footkins</div>
                <div class="menu__links">
                    <ul>
                        <li><a href="details.html">No Show Socks</a></li>
                        <li><a href="details.html">Low Show Socks</a></li>
                        <li><a href="details.html">Ankelt Socks</a></li>
                        <li><a href="details.html">Ankelt Plated Socks</a></li>
                        <li><a href="details.html">High Ankelt Half Terry Socks</a></li>
                        <li><a href="details.html">Crew Normal Socks</a></li>
                        <li><a href="details.html">Crew Plated Socks</a></li>
                        <li><a href="details.html">Crew Full Terry Socks</a></li>
                        <li><a href="details.html">Crew Full Terry Fashion Socks</a></li>
                        <li><a href="listing.html">View All</a></li>
                    </ul>
                </div>
                <div class="menu__image">
                    <img src="img/range4.png">
                </div>
            </div>
            <div class="menu__block">
                <div class="menu__text">Innerwear</div>
                <div class="menu__links">
                    <ul>
                        <li><a href="details.html">Fine Vest</a></li>
                        <li><a href="details.html">Ribbed Vest</a></li>
                        <li><a href="details.html">Modern Vest</a></li>
                        <li><a href="details.html">Fine Vest RN</a></li>
                        <li><a href="details.html">Fine Vest RNS</a></li>
                        <li><a href="details.html">Sinker Brief</a></li>
                        <li><a href="details.html">Sinker Boxer</a></li>
                        <li><a href="details.html">Fashion Boxer</a></li>
                        <li><a href="details.html">Bikini Brief</a></li>
                        <li><a href="listing.html">View All</a></li>
                    </ul>
                </div>
                <div class="menu__image">
                    <img src="img/range3.png">
                </div>
            </div>
            <div class="menu__block">
                <div class="menu__text">Acttive</div>
                <div class="menu__links">
                    <ul>
                        <li><a href="details.html">Round Neck T-shirt</a></li>
                        <li><a href="details.html">V Neck T-shirt</a></li>
                        <li><a href="details.html">Full Sleeves R/N Neck T-shirt</a></li>
                        <li><a href="details.html">Polo T-shirt</a></li>
                        <li><a href="details.html">Polo T-shirt With Pocket</a></li>
                        <li><a href="details.html">Dual Tone T-shirt</a></li>
                        <li><a href="details.html">Printed T-shirt</a></li>
                        <li><a href="details.html">Smart Fit T-shirt</a></li>
                        <li><a href="details.html">Fashion T-shirt</a></li>
                        <li><a href="listing.html">View All</a></li>
                    </ul>
                </div>
                <div class="menu__image">
                    <img src="img/range5.png">
                </div>
            </div>
            <div class="menu__block">
                <div class="menu__text">Thermal</div>
                <div class="menu__links">
                    <ul>
                        <li><a href="details.html">Half Sleeve R/Neck</a></li>
                        <li><a href="details.html">Full Sleeve R/Neck</a></li>
                        <li><a href="details.html">Full Sleeve V/Neck</a></li>
                        <li><a href="details.html">Full Sleeve Crew Neck</a></li>
                        <li><a href="details.html">Trouser</a></li>
                        <li><a href="details.html">3/4th Sleeve U/Neck</a></li>
                        <li><a href="details.html">Sleeveless Slip</a></li>
                        <li><a href="listing.html">View All</a></li>
                    </ul>
                </div>
                <div class="menu__image">
                    <img src="img/range.png">
                </div>
            </div>
            <div class="menu__block">
                <div class="menu__text">Winter Wear</div>
                <div class="menu__links">
                    <ul>
                        <li><a href="details.html">Printed Sweatshirt</a></li>
                        <li><a href="details.html">Sweatshirt</a></li>
                        <li><a href="details.html">Printed Sweatshirt With Hood</a></li>
                        <li><a href="details.html">Fashion Sweatshirt</a></li>
                        <li><a href="details.html">Hoodie Jacket</a></li>
                        <li><a href="details.html">Hi-Neck Jacket</a></li>
                        <li><a href="details.html">Hi-Neck Half Zip Sweatshirt</a></li>
                        <li><a href="details.html">Winter Track Pant</a></li>
                        <li><a href="details.html">Winter Joggers</a></li>
                        <li><a href="listing.html">View All</a></li>
                    </ul>
                </div>
                <div class="menu__image">
                    <img src="img/range1.png">
                </div>
            </div>
            <div class="menu__block">
                <div class="menu__text">Relaxz</div>
                <div class="menu__links">
                    <ul>
                        <li><a href="details.html">Fine Vest</a></li>
                        <li><a href="details.html">Basic Brief</a></li>
                        <li><a href="details.html">Brief</a></li>
                        <li><a href="details.html">Mini Trunk</a></li>
                        <li><a href="details.html">Long Trunk</a></li>
                        <li><a href="details.html">Textile Boxer</a></li>
                        <li><a href="listing.html">View All</a></li>
                    </ul>
                </div>
                <div class="menu__image">
                    <img src="img/range6.png">
                </div>
            </div>
            <div class="menu__block">
                <div class="menu__text">Platina</div>
                <div class="menu__links">
                    <ul>
                        <li><a href="details.html">Fine Vest</a></li>
                        <li><a href="details.html">Fashion Brief</a></li>
                        <li><a href="details.html">Brief</a></li>
                        <li><a href="details.html">Mini Trunk</a></li>
                        <li><a href="details.html">Semi Long</a></li>
                        <li><a href="details.html">R/Neck T-shirt</a></li>
                        <li><a href="details.html">Polo T-shirt</a></li>
                        <li><a href="details.html">Half Pant</a></li>
                        <li><a href="details.html">Track Pant</a></li>
                        <li><a href="listing.html">View All</a></li>
                    </ul>
                </div>
                <div class="menu__image">
                    <img src="img/range2.png">
                </div>
            </div>
        </div>
    </div>

    <main>@yield('content')</main>

    <footer class="footer">
        <div class="footer-main">
            <div class="container">
                <div class="footer-main-top">
                    <div class="row align-items-center align-items-sm-end">
                        <div class="col-auto">
                            <img src="{{ asset('img/footer-logo.png') }}" />
                        </div>
                        <div class="col">
                            <div class="footer-block">
                                <ul class="social">
                                    <li><a href="https://facebook.com/"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                    <li><a href="https://twitter.com/"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="https://instagram.com/"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href="https://twitter.com/"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 col-lg-5 mb-3 mb-md-0">
                        <div class="newsletter-form">
                            <form method="POST" action="{{route('front.subscription')}}">@csrf
                                <div class="footer-form">
                                    <input type="email" name="email" value="{{old('email')}}" placeholder="Enter your email address">
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                    </button>
                                </div>
                                @error('email') <p class="mb-0 text-white small">{{$message}}</p>@enderror
                                @if(Session::get('mailSuccess')) <p class="mb-0 text-white small">{{Session::get('mailSuccess')}}</p>@endif
                            </form>
    
                            <div class="footer-block mt-3 mt-md-auto">
                                <img src="{{ asset('img/payment-options.png') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-6 offset-lg-1">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="footer-block">
                                    <div class="footer-heading">Quick Links</div>
                                    <ul class="footer-block-menu">
                                        <li><a href="listing.html">Innerwears</a></li>
                                        <li><a href="listing.html">Outerwears</a></li>
                                        <li><a href="listing.html">Platina</a></li>
                                        <li><a href="listing.html">Relaxz</a></li>
                                        <li><a href="listing.html">Footkins</a></li>
                                        <li><a href="listing.html">Thermal</a></li>
                                        <li><a href="listing.html">Winter</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="footer-block">
                                    <div class="footer-heading">Customer Services</div>
                                    <ul class="footer-block-menu">
                                        <li><a href="#">FAQ</a></li>
                                        <li><a href="#">My Shopping</a></li>
                                        <li><a href="#">Shipping & Delivery</a></li>
                                        <li><a href="#">Payment, Voucher & Promotions</a></li>
                                        <li><a href="#">Returns & Refunds</a></li>
                                        <li><a href="#">Service & Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="footer-bottom-menu">
                            <a href="#">Terms & Conditions</a>
                            <a href="#">Privacy Statement</a>
                            <a href="#">Security</a>
                            <a href="#">Disclaimer</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="copy-right mb-0">
                            Total Comfort ©2021-2022
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>

    <script src="{{ asset('node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.js') }}"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('node_modules/gsap/dist/gsap.min.js') }}"></script>
    <script src="{{ asset('node_modules/gsap/dist/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('node_modules/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('node_modules/counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('node_modules/lightbox2/dist/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('node_modules/select2/dist/js/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.0/TweenMax.min.js"></script>
    <script src="{{ asset('node_modules/scrollmagic/scrollmagic/minified/ScrollMagic.min.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/plugins/animation.gsap.min.js'></script>
    <script src="{{ asset('node_modules/scrollmagic/scrollmagic/minified/plugins/debug.addIndicators.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>


</html>