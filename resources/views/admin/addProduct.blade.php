@extends('admin.index')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Add Product
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" enctype="multipart/form-data" method="post" action="{{URL::to('admin/submit-product')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category</label>
                            <select name="category" class="form-control input -sm m-bot15">
                            @foreach($cate as $key=>$item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach    
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Brand</label>
                            <select name="brand" class="form-control input -sm m-bot15">
                            @foreach($brand as $key=>$item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach   
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea style="resize: none;" name="desc" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Content</label>
                            <textarea style="resize: none;" name="content" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Price (VND)</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter price" name="price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Size (kg)</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter size" name="size">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image</label>
                            <input type="file" class="form-control" id="exampleInputEmail1"  name="image">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="status" class="form-control input -sm m-bot15">
                                <option value=0>Out of stock</option>
                                <option value=1>In stock</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
