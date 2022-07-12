@extends('layouts.app')

@section('page', 'Category')

@section('content')
<style>
select {
    border: none;
    background: transparent;
}
select:focus {
    outline: none;
    box-shadow: none;
}
.color_holder {
    height: 20px;
    width: 20px;
    border-radius: 50%
}
.product__color {
	display: flex;
    flex-wrap: wrap;
	padding: 0 20px 20px;
    align-items: center;
}
.color-holder {
	width: 20px;
    height: 20px;
    border-radius: 50%;
    flex: 0 0 20px;
	margin-right: 7px;
	box-shadow: 0px 5px 10px rgb(0 0 0 / 10%);
}
/*.customCats.active {
    display: block;
    border: 2px solid #c1080a;
}*/
.listing-block .product__single figure h6 {
    display: block;
	background: #fff;
}
@media(max-width: 575px) {
    .color-holder {
        width: 15px;
        height: 15px;
        flex: 0 0 15px;
    }
    .product__color {
        justify-content: center;
    }
}
</style>

<!-- <section class="listing-header">
    <div class="container">
        <div class="row flex-sm-row-reverse align-items-center">
            <div class="col-sm-3 d-none d-sm-block">
                <img src="{{ asset($data->banner_image) }}" class="img-fluid">
            </div>
            <div class="col-sm-9">
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
</section> -->

<section class="listing-header">
    <div class="container">
        <div class="row align-items-center">
            <!-- <div class="col-sm-3 d-none d-sm-block">
                <img src="{{ asset($data->banner_image) }}" class="img-fluid">
            </div> -->
            <div class="col-sm-6">
                <h1>{{ $data->name }}</h1>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$data->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="filter_by_cat">
    <div class="container">
        <h3>{{ $data->parentCatDetails->name }}</h3>

        <ul class="filter_cat_list">
            @php
                /* if(count($data->ProductDetails) > 0) {
                    $customCats = [];
                    foreach ($data->ProductDetails as $ProductDetailsKey => $ProductDetailsValue) {
                        if($ProductDetailsValue->status == 1) {
                            if(in_array_r($ProductDetailsValue->cat_id, $customCats)) continue;

                            $customCats[] = [
                                'id' => $ProductDetailsValue->cat_id,
                                'name' => $ProductDetailsValue->category->name,
                                'icon' => $ProductDetailsValue->category->icon_path
                            ];
                        }
                    }
                } */
            @endphp
            @foreach ($categories as $categoryKey => $categoryValue)
                @if($categoryValue->parent == $data->parent)
                    <li class="position-relative">
                        <a href="{{ route('front.category.detail', $categoryValue->slug) }}" class="customCats {{ ($categoryValue->id == $data->id) ? 'active' : '' }}" id="customCat_{{$categoryValue['id']}}" data-id="{{$categoryValue['id']}}">
                            <figure>
                                <img src="{{ asset($categoryValue['icon_path']) }}">
                            </figure>
                            <figcaption>
                                {{ $categoryValue['name'] }}
                            </figcaption>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</section>

<section class="listing-block">
    <div class="container">
        @if (count($data->ProductDetails) > 0)
        <div class="listing-block__meta">
            {{-- <div class="filter">
                <div class="filter__toggle">
                    Filter
                </div>
                <div class="filter__data"></div>
            </div> --}}
            <div class="products mr-3">
                {{--<h6><span id="prod_count">{{ $data->ProductDetails->count() }}</span> <span id="prod_text">{{ ($data->ProductDetails->count() > 1) ? 'products' : 'product' }}</span> found</h6>--}}
            </div>
            <div class="sorting">
                Sort By:
                <select name="orderBy" onclick="productsFetch()">
                    <option value="new_arr">New Arrivals</option>
                    <option value="mst_viw">Most Viewed</option>
                    <option value="prc_low">Price: Low To High</option>
                    <option value="prc_hig">Price: High To Low</option>
                </select>
            </div>
        </div>

        <div class="product__wrapper">
            <div class="product__filter d-none">
                <div class="product__filter__bar">
                    <div class="filter__close">
                        <i class="fal fa-times"></i>
                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-12 mb-3 mb-sm-0">
                            <h4>Range</h4>
                            <ul class="product__filter__bar-list">
                                @foreach($collections as $categoryKey => $categoryValue)
                                    <li><label><input type="checkbox" name="collection[]" pro-filter="{{$categoryValue->name}}" value="{{$categoryValue->id}}" onclick="productsFetch()"><i></i> {{$categoryValue->name}}</label></li>
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
                                    <li><label> <input type="checkbox" pro-filter="{{$colorValue->name}}"><i></i> {{ucwords($colorValue->name)}}</label></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product__holder">
                <div class="row">
                    @php
                        // $productsData = \App\Models\Product::where('cat_id', $data->id)->orderBy('style_no', 'asc')->get();
                    @endphp

                    {{-- @forelse($productsData as $categoryProductKey => $categoryProductValue) --}}
                    @forelse($data->ProductDetails as $categoryProductKey => $categoryProductValue)
                    @php if($categoryProductValue->status == 0) {continue;} @endphp
                    <a href="{{ route('front.product.detail', $categoryProductValue->slug) }}" class="product__single" data-events data-cat="tshirt">
                        <figure>
                            <img src="{{asset($categoryProductValue->image)}}" />
                        </figure>
                        <figcaption>
                            <h4>{{$categoryProductValue->name}} <br/>Style No: <span>{{$categoryProductValue->style_no}}</span></h4>
                            <h5>
                            @if (count($categoryProductValue->colorSize) > 0)
                                @php
                                    $varArray = [];
                                    foreach($categoryProductValue->colorSize as $productVariationKey => $productVariationValue) {
                                        $varArray[] = $productVariationValue->offer_price;
                                    }
                                    $bigger = $varArray[0];
                                    for ($i = 1; $i < count($varArray); $i++) {
                                        if ($bigger < $varArray[$i]) {
                                            $bigger = $varArray[$i];
                                        }
                                    }

                                    $smaller = $varArray[0];
                                    for ($i = 1; $i < count($varArray); $i++) {
                                        if ($smaller > $varArray[$i]) {
                                            $smaller = $varArray[$i];
                                        }
                                    }

                                    /* $displayPrice = $smaller.' - '.$bigger;

                                    if ($smaller == $bigger) $displayPrice = $smaller; */
                                @endphp
                                {{-- &#8377;{{$displayPrice}} --}}
								@if($smaller == $bigger)
									&#8377;{{$bigger}}
								@else
									&#8377;{{$smaller}} - &#8377;{{$bigger}}
								@endif
                            @else
                                &#8377;{{$categoryProductValue->offer_price}}
                            @endif
                            </h5>
                        </figcaption>

                        {!! variationColors($categoryProductValue->id, 5) !!}

						{{-- <div class="color">
							@if (count($categoryProductValue->colorSize) > 0)
							@php
							$uniqueColors = [];

							foreach ($categoryProductValue->colorSize as $variantKey => $variantValue) {
								if (in_array_r($variantValue->colorDetails->code, $uniqueColors)) continue;

								$uniqueColors[] = [
									'id' => $variantValue->colorDetails->id,
									'code' => $variantValue->colorDetails->code,
									'name' => $variantValue->colorDetails->name,
								];
							}

							echo '<ul class="product__color">';
							// echo count($uniqueColors);
							foreach($uniqueColors as $colorCodeKey => $colorCode) {
								if ($colorCodeKey == 5) {break;}
								// if ($colorCodeKey < 5) {
									if ($colorCode['id'] == 61) {
										echo '<li style="background: -webkit-linear-gradient(left,  rgba(219,2,2,1) 0%,rgba(219,2,2,1) 9%,rgba(219,2,2,1) 10%,rgba(254,191,1,1) 10%,rgba(254,191,1,1) 10%,rgba(254,191,1,1) 20%,rgba(1,52,170,1) 20%,rgba(1,52,170,1) 20%,rgba(1,52,170,1) 30%,rgba(15,0,13,1) 30%,rgba(15,0,13,1) 30%,rgba(15,0,13,1) 40%,rgba(239,77,2,1) 40%,rgba(239,77,2,1) 40%,rgba(239,77,2,1) 50%,rgba(254,191,1,1) 50%,rgba(137,137,137,1) 50%,rgba(137,137,137,1) 60%,rgba(254,191,1,1) 60%,rgba(254,191,1,1) 60%,rgba(254,191,1,1) 70%,rgba(189,232,2,1) 70%,rgba(189,232,2,1) 80%,rgba(209,2,160,1) 80%,rgba(209,2,160,1) 90%,rgba(48,45,0,1) 90%); " class="color-holder" data-bs-toggle="tooltip" data-bs-placement="top" title="Assorted"></li>';
									} else {
										echo '<li onclick="sizeCheck('.$categoryProductValue->id.', '.$colorCode['id'].')" style="background-color: '.$colorCode['code'].'" class="color-holder" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$colorCode['name'].'"></li>';
									}
								// }
							}
							if (count($uniqueColors) > 5) {echo '<li>+ more</li>';}
							echo '</ul>';
							@endphp
						@endif
						</div> --}}
                    </a>
                    @empty

                    @endforelse
                </div>
            </div>
        </div>
        @else
            <p>Sorry, No products found under {{$data->name}} </p>
        @endif
    </div>
</section>
@endsection

@section('script')
<script>
    function productsFetch() {
        // collection values
        var collectionArr = [];
        $('input[name="collection[]"]:checked').each(function(i){
          collectionArr[i] = $(this).val();
        });

        $.ajax({
            url: '{{route("front.category.filter")}}',
            method: 'POST',
            data: {
                '_token' : '{{ csrf_token() }}',
                'categoryId' : '{{$data->id}}',
                'orderBy' : $('select[name="orderBy"]').val(),
                'collection' : collectionArr,
            },
            beforeSend: function() {
                /* $loadingSwal = Swal.fire({
                    title: 'Please wait...',
                    text: 'We are adjusting the products as per your need!',
                    showConfirmButton: false,
                    allowOutsideClick: false
                    // timer: 1500
                }) */
            },
            success: function(result) {
                if (result.status == 200) {
                    var content = prodText = '';
                    $('#prod_count').text(result.data.length);
                    (result.data.length > 1) ? prodText = 'products' : prodText = 'product';
                    $('#prod_text').text(prodText);
                    $.each(result.data, function(key, value) {
                        var url = '{{ route('front.product.detail', ":slug") }}';
                        url = url.replace(':slug', value.slug);

                        content += `
                        <a href="${url}" class="product__single" data-events data-cat="tshirt">
                            <figure>
                                <img src="{{asset('${value.image}')}}" />
                                <h6>${value.styleNo}</h6>
                            </figure>
                            <figcaption>
                                <h4>${value.name}</h4>
                                <h5>${value.displayPrice}</h5>
                            </figcaption>
                            <div class="color">${value.colorVariation}</div>
                        </a>
                        `;
                    });

                    $('.product__holder .row').html(content);
                    // $loadingSwal.close();
                }
                // console.log(result);
            },
            error: function(result) {
                // $loadingSwal.close()
                console.log(result);
                $errorSwal = Swal.fire({
                    // icon: 'error',
                    // title: 'We cound not find anything',
                    text: 'We cound not find anything. Try again with a different filter!',
                    confirmButtonText: 'Okay'
                })
            },
        });
    }
</script>
@endsection
