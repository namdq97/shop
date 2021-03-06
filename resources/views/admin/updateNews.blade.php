@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Thêm bài viết
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" method="post" action="{{URL::to('admin/update-news')}}@php echo '/'.$_GET['id'] @endphp" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input value="{{$data->news_name}}" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea style="resize: none;" name="desc" class="form-control">{{$data->desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung</label>
                            <textarea style="resize: none;" name="content" class="form-control">{{$data->content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ảnh</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" name="image">
                            {{$data->image}}
                        </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
