@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Cập nhật thương hiệu
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" method="post" action="{{URL::to('admin/update-brand/')}}@php echo '/'.$_GET['id'] @endphp">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input required type="text" value="{{$data->brand_name}}" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ghi chú</label>
                            <textarea style="resize: none;" name="desc" class="form-control">{{$data->desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa chỉ</label>
                            <textarea style="resize: none;" name="address" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">SDT liên hệ</label>
                            <textarea style="resize: none;" name="phone" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
