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
</style>

<section class="listing-header">
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
                <select name="orderBy" onclick="productsFetch()">
                    <option value="new_arr">New Arrivals</option>
                    <option value="mst_viw">Most Viewed</option>
                    <option value="prc_low">Price: Low To High</option>
                    <option value="prc_hig">Price: High To Low</option>
                </select>
            </div>
        </div>

        <div class="product__wrapper">
            <div class="product__filter active">
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
                                    <li><label><input type="checkbox" pro-filter="{{$colorValue->name}}"><i></i> {{ucwords($colorValue->name)}}</label></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product__holder active">
                <div class="row">
                    @forelse($data->ProductDetails as $categoryProductKey => $categoryProductValue)
                    <a href="{{ route('front.product.detail', $categoryProductValue->slug) }}" class="product__single" data-events data-cat="tshirt">
                        <figure>
                            <img src="{{asset($categoryProductValue->image)}}" />
                            <h6>{{$categoryProductValue->style_no}}</h6>
                        </figure>
                        <figcaption>
                            <h4>{{$categoryProductValue->name}}</h4>
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

                                    $displayPrice = $smaller.' - '.$bigger;

                                    if ($smaller == $bigger) $displayPrice = $smaller;
                                @endphp
                                &#8377;{{$displayPrice}}
                            @else
                                &#8377;{{$categoryProductValue->offer_price}}
                            @endif
                            </h5>
                        </figcaption>
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
                $loadingSwal = Swal.fire({
                    title: 'Please wait...',
                    text: 'We are adjusting the products as per your need!',
                    showConfirmButton: false,
                    allowOutsideClick: false
                    // timer: 1500
                })
            },
            success: function(result) {
                if (result.status == 200) {
                    var content = '';
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
                                <h5>&#8377;${value.displayPrice}</h5>
                            </figcaption>
                        </a>
                        `;
                    });

                    $('.product__holder .row').html(content);
                    $loadingSwal.close();
                }
                // console.log(result);
            },
            error: function(result) {
                $loadingSwal.close()
                // console.log(result);
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