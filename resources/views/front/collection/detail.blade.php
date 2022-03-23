@extends('layouts.app')

@section('page', 'Collection')

@section('content')
<section class="listing-header">
    <div class="container">
        <div class="row flex-sm-row-reverse align-items-center">
            <div class="col-sm-6 d-none d-sm-block">
                <img src="{{ asset($data->banner_image) }}" class="img-fluid">
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$data->name}}</li>
                    </ol>
                </nav>
                <h1>{{ $data->name }}</h1>
            </div>
        </div>
    </div>
</section>

<section class="listing-block">
    <div class="container">
        @if (count($data->ProductDetails) > 0)
        <div class="listing-block__meta">
            <div class="filter">
                <div class="filter__toggle">
                    Filter
                </div>
                <div class="filter__data"></div>
            </div>
            <div class="sorting">
                Sort By:
                <select>
                    <option>New Arrivals</option>
                    <option>Best Sellers</option>
                    <option>Price: Low To High</option>
                    <option>Price: High To Low</option>
                </select>
            </div>
        </div>

        <div class="product__wrapper">
            <div class="product__filter">
                <div class="product__filter__bar">
                    <div class="filter__close">
                        <i class="fal fa-times"></i>
                    </div>
                    <div class="row">
                        <form method="GET" action="{{route('front.collection.detail', $data->slug)}}">
                            <div class="col-12 col-sm-12 mb-3 mb-sm-0">
                                <h4>Categories</h4>
                                <ul class="product__filter__bar-list">
                                    @foreach($categories as $categoryKey => $categoryValue)
                                        <li><label><input type="checkbox" name="category[]" value="{{$categoryValue->slug}}" pro-filter="{{$categoryValue->name}}" {{( request()->query('category') == $categoryValue->slug ) ? 'checked' : ''}}><i></i> {{$categoryValue->name}}</label></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 mb-3 mb-sm-0">
                                <h4>Range</h4>
                                <ul class="product__filter__bar-list">
                                    @foreach($collections as $collectionKey => $collectionValue)
                                        <li><label><input type="checkbox" name="collection" value="{{$collectionValue->slug}}" pro-filter="{{$collectionValue->name}}"><i></i> {{$collectionValue->name}}</label></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-6 col-sm-12 mb-3 mb-sm-0">
                                <h4>Sizes</h4>
                                <ul class="product__filter__bar-list">
                                    @foreach($sizes as $sizeKey => $sizeValue)
                                        <li><label><input type="checkbox" pro-filter="{{$sizeValue->name}}"><i></i> {{$sizeValue->name}}</label></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-6 col-sm-12 mb-3 mb-sm-0">
                                <h4>Price</h4>
                                <ul class="product__filter__bar-list">
                                    <li><label><input type="checkbox" pro-filter="&#8377;339 - &#8377;425"><i></i> &#8377;339 - &#8377;425</label></li>
                                    <li><label><input type="checkbox" pro-filter="&#8377;410 - &#8377;450"><i></i> &#8377;410 - &#8377;450</label></li>
                                    <li><label><input type="checkbox" pro-filter="&#8377;499 - &#8377;525"><i></i> &#8377;499 - &#8377;525</label></li>
                                    <li><label><input type="checkbox" pro-filter="&#8377;575 - &#8377;599"><i></i> &#8377;575 - &#8377;599</label></li>
                                    <li><label><input type="checkbox" pro-filter="&#8377;599 - &#8377;625"><i></i> &#8377;599 - &#8377;625</label></li>
                                    <li><label><input type="checkbox" pro-filter="&#8377;590 - &#8377;615"><i></i> &#8377;590 - &#8377;615</label></li>
                                    <li><label><input type="checkbox" pro-filter="&#8377;450 - &#8377;475"><i></i> &#8377;450 - &#8377;475</label></li>
                                    <li><label><input type="checkbox" pro-filter="&#8377;430 - &#8377;450"><i></i> &#8377;430 - &#8377;450</label></li>
                                </ul>
                            </div>
                            <div class="col-12">
                                <h4>Color</h4>
                                <ul class="product__filter__bar-list column-2">
                                    @foreach($colors as $colorKey => $colorValue)
                                        <li><label><input type="checkbox" pro-filter="{{$colorValue->name}}"><i></i> {{ucwords($colorValue->name)}}</label></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-sm btn-danger">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="product__holder">
                <div class="row">
                    @forelse($data->ProductDetails as $collectionProductKey => $collectionProductValue)
                    <a href="{{ route('front.product.detail', $collectionProductValue->slug) }}" class="product__single" data-events data-cat="tshirt">
                        <figure>
                            <img src="{{asset($collectionProductValue->image)}}" />
                            <h6>{{$collectionProductValue->style_no}}</h6>
                        </figure>
                        <figcaption>
                            <h4>{{$collectionProductValue->name}}</h4>
                            <h5>
                            &#8377;{{$collectionProductValue->offer_price}} 
                            {{-- - &#8377;{{$collectionProductValue->price}} --}}
                            </h5>
                        </figcaption>
                    </a>
                    @empty
                    
                    @endforelse
                </div>
            </div>
            @else
            <p class="mt-5">Sorry, No products found under {{$data->name}} </p>
        </div>
        @endif
    </div>
</section> 
@endsection