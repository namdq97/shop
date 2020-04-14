@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <h4 style="margin-left: 15px">
                Thay đổi mật khẩu
            </h4>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" method="post" action="{{URL::to('/submit-password')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu hiện tại</label>
                            <input minlength="8" required type="password" class="form-control" id="exampleInputEmail1" name="old">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mật khẩu mới</label>
                            <input minlength="8" required type="password" class="form-control" id="exampleInputEmail1" name="new">
                        </div>
                        <button type="submit" class="btn btn-info">Cập nhật</button>
                        @if ($errors->any())
                        <div style="margin-top: 20px;" class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection