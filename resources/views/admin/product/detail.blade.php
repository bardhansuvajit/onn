@extends('admin.layouts.app')

@section('page', 'Product detail')

@section('content')
<section>
    <form method="post" action="{{ route('admin.product.update', $data->id) }}" enctype="multipart/form-data">@csrf
        <div class="row">
            <div class="col-sm-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="w-100 product__thumb">
                            <label for="thumbnail"><img id="output" src="{{ asset($data->image) }}"/></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <h2>{{$data->name}}</h2>
                        </div>
                        <div class="form-group mb-3">
                            <p><span class="text-muted">Category : </span>{{$data->category->name}} | <span class="text-muted">Sub-category : </span>{{$data->subCategory->name}} | <span class="text-muted">Collection : </span>{{$data->collection->name}}</p>
                        </div>
                        <hr>
                        <div class="form-group mb-3">
                            <h4>
                                <span class="text-muted small"><del>Rs {{$data->price}}</del></span> 
                                <span class="text-danger">Rs {{$data->offer_price}}</span> 
                            </h4>
                        </div>
                        <hr>
                        <div class="form-group mb-3">
                            <p class="small">Short Description</p>
                            {!! $data->short_desc !!}
                        </div>
                        <hr>
                        <div class="form-group mb-3">
                            <p class="small">Description</p>
                            {!! $data->desc !!}
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
                                    <div class="col-9">
                                        <p class="small">{{$data->meta_title}}</p>
                                    </div>
                                </div>
                                <div class="row mb-2 align-items-center">
                                    <div class="col-3">
                                        <label for="inputprice6" class="col-form-label">Description</label>
                                    </div>
                                    <div class="col-9">
                                        <p class="small">{{$data->meta_desc}}</p>
                                    </div>
                                </div>
                                <div class="row mb-2 align-items-center">
                                    <div class="col-3">
                                        <label for="inputprice6" class="col-form-label">Keyword</label>
                                    </div>
                                    <div class="col-9">
                                        <p class="small">{{$data->meta_keyword}}</p>
                                    </div>
                                </div>
                            </content>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection