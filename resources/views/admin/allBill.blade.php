@extends('admin.index')
@section('content')
<script>
    function myFunction() {
        let param = $("#inputSearch").val();
        window.location.replace(`http://localhost:8000/admin/search-brand-product?name=${param}`);
    }
</script>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            List Bill
        </div>
        
        <div class="row w3-res-tb">
            <div class="col-sm-9">
                <form role="form" method="post" action="{{URL::to('admin/filter-bill')}}">
                    {{csrf_field()}}
                    <label for="birthday">From:</label>
                    <input name="start_date" value="{{isset($start_date) ?  $start_date : '' }}" type="date" id="birthday" name="birthday">
                    <label for="birthday">To:</label>
                    <input name="end_date"  value="{{isset($end_date) ?  $end_date : '' }}" type="date" id="birthday" name="birthday">
                    <input value="Go" type="submit">
                </form>
            </div>
            <div class="col-sm-2">
                @if(isset($total_price))
                Total: {{number_format($total_price)}} VND
                @endif
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Date</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Count</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><span class="text-ellipsis">{{ $item->name }}</span></td>
                        <td><span class="text-ellipsis">{{ $item->product_name }}</span></td>
                        <td><span class="text-ellipsis">{{ $item->created_at }}</span></td>
                        <td><span class="text-ellipsis">{{ $item->address }}</span></td>
                        <td><span class="text-ellipsis">{{ $item->phone }}</span></td>
                        <td><span class="text-ellipsis">{{ $item->count }}</span></td>
                        <td><span class="text-ellipsis">{{ $item->price }}</span></td>
                        @if($item->status === 4)
                        <td><span class="text-ellipsis">Đã huỷ</span></td>
                        @endif
                        @if($item->status !== 4)
                        <td>
                            <select id="mySelect-{{$item->id}}" onchange="updateStt(<?php echo $item->id ?>)"
                                name="status" class="form-control input -sm m-bot15">
                                @if($item->status === 0)
                                <option value=0 selected>Pending</option>
                                @else
                                <option value=0>Pending</option>
                                @endif
                                @if($item->status === 1)
                                <option selected value=1>Confirmed</option>
                                @else
                                <option value=1>Confirmed</option>
                                @endif
                                @if($item->status === 2)
                                <option selected value=2>In Delivery</option>
                                @else
                                <option value=2>In Delivery</option>
                                @endif
                                @if($item->status === 3)
                                <option selected value=3>Done</option>
                                @else
                                <option value=3>Done</option>
                                @endif
                            </select>
                        </td>
                        @endif
                        <td>
                            <a onclick="return confirm('Do you want to delete?')"
                                href="{{URL::to('admin/del-bill/')}}@php echo '/'.$item->id @endphp" class="active"
                                ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                        <td>
                        <a onclick="return confirm('Do you want to export?')"
                                href="{{URL::to('admin/export-bill/')}}@php echo '/'.$item->id @endphp" class="active"
                                ui-toggle-class="">
                            <button type="button" class="btn btn-primary">Export</button>
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

<script>
    function updateStt(id) {
        var x = document.getElementById(`mySelect-${id}`).value;
        window.location.replace(`http://localhost:8000/admin/update-bill?stt=${x}&id=${id}`);
    }
</script>