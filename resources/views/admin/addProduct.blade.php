@extends('admin.index')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" enctype="multipart/form-data" method="post"
                        action="{{URL::to('admin/submit-product')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input required type="text" class="form-control" id="exampleInputEmail1"
                                placeholder="Enter name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Danh mục</label>
                            <select name="category" class="form-control input -sm m-bot15">
                                @foreach($cate as $key=>$item)
                                <option value="{{$item->id}}">{{$item->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thương hiệu</label>
                            <select name="brand" class="form-control input -sm m-bot15">
                                @foreach($brand as $key=>$item)
                                <option value="{{$item->id}}">{{$item->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Miêu tả</label>
                            <textarea style="resize: none;" name="desc" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung</label>
                            <textarea style="resize: none;" name="content" class="form-control"></textarea>
                            <script>
                                CKEDITOR.replace('content');
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá (VND)</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter price"
                                name="price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng trong kho</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter price"
                                name="amount">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng (kg)</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter size"
                                name="size">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ảnh</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" name="image">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trạng thái</label>
                            <select name="status" class="form-control input -sm m-bot15">
                                <option value=0>Hết hàng</option>
                                <option value=1>Còn hàng</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Thêm</button>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection