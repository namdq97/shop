@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Thêm danh sách danh mục
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" method="post" action="{{URL::to('admin/submit-category')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ghi chú</label>
                            <textarea style="resize: none;" name="desc" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Thêm</button>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
