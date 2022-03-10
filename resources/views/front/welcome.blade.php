@extends('layouts.app')

@section('page', 'Home')

@section('content')
<section id="home" class="home-banner p-0">
    <div class="home-banner__slider swiper-container">
        <div class="slider swiper-wrapper">
            <div class="home-banner__slider-single swiper-slide">
                <div class="video__wrapper">
                    <img src="img/banner3.jpg" />
                </div>
            </div>
            <div class="home-banner__slider-single swiper-slide">
                <div class="video__wrapper">
                    <video id="onn-video" width="320" height="240" muted loop>
                        <source src="video/videoplayback2.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <div class="home-banner__slider-single swiper-slide">
                <div class="video__wrapper">
                    <img src="img/banner2.jpg" />
                </div>
            </div>
            <div class="home-banner__slider-single swiper-slide">
                <div class="video__wrapper">
                    <img src="img/banner1.jpg" />
                </div>
            </div>
        </div>
    </div>
</section>

<section id="sale" class="home-offers">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-sm-4 mb-3 mb-sm-0">
                <h4>Offer 2022</h4>
                <h2>Sale upto <br/><span>30% off</span></h2>
                <p>Offer valid upto 15th may</p>
            </div>
            <div class="col-sm-5 offset-sm-1 text-sm-right">
                <a href="#" class="offer-button">Shop Now</a>
            </div>
        </div>
    </div>
</section>

<section id="category" class="home-category">
    <div class="home-category__text">Total Comfort</div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 mb-0 mb-md-5">
                <h2><span>Featured <strong>Categories</strong></span></h2>
            </div>
            @foreach ($category as $categoryKey => $categoryValue)
            <div class="col-4 col-sm-3 col-lg-2">
                <a href="{{ route('front.category.detail', $categoryValue->slug) }}" class="home-category-single">
                    <figure>
                        <img src="{{asset($categoryValue->icon_path)}}">
                    </figure>
                    <figcaption>
                        {{$categoryValue->name}}
                    </figcaption>
                </a>
            </div>
            @endforeach
            {{-- <div class="col-4 col-sm-3 col-lg-2">
                <a href="listing.html" class="home-category-single">
                    <figure>
                        <img src="img/catago_2.png">
                    </figure>
                    <figcaption>
                        Boxer
                    </figcaption>
                </a>
            </div>
            <div class="col-4 col-sm-3 col-lg-2">
                <a href="listing.html" class="home-category-single">
                    <figure>
                        <img src="img/catago_3.png">
                    </figure>
                    <figcaption>
                        Vest
                    </figcaption>
                </a>
            </div>
            <div class="col-4 col-sm-3 col-lg-2">
                <a href="listing.html" class="home-category-single">
                    <figure>
                        <img src="img/catago_4.png">
                    </figure>
                    <figcaption>
                        Brief
                    </figcaption>
                </a>
            </div>
            <div class="col-4 col-sm-3 col-lg-2">
                <a href="listing.html" class="home-category-single">
                    <figure>
                        <img src="img/catago_5.png">
                    </figure>
                    <figcaption>
                        T-Shirt
                    </figcaption>
                </a>
            </div>
            <div class="col-4 col-sm-3 col-lg-2">
                <a href="listing.html" class="home-category-single">
                    <figure>
                        <img src="img/catago_7.png">
                    </figure>
                    <figcaption>
                        Track Pants
                    </figcaption>
                </a>
            </div>
            <div class="col-4 col-sm-3 col-lg-2">
                <a href="listing.html" class="home-category-single">
                    <figure>
                        <img src="img/catago_9.png">
                    </figure>
                    <figcaption>
                        Trunk
                    </figcaption>
                </a>
            </div>
            <div class="col-4 col-sm-3 col-lg-2">
                <a href="listing.html" class="home-category-single">
                    <figure>
                        <img src="img/catago_12.png">
                    </figure>
                    <figcaption>
                        Joggers
                    </figcaption>
                </a>
            </div>
            <div class="col-4 col-sm-3 col-lg-2">
                <a href="listing.html" class="home-category-single">
                    <figure>
                        <img src="img/catago_13.png">
                    </figure>
                    <figcaption>
                        Half Pants
                    </figcaption>
                </a>
            </div>
            <div class="col-4 col-sm-3 col-lg-2">
                <a href="listing.html" class="home-category-single">
                    <figure>
                        <img src="img/catago_8.png">
                    </figure>
                    <figcaption>
                        Socks
                    </figcaption>
                </a>
            </div>
            <div class="col-4 col-sm-3 col-lg-2">
                <a href="listing.html" class="home-category-single">
                    <figure>
                        <img src="img/catago_6.png">
                    </figure>
                    <figcaption>
                        Thermal
                    </figcaption>
                </a>
            </div>
            <div class="col-4 col-sm-3 col-lg-2">
                <a href="listing.html" class="home-category-single">
                    <figure>
                        <img src="img/catago_10.png">
                    </figure>
                    <figcaption>
                        Jackets
                    </figcaption>
                </a>
            </div>
            <div class="col-4 col-sm-3 col-lg-2">
                <a href="listing.html" class="home-category-single">
                    <figure>
                        <img src="img/catago_11.png">
                    </figure>
                    <figcaption>
                        Sweatshirt
                    </figcaption>
                </a>
            </div> --}}
        </div>
    </div>
</section>

<section id="collection" class="home-collection pb-0">
    <div class="home-collection__before"></div>
    <div class="container pr-0">
        <div class="home-collection__text">Collections</div>

        <div class="row align-items-end">
            <div class="col-sm-4 col-md-5 d-none d-md-block">
                <div class="home-collection__thumb swiper-container">
                    <div class="slider swiper-wrapper">
                        @foreach($collections as $collectionKey => $collectionValue)
                            <div class="home-collection__thumb-single swiper-slide">
                                <img src="{{asset($collectionValue->image_path)}}"  class="img-fluid">
                            </div>
                        @endforeach
                        {{-- <div class="home-collection__thumb-single swiper-slide">
                            <img src="img/range2.png"  class="img-fluid">
                        </div>
                        <div class="home-collection__thumb-single swiper-slide">
                            <img src="img/range3.png"  class="img-fluid">
                        </div>
                        <div class="home-collection__thumb-single swiper-slide">
                            <img src="img/range3.png"  class="img-fluid">
                        </div>
                        <div class="home-collection__thumb-single swiper-slide">
                            <img src="img/range3.png"  class="img-fluid">
                        </div>
                        <div class="home-collection__thumb-single swiper-slide">
                            <img src="img/range3.png"  class="img-fluid">
                        </div>
                        <div class="home-collection__thumb-single swiper-slide">
                            <img src="img/range5.png"  class="img-fluid">
                        </div>
                        <div class="home-collection__thumb-single swiper-slide">
                            <img src="img/range6.png"  class="img-fluid">
                        </div>
                        <div class="home-collection__thumb-single swiper-slide">
                            <img src="img/range4.png"  class="img-fluid">
                        </div>
                        <div class="home-collection__thumb-single swiper-slide">
                            <img src="img/range.png"  class="img-fluid">
                        </div>
                        <div class="home-collection__thumb-single swiper-slide">
                            <img src="img/range1.png"  class="img-fluid">
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="home-collection__thumbs swiper-container">
                    <div class="slider swiper-wrapper">
                        @foreach($collections as $collectionKey => $collectionValue)
                            <div class="home-collection__thumbs-single swiper-slide">
                                <h2>{{$collectionValue->name}}<br><strong>Collection</strong></h2>
                            </div>
                        @endforeach
                        {{-- <div class="home-collection__thumbs-single swiper-slide">
                            <h2>Platina<br><strong>Collection</strong></h2>
                        </div>
                        <div class="home-collection__thumbs-single swiper-slide">
                            <h2>Grandde<br><strong>Collection</strong></h2>
                        </div>
                        <div class="home-collection__thumbs-single swiper-slide">
                            <h2>Stretchz<br><strong>Collection</strong></h2>
                        </div>
                        <div class="home-collection__thumbs-single swiper-slide">
                            <h2>Sport<br><strong>Collection</strong></h2>
                        </div>
                        <div class="home-collection__thumbs-single swiper-slide">
                            <h2>Comfortz<br><strong>Collection</strong></h2>
                        </div>
                        <div class="home-collection__thumbs-single swiper-slide">
                            <h2>Acttive<br><strong>Collection</strong></h2>
                        </div>
                        <div class="home-collection__thumbs-single swiper-slide">
                            <h2>Relaxz<br><strong>Collection</strong></h2>
                        </div>
                        <div class="home-collection__thumbs-single swiper-slide">
                            <h2>Footkins<br><strong>Collection</strong></h2>
                        </div>
                        <div class="home-collection__thumbs-single swiper-slide">
                            <h2>Thermal<br><strong>Collection</strong></h2>
                        </div>
                        <div class="home-collection__thumbs-single swiper-slide">
                            <h2>Winter<br><strong>Collection</strong></h2>
                        </div> --}}
                    </div>
                </div>
                <div class="home-collection__slider swiper-container">
                    <div class="slider swiper-wrapper">
                        @foreach($collections as $collectionKey => $collectionValue)
                            <div class="home-collection__single swiper-slide">
                                <figure>
                                    <img src="{{asset($collectionValue->image_path)}}" />
                                    <figcaption>
                                        <h3>{{$collectionValue->name}}<br><strong>Collection</strong></h3>
                                        <p><a href="{{ route('front.collection.detail', $collectionValue->slug) }}">View All Products</a></p>
                                    </figcaption>
                                </figure>
                            </div>
                        @endforeach
                        {{-- <div class="home-collection__single swiper-slide">
                            <figure>
                                <img src="img/onn_platina.png" />
                                <figcaption>
                                    <h3>Platina<br><strong>Collection</strong></h3>
                                    <p><a href="listing.html">View All Products</a></p>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="home-collection__single swiper-slide">
                            <figure>
                                <img src="img/onn_innerwear.png" />
                                <figcaption>
                                    <h3>Grandde<br><strong>Collection</strong></h3>
                                    <p><a href="listing.html">View All Products</a></p>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="home-collection__single swiper-slide">
                            <figure>
                                <img src="img/stretchz.png" />
                                <figcaption>
                                    <h3>Stretchz<br><strong>Collection</strong></h3>
                                    <p><a href="listing.html">View All Products</a></p>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="home-collection__single swiper-slide">
                            <figure>
                                <img src="img/onn_innerwear.png" />
                                <figcaption>
                                    <h3>Sport<br><strong>Collection</strong></h3>
                                    <p><a href="listing.html">View All Products</a></p>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="home-collection__single swiper-slide">
                            <figure>
                                <img src="img/comfortz.png" />
                                <figcaption>
                                    <h3>Comfortz<br><strong>Collection</strong></h3>
                                    <p><a href="listing.html">View All Products</a></p>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="home-collection__single swiper-slide">
                            <figure>
                                <img src="img/onn_outerwear.png" />
                                <figcaption>
                                    <h3>Acttive<br><strong>Collection</strong></h3>
                                    <p><a href="listing.html">View All Products</a></p>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="home-collection__single swiper-slide">
                            <figure>
                                <img src="img/onn_relaxz.png" />
                                <figcaption>
                                    <h3>Relaxz<br><strong>Collection</strong></h3>
                                    <p><a href="listing.html">View All Products</a></p>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="home-collection__single swiper-slide">
                            <figure>
                                <img src="img/onn_footkins.png" />
                                <figcaption>
                                    <h3>Footkins<br><strong>Collection</strong></h3>
                                    <p><a href="listing.html">View All Products</a></p>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="home-collection__single swiper-slide">
                            <figure>
                                <img src="img/onn_thermal.png" />
                                <figcaption>
                                    <h3>Thermal<br><strong>Collection</strong></h3>
                                    <p><a href="listing.html">View All Products</a></p>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="home-collection__single swiper-slide">
                            <figure>
                                <img src="img/highlight1.png" />
                                <figcaption>
                                    <h3>Winter<br><strong>Collection</strong></h3>
                                    <p><a href="listing.html">View All Products</a></p>
                                </figcaption>
                            </figure>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="tranding" class="home-product">
    <div class="container pr-0">
        <div class="home-product__text">Products</div>

        <div class="home-product__holder">
            <div class="home-product__holder__left">
                <h2 class="home-product__holder__title">Trending <strong>Products</strong></h2>
            </div>
            <div class="home-product__holder__right">
                <div class="home-product__slider swiper-container">
                    <div class="slider swiper-wrapper">
                        @foreach ($products as $productKey => $productValue)
                            <a href="{{ route('front.product.detail', $productValue->slug) }}" class="home-product__single swiper-slide">
                                <figure>
                                    <img src="{{asset($productValue->image)}}" />
                                </figure>
                                <figcaption>
                                    <h4>{{$productValue->name}}</h4>
                                    <h6>Style # OF {{$productValue->style_no}}</h6>
                                </figcaption>
                            </a>
                        @endforeach

                        {{-- @for ($i = 0; $i < 7; $i++)
                            <a href="details.html" class="home-product__single swiper-slide">
                                <figure>
                                    <img src="img/platina4.png" />
                                </figure>
                                <figcaption>
                                    <h4>DUAL TONE T-SHIRT</h4>
                                    <h6>Style # OF NC425</h6>
                                </figcaption>
                            </a>
                        @endfor --}}

                        <a href="details.html" class="home-product__single swiper-slide">
                            <figure>
                                <img src="img/dual_tone_tshirt.png" />
                            </figure>
                            <figcaption>
                                <h4>DUAL TONE T-SHIRT</h4>
                                <h6>Style # OF NC425</h6>
                            </figcaption>
                        </a>
                        <a href="details.html" class="home-product__single swiper-slide">
                            <figure>
                                <img src="img/product.png" />
                            </figure>
                            <figcaption>
                                <h4>DUAL TONE T-SHIRT</h4>
                                <h6>Style # OF NC425</h6>
                            </figcaption>
                        </a>
                        <a href="details.html" class="home-product__single swiper-slide">
                            <figure>
                                <img src="img/platina8.png" />
                            </figure>
                            <figcaption>
                                <h4>DUAL TONE T-SHIRT</h4>
                                <h6>Style # OF NC425</h6>
                            </figcaption>
                        </a>
                        <a href="details.html" class="home-product__single swiper-slide">
                            <figure>
                                <img src="img/polo_pocket_tshirt.png" />
                            </figure>
                            <figcaption>
                                <h4>DUAL TONE T-SHIRT</h4>
                                <h6>Style # OF NC425</h6>
                            </figcaption>
                        </a>
                        {{-- <a href="details.html" class="home-product__single swiper-slide">
                            <figure>
                                <img src="img/socks4.png" />
                            </figure>
                            <figcaption>
                                <h4>DUAL TONE T-SHIRT</h4>
                                <h6>Style # OF NC425</h6>
                            </figcaption>
                        </a>
                        <a href="details.html" class="home-product__single swiper-slide">
                            <figure>
                                <img src="img/round_neck_tshirt.png" />
                            </figure>
                            <figcaption>
                                <h4>DUAL TONE T-SHIRT</h4>
                                <h6>Style # OF NC425</h6>
                            </figcaption>
                        </a>
                        <a href="details.html" class="home-product__single swiper-slide">
                            <figure>
                                <img src="img/socks8.png" />
                            </figure>
                            <figcaption>
                                <h4>DUAL TONE T-SHIRT</h4>
                                <h6>Style # OF NC425</h6>
                            </figcaption>
                        </a>
                        <a href="details.html" class="home-product__single swiper-slide">
                            <figure>
                                <img src="img/socks8.png" />
                            </figure>
                            <figcaption>
                                <h4>DUAL TONE T-SHIRT</h4>
                                <h6>Style # OF NC425</h6>
                            </figcaption>
                        </a>
                        <a href="details.html" class="home-product__single swiper-slide">
                            <figure>
                                <img src="img/platina4.png" />
                            </figure>
                            <figcaption>
                                <h4>DUAL TONE T-SHIRT</h4>
                                <h6>Style # OF NC425</h6>
                            </figcaption>
                        </a>
                        <a href="details.html" class="home-product__single swiper-slide">
                            <figure>
                                <img src="img/socks10.png" />
                            </figure>
                            <figcaption>
                                <h4>DUAL TONE T-SHIRT</h4>
                                <h6>Style # OF NC425</h6>
                            </figcaption>
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-sale">
    <div class="home-sale__slider swiper-container">
        <div class="slider swiper-wrapper">
            <div class="home-sale__single swiper-slide">
                <figure>
                    <img src="img/gallery.jpg" />
                </figure>
            </div>
            <div class="home-sale__single swiper-slide">
                <figure>
                    <img src="img/gallery2.jpg" />
                </figure>
            </div>
            <div class="home-sale__single swiper-slide">
                <figure>
                    <img src="img/gallery3.webp" />
                </figure>
            </div>
            <div class="home-sale__single swiper-slide">
                <figure>
                    <img src="img/gallery4.jpg" />
                </figure>
            </div>
            <div class="home-sale__single swiper-slide">
                <figure>
                    <img src="img/gallery5.png" />
                </figure>
            </div>
            <div class="home-sale__single swiper-slide">
                <figure>
                    <img src="img/gallery6.jpg" />
                </figure>
            </div>
        </div>
    </div>
</section>
@endsection