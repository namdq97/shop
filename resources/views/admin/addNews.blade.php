@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Add News
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" method="post" action="{{URL::to('admin/submit-news')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea style="resize: none;" name="desc" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Content</label>
                            <textarea style="resize: none;" name="content" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Image</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" name="image">
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
