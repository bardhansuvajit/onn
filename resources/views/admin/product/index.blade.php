@extends('admin.layouts.app')

@section('page', 'Products')

@section('content')
<section>
    {{-- <div class="search__filter">
        <div class="row align-items-center justify-content-between">
        <div class="col">
            <ul>
            <li class="active"><a href="#">All <span class="count">({{$data->count()}})</span></a></li>
            <li><a href="#">Active <span class="count">(7)</span></a></li>
            <li><a href="#">Inactive <span class="count">(3)</span></a></li>
            </ul>
        </div>
        <div class="col-auto">
            <form>
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                <input type="search" name="" class="form-control" placeholder="Search here..">
                </div>
                <div class="col-auto">
                <button type="submit" class="btn btn-outline-danger btn-sm">Search Product</button>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>

    <div class="filter">
        <div class="row align-items-center justify-content-between">
        <div class="col">
            <form>
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                <select class="form-control">
                    <option>Select Category</option>
                    <option>T-shirt</option>
                    <option>Jacket</option>
                    <option>Vests</option>
                    <option>Brief</option>
                    <option>Track Pants</option>
                    <option>Joggers</option>
                    <option>Socks</option>
                    <option>Sweatshirt</option>
                    <option>Thermal</option>
                    <option>Trunks</option>
                    <option>Boxer</option>
                </select>
                </div>
                <div class="col-auto">
                <select class="form-control">
                    <option>Select Range</option>
                    <option>Grandde</option>
                    <option>Stretchz</option>
                    <option>Sport</option>
                    <option>Comfortz</option>
                    <option>Acttive</option>
                    <option>Platina</option>
                    <option>Relaxz</option>
                    <option>Footkins</option>
                    <option>Thermal</option>
                    <option>Winter</option>
                </select>
                </div>
                <div class="col-auto">
                <button type="submit" class="btn btn-outline-danger btn-sm">Apply</button>
                </div>
            </div>
            </form>
        </div>
        <div class="col-auto">
            <p>{{$data->count()}} Items</p>
        </div>
        </div>
    </div> --}}

    <table class="table">
        <thead>
        <tr>
            <th class="check-column">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault"></label>
            </div>
            </th>
            <th class="text-center"><i class="fi fi-br-picture"></i></th>
            <th>Name</th>
            <th>Style No.</th>
            <th>Category</th>
            <th>Price</th>
            <th>Sale</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $item)
            <tr>
                <td class="check-column">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault"></label>
                </div>
                </td>
                <td class="text-center column-thumb">
                    <img src="{{ asset($item->image) }}">
                </td>
                <td>
                    {{$item->name}}
                    <div class="row__action">
                        <a href="{{ route('admin.product.edit', $item->id) }}">Edit</a>
                        <a href="{{ route('admin.product.view', $item->id) }}">View</a>
                        <a href="{{ route('admin.product.status', $item->id) }}">{{($item->status == 1) ? 'Active' : 'Inactive'}}</a>
                        <a href="{{ route('admin.product.delete', $item->id) }}" class="text-danger">Delete</a>
                    </div>
                </td>
                <td>{{$item->style_no}}</td>
                <td>{{$item->category ? $item->category->name : ''}} > {{$item->subCategory ? $item->subCategory->name : 'NA'}} <br> {{$item->collection ? $item->collection->name : ''}}</td>
                <td>
                    <small> <del>{{$item->price}}</del> </small> Rs. {{$item->offer_price}}
                </td>
                <td>
                    <a href="{{ route('admin.product.sale', $item->id) }}" class="text-decoration-none">
                        @if ($item->saleDetails)
                            <span class="text-success fw-bold"> <i class="fi-br-check"></i> SALE</span>
                        @else
                            <span class="text-danger fw-bold single-line"> <i class="fi-br-plus"></i> SALE</span>
                        @endif
                    </a>
                </td>
                <td>Published<br/>{{date('j M Y', strtotime($item->created_at))}}</td>
                <td><span class="badge bg-{{($item->status == 1) ? 'success' : 'danger'}}">{{($item->status == 1) ? 'Active' : 'Inactive'}}</span></td>
            </tr>
            @empty
            <tr><td colspan="100%" class="small text-muted">No data found</td></tr>
            @endforelse
        </tbody>
    </table>
</section>
@endsection