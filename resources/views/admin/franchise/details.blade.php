@extends('admin.layouts.app')

@section('page', 'Franchise Partner detail')

@section('content')
<section>
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>{{ $data->name }}</h3>
                            <p class="text-muted">{{ $data->email }}</p>
                            <p class="small">{{ $data->phone }}</p>
                            <p class="small">{{ $data->city }}</p>
                            <p class="small">{{ $data->business_nature }}</p>
                            <p class="small">{{ $data->region }}</p>
                            <p class="small">{{ $data->property_type }}</p>
                            <p class="small">{{ $data->capital }}</p>
                            <p class="small">{{ $data->source }}</p>
                            <p class="small">{{ $data->comment }}</p>
                            <p class="small">{{ $data->remarks }}</p>
                            <p class="small">{{ $data->created_at }}</p>
                            <hr>
                        </div>
                    </div>

                    <hr>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
