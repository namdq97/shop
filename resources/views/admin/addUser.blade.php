@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Add User
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" method="post" action="{{URL::to('admin/submit-user')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input required type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone</label>
                            <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Level</label>
                            <select name="level" class="form-control input -sm m-bot15">
                                    <option value=0 >Admin</option>
                                    <option value=1 >Super Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
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
