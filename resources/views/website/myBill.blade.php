@extends('app')
@section('content')
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Mã đơn hàng</th>
      <th scope="col">Sản phẩm</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Thành tiền</th>
      <th scope="col">Thời gian</th>
      <th scope="col">Trạng thái</th>
    </tr>
  </thead>
  <tbody>
  @foreach($data as $key => $item)
    <tr>
      <th scope="row">{{$key + 1}}</th>
      <td>{{ $item->id }}</td>
      <td>{{ $item->product_name }}</td>
      <td>{{ $item->count }}</td>
      <td>{{ $item->price * $item->count }}</td>
      <td>{{ $item->created_at }}</td>
      @if($item->status === 0)
      <td>Chờ xác nhận </td>
      @elseif ($item->status === 1)
      <td>Đã xác nhận </td>
      @elseif ($item->status === 2)
      <td>Đang vận chuyển </td>
      @elseif ($item->status === 3)
      <td>Hoàn thành </td>
      @else 
      <td>Đã huỷ</td>
      @endif
      @if($item->status !== 4)
      <td><a onclick="return confirm('Bạn có muốn huỷ đơn hàng này?')" href="http://localhost:8000/update-my-bill?id=<?php echo $item->id ?>"><button  type="button" class="btn btn-danger">Huỷ đơn hàng</button></a></td>
      @endif
    </tr>
   @endforeach
  </tbody>
</table>
@endsection

<script>
    function cancel(id) {
        var x = document.getElementById(`mySelect-${id}`).value;
        window.location.replace(`http://localhost:8000/admin/update-bill?stt=${x}&id=${id}`);
    }
</script>