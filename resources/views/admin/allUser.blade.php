@extends('admin.index')
@section('content')
<script>
function myFunction(){
       let param = $("#inputSearch").val();
       window.location.replace(`http://localhost:8000/admin/search-user?name=${param}`);
}
</script>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
           List Brands Product
        </div>
        <div class="row w3-res-tb">
            <!-- <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div> -->
            <div class="col-sm-3">
                <div class="input-group">
                    <input value="{{ isset($_GET['name']) ? $_GET['name'] : '' }}" type="text" class="input-sm form-control" id="inputSearch" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" onclick="myFunction()" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td><span class="text-ellipsis">{{ $item->email }}</span></td>
                        <td><span class="text-ellipsis">{{ $item->level === 1 ? 'Super Admin' : 'Admin' }}</span></td>
                        <td>
                            <a href="{{URL::to('/admin/update-user')}}?id=@php echo $item->id @endphp" class="active" ui-toggle-class="">
                                <i class="fa fa-pencil text-success text-active"></i>
                            </a>
                        </td>
                        <td>
                            <a onclick="return confirm('Do you want to delete?')" href="{{URL::to('admin/del-user/')}}@php echo '/'.$item->id @endphp" class="active" ui-toggle-class="">    
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection