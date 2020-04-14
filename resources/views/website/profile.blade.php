@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <section class="panel">
            <h4 style="margin-left: 15px">
               Thông tin cá nhân
            </h4>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" method="post" action="{{URL::to('/submit-profile')}}">
                        {{csrf_field()}}
                        <div class="form-group-profile">
                            <label for="exampleInputEmail1">Tên tài khoản</label>
                            <input value="{{$data->name}}" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name">
                        </div>
                        <div class="form-group-profile">
                            <label for="exampleInputPassword1">Email</label>
                            <input value="{{$data->email}}" required type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">
                        </div>
                        <button type="submit" class="btn btn-info">Cập nhật</button>
                    </form>
                </div>
                <a href="{{URL::to('/change-pass')}}"><button style="margin-top: 20px" type="submit" class="btn btn-alert">Thay đổi mật khẩu</button></a>
            </div>
        </section>
    </div>
</div>
@endsection
