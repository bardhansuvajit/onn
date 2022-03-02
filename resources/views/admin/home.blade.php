@extends('admin.layouts.app')

@section('page', 'Home')

@section('content')
<section>
    <div class="row">
        <div class="col-sm-3">
            <div class="card home__card bg-gradient-danger">
                <div class="card-body">
                    <h4>Weekly Orders <i class="fi fi-br-box-alt"></i></h4>
                    <h2>3,000</h2>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card home__card bg-gradient-info">
                <div class="card-body">
                    <h4>Weekly Sales <i class="fi fi-br-chart-histogram"></i></h4>
                    <h2>&#8377; 23,000</h2>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card home__card bg-gradient-success">
                <div class="card-body">
                    <h4>Visitors Online <i class="fi fi-br-user"></i></h4>
                    <h2>&#8377; 23,000</h2>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card home__card bg-gradient-secondary">
                <div class="card-body">
                    <h4>No of Product <i class="fi fi-br-cube"></i></h4>
                    <h2>500</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="row">
        <div class="col-sm-6">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center"><i class="fi fi-br-picture"></i></th>
                        <th>Name</th>
                        <th>Style No.</th>
                        <th>Category</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center column-thumb">
                            <img src="images/polo_tshirt_front.png">
                        </td>
                        <td>
                            Polo t-Shirt
                            <div class="row__action">
                                <a href="#">Edit</a>
                                <a href="#">View</a>
                                <a href="#">Active</a>
                                <a href="#" class="text-danger">Delete</a>
                            </div>
                        </td>
                        <td>NC 422</td>
                        <td>T-Shirt</td>
                        <td>Rs. 450</td>
                    </tr>
                    <tr>
                        <td class="text-center column-thumb">
                            <img src="images/polo_tshirt_front.png">
                        </td>
                        <td>
                            Polo t-Shirt
                            <div class="row__action">
                                <a href="#">Edit</a>
                                <a href="#">View</a>
                                <a href="#">Deactive</a>
                                <a href="#" class="text-danger">Delete</a>
                            </div>
                        </td>
                        <td>NC 422</td>
                        <td>T-Shirt</td>
                        <td>Rs. 450</td>
                    </tr>
                    <tr>
                        <td class="text-center column-thumb">
                            <img src="images/polo_tshirt_front.png">
                        </td>
                        <td>
                            Polo t-Shirt
                            <div class="row__action">
                                <a href="#">Edit</a>
                                <a href="#">View</a>
                                <a href="#">Active</a>
                                <a href="#" class="text-danger">Delete</a>
                            </div>
                        </td>
                        <td>NC 422</td>
                        <td>T-Shirt</td>
                        <td>Rs. 450</td>
                    </tr>
                    <tr>
                        <td class="text-center column-thumb">
                            <img src="images/polo_tshirt_front.png">
                        </td>
                        <td>
                            Polo t-Shirt
                            <div class="row__action">
                                <a href="#">Edit</a>
                                <a href="#">View</a>
                                <a href="#">Deactive</a>
                                <a href="#" class="text-danger">Delete</a>
                            </div>
                        </td>
                        <td>NC 422</td>
                        <td>T-Shirt</td>
                        <td>Rs. 450</td>
                    </tr>
                    <tr>
                        <td class="text-center column-thumb">
                            <img src="images/polo_tshirt_front.png">
                        </td>
                        <td>
                            Polo t-Shirt
                            <div class="row__action">
                                <a href="#">Edit</a>
                                <a href="#">View</a>
                                <a href="#">Active</a>
                                <a href="#" class="text-danger">Delete</a>
                            </div>
                        </td>
                        <td>NC 422</td>
                        <td>T-Shirt</td>
                        <td>Rs. 450</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order No.</th>
                        <th>Order Date</th>
                        <th>Order Amount</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#ONNOR54321</td>
                        <td>20 May 2022</td>
                        <td>&#8377; 650</td>
                        <td><span class="badge bg-info">New</span></td>
                    </tr>
                    <tr>
                        <td>#ONNOR54321</td>
                        <td>20 May 2022</td>
                        <td>&#8377; 650</td>
                        <td><span class="badge bg-info">New</span></td>
                    </tr>
                    <tr>
                        <td>#ONNOR54321</td>
                        <td>20 May 2022</td>
                        <td>&#8377; 650</td>
                        <td><span class="badge bg-danger">cancel</span></td>
                    </tr>
                    <tr>
                        <td>#ONNOR54321</td>
                        <td>20 May 2022</td>
                        <td>&#8377; 650</td>
                        <td><span class="badge bg-warning">Process</span></td>
                    </tr>
                    <tr>
                        <td>#ONNOR54321</td>
                        <td>20 May 2022</td>
                        <td>&#8377; 650</td>
                        <td><span class="badge bg-success">Delivered</span></td>
                    </tr>
                    <tr>
                        <td>#ONNOR54321</td>
                        <td>20 May 2022</td>
                        <td>&#8377; 650</td>
                        <td><span class="badge bg-success">Delivered</span></td>
                    </tr>
                    <tr>
                        <td>#ONNOR54321</td>
                        <td>20 May 2022</td>
                        <td>&#8377; 650</td>
                        <td><span class="badge bg-success">Delivered</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection