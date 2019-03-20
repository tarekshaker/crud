@extends('layout.default')
@section('content')
    <div class="float-right">
        <a href="/products" class="btn btn-primary">Go Back</a>
    </div>
    <h1>Edit Product</h1>
    {!! Form::open(['action' => ['ProductsController@update',$product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', $product->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('price', 'Price')}}
        {{Form::number('price', $product->price, ['class' => 'form-control', 'placeholder' => 'Price','step' => '0.1'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', $product->description, ['class' => 'form-control', 'placeholder' => 'Description'])}}
    </div>
    <div class="form-group">
        {!! Form::label("main_image","Main Image",["class"=>"col-form-label"]) !!}
        <div class="col-md-12">
            <img id="preview" src='{{url('storage/images/products/main_image/'.$product->main_image)}}' height="200px"
                 width="200px"/>
            {!! Form::file("main_image",["class"=>"form-control","style"=>"display:none"]) !!}
            <a href="javascript:changeImage();" class="btn btn-sm btn-success">Change</a>
            <input type="hidden" style="display: none" value="0" name="remove" id="remove">
        </div>
    </div>

    <hr>
    <div class="form-group" style="text-align: center;">
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Edit Product', ['class'=>'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}


    <h6>Images</h6>

    <div class="row">
        @if ($product->images->count())
            @foreach($product->images as $image)
                <div class="col-md-4 col-lg-3" style="margin-bottom: 20px">
                    <div class="card">
                        <img id="preview"
                             src='{{url('storage/images/products/'.$image->product_id."/".$image->filename)}}'
                             width="100%" height="180px"/>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                {!! Form::open(['action' => ['ProductsImageController@destroy',$image->id],'id'=>'frm_'.$image->id,'style'=>'padding-bottom: 0px;margin-bottom: 0px']) !!}
                                {{csrf_field()}}
                                <div class="row">

                                    <div class="col-sm-12">
                                        <a href="javascript:if(confirm('Are you sure want to delete?')) $('#frm_{{$image->id}}').submit()"
                                           class="btn btn-danger btn-sm btn-block">Delete</a>
                                    </div>

                                    <input type="hidden" name="_method" value="delete"/>

                                </div>
                                {!! Form::close() !!}
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        @else

        @endif
    </div>


@endsection

@section('js')
    <script>
        function changeImage() {
            $('#main_image').click();
        }

        $('#main_image').change(function () {
            var imgPath = $(this)[0].value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
                readURL(this);
            else
                alert("Please select image file (jpg, jpeg, png,gif).")
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                    $('#remove').val(0);
                }
            }
        }

        function removeImage() {
            $('#preview').attr('src', '{{url('storage/images/noimage.jpg')}}');
            $('#remove').val(1);
        }

        function removeProductImage(image) {
            $(image).parent().remove();
        }

    </script>
@endsection
