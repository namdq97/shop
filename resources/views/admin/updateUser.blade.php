@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Sửa quản trị viên
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" method="post" action="{{URL::to('admin/update-user')}}@php echo '/'.$_GET['id'] @endphp">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input value="{{$data->name}}" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input value="{{$data->email}}" required type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">SDT</label>
                            <input value="{{$data->phone}}" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Cấp</label>
                            <select name="level" class="form-control input -sm m-bot15">
                                @if($data->level === 0)
                                    <option value=0 selected>Admin</option>
                                @else
                                    <option value=0 >Admin</option>
                                @endif        
                                @if($data->level === 1)
                                    <option selected value=1 >Super Admin</option>
                                @else
                                    <option value=1 >Super Admin</option>
                                @endif  
                            </select>
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
