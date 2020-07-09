@extends('layouts.header')
@section('content')
@php
@endphp
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <?php 
            $checkout_fall = Session::get('checkout_fall');
            if($checkout_fall){
                echo '<div class="alert alert-warning" role="alert">'.$checkout_fall.'</div>';
                $checkout_fall = Session::put('checkout_fall', null);
            }
        ?>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Sản phẩm</td>
                        <td class="description"></td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach(Cart::content() as $item)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img style="width: 80; height: 80px"
                                    src="/backend/images/{{($item->options->image)}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$item->name}}</a></h4>
                            <p>Web ID: {{$item->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($item->price)}} VND</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="{{URL::to('/add/'.$item->rowId.'/'.$item->qty)}}"> + </a>
                                <input id="mySelect-{{$item->id}}" type="text" style="width: 60px; float: left" id="lname" name="lname" value="{{$item->qty}}">
                                <a class="cart_quantity_down" href="{{URL::to('/minus/'.$item->rowId.'/'.$item->qty)}}"> - </a>
                            </div>
                            <button onclick="insertQty({{$item->id}})" type="button" class="btn btn-primary" style="height: 28px; margin: 0">Xác nhận</button>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($item->price * $item->qty)}} VNĐ</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('delete/'.$item->rowId)}}"><i
                                    class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@if(count(Cart::content()) > 0)
<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng tiền<span>{{Cart::subtotal()}} VNĐ</span></li>
                        <li>Phí vận chuyển<span>0 VNĐ</span></li>
                        <li>Thành tiền <span>{{Cart::subtotal()}} VNĐ</span></li>
                    </ul>
                    <form method="post" action="{{URL::to('checkout')}}" style="padding-left: 40px;">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên người nhận</label>
                            <input required type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name="name" placeholder="Tên người nhận">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số điện thoại</label>
                            <input required type="text" class="form-control" name="phone" id="exampleInputPassword1"
                                placeholder="Số điện thoại">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa chỉ</label>
                            <input required type="text" class="form-control" name="address" id="exampleInputPassword1"
                                placeholder="Địa chỉ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ghi chú</label>
                            <textarea name="note" style="height: 200px;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Đặt hàng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
@endif
@endsection

<script>
    function insertQty(id) {
        var value = document.getElementById(`mySelect-${id}`).value;
        window.location.replace(`http://localhost:8000/insertNumber/${id}/${value}`);
    }
</script>