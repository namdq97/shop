@extends('admin.index')
@section('content')
<script>
function myFunction(){
       let param = $("#inputSearch").val();
       window.location.replace(`http://localhost:8000/admin/search-product?name=${param}`);
}
</script>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
           Danh sách sản phẩm
        </div>
        <div class="row w3-res-tb">
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
                        <th>Tên</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Hình ảnh</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td><span class="text-ellipsis">{{ $item->category_name }}</span></td>
                        <td><span class="text-ellipsis">{{ $item->brand_name }}</span></td>
                        <td><image style="width: 50px" src="/backend/images/{{($item->image)}}" /></td>
                        <td>
                            <a href="{{URL::to('/admin/update-product')}}?id=@php echo $item->id @endphp" class="active" ui-toggle-class="">
                                <i class="fa fa-pencil text-success text-active"></i>
                            </a>
                        </td>
                        <td>
                            <a onclick="return confirm('Do you want to delete?')" href="{{URL::to('admin/del-product/')}}@php echo '/'.$item->id @endphp" class="active" ui-toggle-class="">    
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection