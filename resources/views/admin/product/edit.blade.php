@extends('admin.layouts.app')

@section('page', 'Edit Product')

@section('content')
<section>
    <form method="POST" action="{{ route('admin.product.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-9">

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <select class="form-control" name="cat_id">
                            <option hidden selected>Select category...</option>
                            @foreach ($categories as $index => $item)
                                <option value="{{$item->id}}" {{ ($data->cat_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('cat_id') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div class="col-sm-4">
                        <select class="form-control" name="sub_cat_id">
                            <option hidden selected>Select sub-category...</option>
                            @foreach ($sub_categories as $index => $item)
                                <option value="{{$item->id}}" {{ ($data->sub_cat_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('sub_cat_id') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div class="col-sm-4">
                        <select class="form-control" name="collection_id">
                            <option hidden selected>Select collection...</option>
                            @foreach ($collections as $index => $item)
                                <option value="{{$item->id}}" {{ ($data->collection_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('collection_id') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <input type="text" name="name" placeholder="Add Product Title" class="form-control" value="{{$data->name}}">
                    @error('name') <p class="small text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="card shadow-sm">
                    <div class="card-header">
                        Product Short Description
                    </div>
                    <div class="card-body">
                        <textarea id="product_short_des" name="short_desc">{{$data->short_desc}}</textarea>
                        @error('short_desc') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <textarea id="product_des" name="desc">{{$data->desc}}</textarea>
                    @error('desc') <p class="small text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="card shadow-sm">
                    <div class="card-header">
                        Product data
                    </div>
                    <div class="card-body pt-0">
                        <div class="admin__content">
                        <aside>
                            <nav>Price</nav>
                        </aside>
                        <content>
                            <div class="row mb-2 align-items-center">
                            <div class="col-3">
                                <label for="inputPassword6" class="col-form-label">Regular Price</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="inputprice6" class="form-control" aria-describedby="priceHelpInline" name="price" value="{{$data->price}}">
                                @error('price') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="col-auto">
                                <span id="priceHelpInline" class="form-text">
                                Must be 8-20 characters long.
                                </span>
                            </div>
                            </div>
                            <div class="row mb-2 align-items-center">
                            <div class="col-3">
                                <label for="inputprice6" class="col-form-label">Offer Price</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="inputprice6" class="form-control" aria-describedby="priceHelpInline" name="offer_price" value="{{$data->offer_price}}">
                                @error('offer_price') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                Must be 8-20 characters long.
                                </span>
                            </div>
                            </div>
                        </content>
                        </div>
                        <div class="admin__content">
                            <aside>
                                <nav>Meta</nav>
                            </aside>
                            <content>
                                <div class="row mb-2 align-items-center">
                                    <div class="col-3">
                                        <label for="inputPassword6" class="col-form-label">Title</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" id="inputprice6" class="form-control" aria-describedby="priceHelpInline" name="meta_title" value="{{$data->meta_title}}">
                                        @error('meta_title') <p class="small text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="col-auto">
                                        <span id="priceHelpInline" class="form-text">
                                        Must be 8-20 characters long.
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-2 align-items-center">
                                    <div class="col-3">
                                        <label for="inputprice6" class="col-form-label">Description</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" id="inputprice6" class="form-control" aria-describedby="priceHelpInline" name="meta_desc" value="{{$data->meta_desc}}">
                                        @error('meta_desc') <p class="small text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="col-auto">
                                        <span id="passwordHelpInline" class="form-text">
                                        Must be 8-20 characters long.
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-2 align-items-center">
                                    <div class="col-3">
                                        <label for="inputprice6" class="col-form-label">Keyword</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" id="inputprice6" class="form-control" aria-describedby="priceHelpInline" name="meta_keyword" value="{{$data->meta_keyword}}">
                                        @error('meta_keyword') <p class="small text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="col-auto">
                                        <span id="passwordHelpInline" class="form-text">
                                        Must be 8-20 characters long.
                                        </span>
                                    </div>
                                </div>
                            </content>
                        </div>
                        <div class="admin__content">
                            <aside>
                                <nav>Data</nav>
                            </aside>
                            <content>
                                <div class="row mb-2 align-items-center">
                                <div class="col-3">
                                    <label for="inputPassword6" class="col-form-label">Style No</label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" id="inputprice6" class="form-control" aria-describedby="priceHelpInline" name="style_no" value="{{$data->style_no}}">
                                    @error('style_no') <p class="small text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col-auto">
                                    <span id="priceHelpInline" class="form-text">
                                    Must be 8-20 characters long.
                                    </span>
                                </div>
                                </div>
                            </content>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card shadow-sm">
                    <div class="card-header">
                        Publish
                    </div>
                    <div class="card-body text-end">
                        <input type="hidden" name="product_id" value="{{$data->id}}">
                        <button type="submit" class="btn btn-sm btn-danger">Publish </button>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-header">
                        Product Image
                    </div>
                    <div class="card-body">
                        <div class="w-100 product__thumb">
                            <label for="thumbnail"><img id="output" src="{{ asset($data->image) }}"/></label>
                            @error('image') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <input type="file" id="thumbnail" accept="image/*" name="image" onchange="loadFile(event)" class="d-none">
                        <script>
                            var loadFile = function(event) {
                                var output = document.getElementById('output');
                                output.src = URL.createObjectURL(event.target.files[0]);
                                output.onload = function() {
                                URL.revokeObjectURL(output.src) // free memory
                                }
                            };
                        </script>
                    </div>
                </div>
                {{-- <div class="card shadow-sm">
                    <div class="card-header">More images</div>
                    <div class="card-body">
                        <input type="file" accept="image/*" name="product_images[]" class="mb-3" multiple>
                        @error('product_images') <p class="small text-danger">{{ $message }}</p> @enderror
                        <div class="w-100 product__thumb">
                        @foreach($images as $index => $singleImage)
                            <label for="thumbnail" class="position-relative">
                                <img id="output" src="{{ asset($singleImage->image) }}" class="img-thumbnail mb-3"/>
                                <a href="{{ route('admin.product.image.delete', $singleImage->id) }}" class="btn btn-sm btn-danger product-img-remove" title="Remove this image">&times;</a>
                            </label>
                        @endforeach
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </form>






    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h3>Product variation</h3>
                    <a href="#addColorModal" data-bs-toggle="modal" class="btn btn-sm btn-success">Add color</a>
                </div>
                <div class="col-12">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>SR</th>
                                <th>Color</th>
                                <th>Image</th>
                                <th>Size</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($productColorGroup as $productColorKey => $productColorGroupVal)
                            <tr>
                                <td>{{ $productColorKey + 1 }}</td>
                                <td>
                                    <span style="display:inline-block;width:15px;height:15px;border-radius:50%;background-color:{{ $productColorGroupVal->colorDetails->code }}"></span>
                                    {{ $productColorGroupVal->colorDetails->name }}
                                </td>
                                <td>
                                    <form action="{{route('admin.product.variation.image.add')}}" method="post" enctype="multipart/form-data">@csrf
                                        <input type="file" name="image[]" id="prodVar{{$productColorKey}}" class="d-none" multiple>
                                        <label for="prodVar{{$productColorKey}}">Browse</label>

                                        <input type="hidden" name="product_id" value="{{$id}}">
                                        <input type="hidden" name="color_id" value="{{$productColorGroupVal->color}}">
                                        <button type="submit" class="btn btn-sm btn-success">+</button>
                                    </form>
                                    <hr>
                                    @php
                                        $productVariationImages = \App\Models\ProductImage::where('product_id', $id)->where('color_id', $productColorGroupVal->color)->get();

                                        $prodImagesDIsplay = '';
                                        foreach($productVariationImages as $productImgKey => $productImgVal) {
                                            $prodImagesDIsplay .= '<img src='.asset($productImgVal->image).' style="height:30px"> - <a href='.route('admin.product.variation.image.delete', $productImgVal->id).' class="text-danger">Delete image</a><br>';
                                        }
                                    @endphp
                                    {!!$prodImagesDIsplay!!}
                                </td>
                                <td>
                                    <form action="{{route('admin.product.variation.size.add')}}" method="post">@csrf
                                        <select name="size" id="">
                                            <option value="" selected>Select...</option>
                                            @php
                                                $sizes = \App\Models\Size::get();
                                                foreach ($sizes as $key => $value) {
                                                    echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                                                }
                                            @endphp
                                        </select>
                                        <input type="text" name="price" id="" placeholder="Price">
                                        <input type="text" name="offer_price" id="" placeholder="Offer Price">
                                        <input type="hidden" name="product_id" value="{{$id}}">
                                        <input type="hidden" name="color_id" value="{{$productColorGroupVal->color}}">
                                        <button type="submit" class="btn btn-sm btn-success">+ Add size</button>
                                    </form>
                                    <hr>
                                    @php
                                        $productVariationColorSizes = \App\Models\ProductColorSize::where('product_id', $id)->where('color', $productColorGroupVal->color)->get();

                                        $prodSizesDIsplay = '<table class="table table-sm table-hover"><tbody>';
                                        foreach($productVariationColorSizes as $productSizeKey => $productSizeVal) {
                                            $prodSizesDIsplay .= '<tr><td>'.$productSizeVal->sizeDetails->name.'</td><td>Price Rs '.$productSizeVal->price.'</td><td>Offer Rs '.$productSizeVal->offer_price.'</td><td><a href='.route('admin.product.variation.size.delete', $productSizeVal->id).' class="text-danger">Delete size</a></td></tr>';
                                        }
                                        $prodSizesDIsplay .= '</tbody></table>';
                                    @endphp
                                    {!!$prodSizesDIsplay!!}
                                </td>
                                <td>
                                    <a href="{{ route('admin.product.variation.color.delete',['productId' => $id, 'colorId' => $productColorGroupVal->color]) }}" class="text-danger">Delete Color</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-12">
                    <h3>Add data</h3>
                </div>
                <div class="col-md-12">
                    <table class="table table-sm" id="timePriceTable">
                        <thead>
                            <tr>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" name="color[]">
                                        <option value="" disabled hidden selected>Select...</option>
                                        @foreach($colors as $colorIndex => $colorValue)
                                            <option value="{{$colorValue->id}}" @if (old('color') && in_array($colorValue,old('color'))){{('selected')}}@endif>{{$colorValue->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="size[]">
                                        <option value="" disabled hidden selected>Select...</option>
                                        @foreach($sizes as $sizeIndex => $sizeValue)
                                            <option value="{{$sizeValue->id}}">{{$sizeValue->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><a class="btn btn-sm btn-success actionTimebtn addNewTime">+</a></td>
                            </tr>
                        </tbody>
                    </table>
                    @error('time')<p class="text-danger">{{$message}}</p>@enderror
                    @error('price')<p class="text-danger">{{$message}}</p>@enderror
                </div>
            </div> --}}

        </div>
    </div>
</section>

<div class="modal fade" tabindex="-1" id="addColorModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add new color</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.product.variation.color.add')}}" method="post">@csrf
                <input type="hidden" name="product_id" value="{{$id}}">
                <input type="hidden" name="color" value="{{$productColorGroupVal->color}}">

                <select name="color" id="">
                    <option value="" selected>Select color...</option>
                    @php
                        $color = \App\Models\Color::orderBy('name', 'asc')->get();
                        foreach ($color as $key => $value) {
                            echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                        }
                    @endphp
                </select>

                <select name="size" id="">
                    <option value="" selected>Select size...</option>
                    @php
                        $sizes = \App\Models\Size::get();
                        foreach ($sizes as $key => $value) {
                            echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                        }
                    @endphp
                </select>

                <br>
                <br>

                <input type="text" name="price" id="" placeholder="Price">
                <input type="text" name="offer_price" id="" placeholder="Offer Price">

                <br>
                <br>
                <button type="submit" class="btn btn-sm btn-success">+ Add size</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
    <script>
        ClassicEditor
        .create( document.querySelector( '#product_des' ) )
        .catch( error => {
            console.error( error );
        });
        ClassicEditor
        .create( document.querySelector( '#product_short_des' ) )
        .catch( error => {
            console.error( error );
        });

        $(document).on('click','.addNewTime',function(){
            var thisClickedBtn = $(this);
            thisClickedBtn.removeClass(['addNewTime','btn-success']);
            thisClickedBtn.addClass(['removeTimePrice','btn-danger']).text('X');

            var toAppend = `
            <tr>
                <td>
                    <select class="form-control" name="color[]">
                        <option value="" hidden selected>Select...</option>
                        @foreach($colors as $colorIndex => $colorValue)
                            <option value="{{$colorValue->id}}" @if (old('color') && in_array($colorValue,old('color'))){{('selected')}}@endif>{{$colorValue->name}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-control" name="size[]">
                        <option value="" hidden selected>Select...</option>
                        @foreach($sizes as $sizeIndex => $sizeValue)
                            <option value="{{$sizeValue->id}}">{{$sizeValue->name}}</option>
                        @endforeach
                    </select>
                </td>
                <td><a class="btn btn-sm btn-success actionTimebtn addNewTime">+</a></td>
            </tr>
            `;

            $('#timePriceTable').append(toAppend);
        });

        $(document).on('click','.removeTimePrice',function(){
            var thisClickedBtn = $(this);
            thisClickedBtn.closest('tr').remove();
        });

        function sizeCheck(productId, colorId) {
            $.ajax({
                url : '{{route("admin.product.size")}}',
                method : 'POST',
                data : {'_token' : '{{csrf_token()}}', productId : productId, colorId : colorId},
                success : function(result) {
                    if (result.error === false) {
                        let content = '<div class="btn-group" role="group" aria-label="Basic radio toggle button group">';

                        $.each(result.data, (key, val) => {
                            content += `<input type="radio" class="btn-check" name="productSize" id="productSize${val.sizeId}" autocomplete="off"><label class="btn btn-outline-primary px-4" for="productSize${val.sizeId}">${val.sizeName}</label>`;
                        })

                        content += '</div>';

                        $('#sizeContainer').html(content);
                    }
                },
                error: function(xhr, status, error) {
                    // toastFire('danger', 'Something Went wrong');
                }
            });
        }
    </script>
@endsection
