@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               My Profile
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" method="post" action="{{URL::to('admin/update-profile')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">User Name</label>
                            <input value="{{$data->name}}" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input value="{{$data->email}}" required type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone</label>
                            <input value="{{$data->phone}}" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Level</label>
                            @if($data->level === 1)
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
                            @else
                            <p>Admin</p>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
