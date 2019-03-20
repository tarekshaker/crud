@extends('layout.default')

@section('content')
    <div class="float-right">
        <a href="/products" class="btn btn-primary">Go Back</a>
    </div>
    <h1>Add New Product</h1>
    {!! Form::open(['action' => 'ProductsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    {{csrf_field()}}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('price', 'Price')}}
        {{Form::number('price', '', ['class' => 'form-control', 'placeholder' => 'Price','step' => '0.1'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description'])}}
    </div>
    <div class="form-group">
        {!! Form::label("main_image","Main Image",["class"=>"col-form-label"]) !!}
        <div class="col-md-8">
            <div class="image_group">
                <img id="preview" src='{{url('storage/images/noimage.jpg')}}' height="200px" width="200px"/>
                {!! Form::file("main_image",["class"=>"form-control","style"=>"display:none"]) !!}
                <a href="javascript:changeImage();" class="btn btn-sm btn-success">Change</a> |
                <a href="javascript:removeImage()" class="btn btn-sm btn-danger">Remove</a>
                <input type="hidden" value="0" name="remove" id="remove">
            </div>

        </div>
    </div>
    <div class="form-group">
        {!! Form::label("images","Images",["class"=>"col-form-label"]) !!}
        <input type="file" class="form-control" name="images[]" multiple />
    </div>
    <hr>
    <div class="form-group" style="text-align: center;">
        {{Form::submit('Add Product', ['class'=>'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}
@endsection


@section('js')
    <script>

        // Preview of Product Image
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
    </script>


@endsection
