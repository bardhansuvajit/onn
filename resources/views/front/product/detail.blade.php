@extends('layouts.app')

@section('page', 'Product detail')

@section('content')
<style>
.product-details__content__holder .product__enquire form button {
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    vertical-align: top;
    width: 200px;
    height: 60px;
    background: #141b4b;
    color: #fff;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 500;
    border: transparent;
}
.product-details__content__holder .product__enquire form button:hover {
    box-shadow: inset 264px 0px 0px 0px #c10909;
    border-color: #c10909;
    color: #fff;
}
.product-details__content__holder .product__color li {
    width: 30px;
    height: 30px;
    padding: 2px 8px;
}
.product-details__content__holder .product__color li.active {
    border-width: 2px;
    border-color: #000000;
    color: #fff;
}
/* .product-details__content__holder .product__color li .color__holder {
    width: auto;
    height: 30px;
    padding: 2px 8px;
} */
</style>

<section id="specifications" class="product-details">
    <div class="product-details__gallery">
        <div class="product-details__gallery__holder">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('front.category.detail', $data->category->slug) }}">{{$data->category->name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$data->name}}</li>
                </ol>
            </nav>
            <div class="w-100">
                <div class="product-details__gallery__thumb swiper-container">
                    <div class="slider swiper-wrapper">
                        <div class="product-details__gallery__thumb-single swiper-slide">
                            <img src="{{ asset($data->image) }}" />
                        </div>
                        @foreach($images as $index => $singleImage)
                            <div class="product-details__gallery__thumb-single swiper-slide">
                                <img src="{{ asset($singleImage->image) }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="product-details__gallery__slider swiper-container">
                    <div class="slider swiper-wrapper">
                        <div class="product-details__gallery__slider-single swiper-slide">
                            <img src="{{ asset($data->image) }}" />
                        </div>
                        @foreach($images as $index => $singleImage)
                            <div class="product-details__gallery__slider-single swiper-slide">
                                <img src="{{ asset($singleImage->image) }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-details__content">
        <div class="product-details__content__holder">
            @if (Session::get('success'))
                <div class="alert alert-success"> {{Session::get('success')}} </div>
            @endif
            @if (Session::get('failure'))
                <div class="alert alert-danger"> {{Session::get('failure')}} </div>
            @endif

            <span class="n_code"># {{$data->style_no}}</span>
            {{-- <img src="{{ asset('img/logo_outerwear.png') }}" class="brand__logo"> --}}
            <h2>{{$data->name}}</h2>
            <p>{!! $data->short_desc !!}</p>

            {{-- {{dd($data->colorSize)}} --}}

            @if (count($data->colorSize) > 0)
                @php
                $uniqueColors = [];

                // custom function multi-dimensional in_array
                /* function in_array_r($needle, $haystack, $strict = false) {
                    foreach ($haystack as $item) {
                        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) return true;
                    }
                    return false;
                } */

                foreach ($data->colorSize as $variantKey => $variantValue) {
                    if (in_array_r($variantValue->colorDetails->code, $uniqueColors)) continue;

                    $uniqueColors[] = [
                        'id' => $variantValue->colorDetails->id,
                        'code' => $variantValue->colorDetails->code,
                        'name' => $variantValue->colorDetails->name,
                    ];
                }

                echo '<h6>Available Colour</h6><ul class="product__color">';
                foreach($uniqueColors as $colorCode) {
                    echo '<li onclick="sizeCheck('.$data->id.', '.$colorCode['id'].')" style="background-color: '.$colorCode['code'].'"></li>';
                }
                echo '</ul>';
                @endphp

                <h6 id="sizeHead" style="display:none;">Available Size</h6>
                <p id="colorSelectAlert">Please select a colour first</p>
                <ul class="product__sizes" id="sizeContainer"></ul>
            @endif

            {{-- <h6>Available Colour</h6>
            <ul class="product__color">
                <li class="active"><img src="img/details-color.png"></li>
                <li><img src="img/details-color1.png"></li>
                <li><img src="img/details-color2.png"></li>
                <li><img src="img/details-color3.png"></li>
                <li><img src="img/details-color4.png"></li>
                <li><img src="img/details-color5.png"></li>
            </ul> --}}

            {{-- <h6>Available Packs</h6>
            <ul class="product__packs">
                <li class="active">Packs of 2</li>
                <li>Packs of 3</li>
            </ul> --}}

            @php
            $offer_price = (float) $data->offer_price;
            @endphp

            <div class="product__pricing">
                <img src="{{ asset('img/wallet.png') }}"> <h3>&#8377; <span class="price_val">{{$offer_price}}</span></h3>
            </div>

            <div class="product__enquire">
                <form method="POST" action="{{route('front.cart.add')}}" class="d-flex">@csrf
                    <div class="cart-item item-qty">
                        <div class="cart-text">Quantity</div>
                        <div class="qty-box">
                            <a href="javascript: void(0)" class="decrement" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </a>
                            <input class="counter" type="number" value="1" name="qty">
                            <a href="javascript: void(0)" class="increment" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </a>
                        </div>
                    </div>
                    <input type="hidden" name="product_id" value="{{$data->id}}">
                    <input type="hidden" name="product_name" value="{{$data->name}}">
                    <input type="hidden" name="product_style_no" value="{{$data->style_no}}">
                    <input type="hidden" name="product_image" value="{{asset($data->image)}}">
                    <input type="hidden" name="product_slug" value="{{$data->slug}}">
                    <input type="hidden" name="product_variation_id" value="">
                    <input type="hidden" name="price" value="{{$data->price}}">
                    <input type="hidden" name="offer_price" value="{{$data->offer_price}}">
                    {{-- <input type="hidden" name="qty" value="1"> --}}
                    <button type="submit" id="addToCart__btn" class="@if(count($data->colorSize) > 0) missingVariationSelection @endif">Add to Cart</button>
                </form>
            </div>

            <h6>Details & Specifications</h6>
            <div class="specification">
                {!! substr($data->desc, 0, 100) !!}
                <h6><a href="javascript: void(0)" data-bs-target="#productDescModal" data-bs-toggle="modal">Read more</a></h6>
            </div>
        </div>
    </div>
</section>

<section id="related" class="related-product">
    <div class="container">
        <h3>Related Product</h3>
        <div class="row">
            @forelse($relatedProducts as $relatedProductKey => $relatedProductValue)
            <a href="{{ route('front.product.detail', $relatedProductValue->slug) }}" class="home-gallary__single" data-events data-cat="tshirt">
                <figure>
                    <img src="{{asset($relatedProductValue->image)}}" />
                    <h6>{{$relatedProductValue->style_no}}</h6>
                </figure>
                <figcaption>
                    <h4>{{$relatedProductValue->name}}</h4>
                    <h5>&#8377;{{$relatedProductValue->offer_price}} - &#8377;{{$relatedProductValue->price}}</h5>
                </figcaption>
            </a>
            @empty
            <p class="ml-2">Sorry, No related products found </p>
            @endforelse

            {{-- <a href="details.html" class="home-gallary__single" data-events data-cat="tshirt">
                <figure>
                    <img src="img/round_neck_tshirt.png" />
                </figure>
                <figcaption>
                    <h4>Round Neck T-shirt</h4>
                    <h6>Style # OF NC422</h6>
                </figcaption>
            </a> --}}

        </div>
    </div>
</section>

<div class="modal fade" id="productDescModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6>DETAILS & SPECIFICATIONS</h6>
            </div>
            <div class="modal-body">
            {!! $data->desc !!}
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // $('.product__color li').eq(0).addClass('active');

    function sizeCheck(productId, colorId) {
        $.ajax({
            url : '{{route("front.product.size")}}',
            method : 'POST',
            data : {'_token' : '{{csrf_token()}}', productId : productId, colorId : colorId},
            success : function(result) {
                if (result.error === false) {
                    $('#sizeHead').show();
                    $('#colorSelectAlert').hide();
                    // $('#addToCart__btn').removeClass('missingVariationSelection');
                    let content = '';
                    $.each(result.data, (key, val) => {
                        // content += `<input type="radio" class="btn-check" name="productSize" id="productSize${val.sizeId}" autocomplete="off"><label class="btn btn-outline-primary px-4" for="productSize${val.sizeId}">${val.sizeName}</label>`;

                        content += `<li data-price="{{$data->offer_price}}" data-id="${val.variationId}">${val.sizeName}</li>`;
                    })

                    $('#sizeContainer').html(content);
                }
            },
            error: function(xhr, status, error) {
                // toastFire('danger', 'Something Went wrong');
            }
        });
    }

    // variation selection check
    $('#addToCart__btn').on('click', function(e) {
        if ($(this).hasClass('missingVariationSelection')) {
            e.preventDefault();
            alert('Select color & size first');
        }
    }); 

    // get variation id & load into product_variation_id
    $(document).on('click', '#sizeContainer li', function(){
        $('#addToCart__btn').removeClass('missingVariationSelection');
        var variationId = $(this).attr('data-id');
        $('input[name="product_variation_id"]').val(variationId);
        // console.log(variationId);
    });
</script>
@endsection