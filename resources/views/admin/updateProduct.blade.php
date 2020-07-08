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
                    <form role="form" enctype="multipart/form-data" method="post" action="{{URL::to('admin/update-product')}}@php echo '/'.$_GET['id'] @endphp">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input value="{{$data->product_name}}" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category</label>
                            <select name="category" class="form-control input -sm m-bot15">
                            @foreach($cate as $key=>$item)
                                @if($data->category_id === $item->id)
                                <option selected value="{{$item->id}}">{{$item->category_name}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->category_name}}</option>
                                @endif
                            @endforeach    
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Brand</label>
                            <select name="brand" class="form-control input -sm m-bot15">
                            @foreach($brand as $key=>$item)
                                @if($data->brand_id === $item->id)
                                    <option selected value="{{$item->id}}">{{$item->brand_name}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->brand_name}}</option>
                                    @endif
                                @endforeach   
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea style="resize: none;" name="desc" class="form-control">{{$data->desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Content</label>
                            <textarea style="resize: none;" name="content" class="form-control">{{$data->content}}</textarea>
                            <script>
                                CKEDITOR.replace('content');
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Price (VND)</label>
                            <input  value="{{$data->price}}" type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter price" name="price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Size (kg)</label>
                            <input value="{{$data->size}}" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter size" name="size">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image</label>
                            <input value="{{$data->image}}" type="file" class="form-control" id="exampleInputEmail1"  name="image">
                            <image style="width: 70px; margin-top: 15px" src="/backend/images/{{($data->image)}}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="status" class="form-control input -sm m-bot15">
                                @if($data->status === 0)
                                    <option value=0 selected>Out of stock</option>
                                @else
                                    <option value=0 >Out of stock</option>
                                @endif        
                                @if($data->status === 1)
                                    <option selected value=1 >In stock</option>
                                @else
                                    <option value=1 >In stock</option>
                                @endif  
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