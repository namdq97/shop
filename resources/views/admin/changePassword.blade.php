@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
             Thay đổi mật khẩu
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" method="post" action="{{URL::to('admin/update-password')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu hiện tại</label>
                            <input required type="password" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="old">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mật khẩu mới</label>
                            <input required type="password" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="new">
                        </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                        <?php
                            $msg = Session::get('error');
                            if($msg){
                                echo '<p style="color: red; text-align: center">'.$msg.'</p>';
                                $msg = Session::put('error', null);
                            }
                        ?>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
