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
                <a href="{{ route('front.category.detail', $categories[0]->slug) }}" class="offer-button">Shop Now</a>
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