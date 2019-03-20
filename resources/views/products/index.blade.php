@extends('layout.default')

@section('content')

    <div class="float-right">
        <a href="{{url('products/create')}}" class="btn btn-primary">Add Product</a>
    </div>
    <h1 style="font-size: 2.2rem">Products</h1>
    <hr/>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 col-lg-3" style="margin-bottom: 20px">
                <div class="card">
                    <img class="card-img-top"
                         src="{{url($product->main_image? '/storage/images/products/main_image/'.$product->main_image:'/storage/images/noimage.jpg')}}"
                         alt="{{$product->description}}" width="100%" height="180px"/>
                    <div class="card-body">
                        <h6 class="card-title text-center">{{ucwords($product->name)}}</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            {!! Form::open(['action' => ['ProductsController@destroy',$product->id],'id'=>'frm_'.$product->id,'style'=>'padding-bottom: 0px;margin-bottom: 0px']) !!}
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="{{url('/products/'.$product->id)}}"
                                       class="btn btn-primary btn-sm btn-success">Show</a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="javascript:if(confirm('Are you sure want to delete?')) $('#frm_{{$product->id}}').submit()"
                                       class="btn btn-danger btn-sm btn-block">Delete</a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="{{url('/products/'.$product->id.'/edit')}}"
                                       class="btn btn-primary btn-sm btn-block">Edit</a>
                                </div>
                                <input type="hidden" name="_method" value="delete"/>

                            </div>
                            {!! Form::close() !!}
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
    <nav>
        <ul class="pagination justify-content-end">
            {{$products->links('vendor.pagination.bootstrap-4')}}
        </ul>
    </nav>
    </div>
@endsection
