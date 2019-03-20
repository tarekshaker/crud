@extends('layout.default')

@section('content')
    <div class="float-right">
        <a href="/products" class="btn btn-primary">Go Back</a>
    </div>
<div style="text-align: center;">
    <h1>{{ucwords($product->name)}}</h1>
    <img style="width:200px;height: 200px;" src="/storage/images/products/main_image/{{$product->main_image}}">
</div>

    <hr>
    <h3>Price: {{$product->price}}$</h3>
    <hr>
    <div>
        <h3>Description</h3>
        <p>{!!$product->description!!}</p>
    </div>
    <hr>
    @if(count($product->images)>0)
        <h3>Images</h3>
        <div class="row">
        @foreach($product->images as $image)
                <div class="col-md-4 col-lg-3" style="margin-bottom: 20px">
                    <div class="card">
                        <img id="preview" src='{{url('storage/images/products/'.$product->id."/".$image->filename)}}'
                             width="100%" height="180px"/>
                    </div>
                </div>

        @endforeach
        </div>
    @endif




@endsection
