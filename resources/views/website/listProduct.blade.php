@extends('app')
@section('content')
@php
$url_1 = '';
if(isset($_GET['category'])){
    $url_1 = '/danh-sach-san-pham/?category='.$_GET['category'].'&sort=asc'  ;
} else {
    $url_1 = '/danh-sach-san-pham/?brand='.$_GET['brand'].'&sort=asc'   ;
}

$url_2 = '';
if(isset($_GET['category'])){
    $url_2 = '/danh-sach-san-pham/?category='.$_GET['category'].'&sort=desc'  ;
} else {
    $url_2 = '/danh-sach-san-pham/?brand='.$_GET['brand'].'&sort=desc'   ;
}
@endphp

<div class="features_items">
    <div style="display: flex; margin-bottom: 20px; justify-content: flex-end;">
        <input value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" style="height: 35px; background-color: whitesmoke; border: none; width: 50%; padding-left: 10px;" id="inputSearch" type="text" placeholder="Sản phẩm" />
        <button type="submit" onclick="myFunction()" class="btn btn-warning">Tìm kiếm</button>
    </div>
    <!--features_items-->
    <h2 class="title text-center">Dach sách sản phẩm</h2>
    
    <div class="dropdown" style="text-align: right;margin-bottom: 15px;">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Sắp xếp<span class="caret" style="margin-left: 10px;"></span></button>
        <ul class="dropdown-menu" style="right: 0;left: unset;">
          <li><a href="{{URL::to($url_1)}}" style="text-align: center;">Giá thấp -> cao</a></li>
          <li><a href="{{URL::to($url_2)}}" style="text-align: center;">Giá cao -> thấp</a></li>
        </ul>
      </div>
    @foreach($all as $key=>$item)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="/backend/images/{{($item->image)}}" alt="" />
                    <h2>{{number_format($item->price)}} VND</h2>
                    <p> <a style="color: black" href="{{URL::to('/chi-tiet-san-pham/'.$item->id)}}">{{$item->product_name}}</a></p>
                    <a href="{{ Auth::check() ? URL::to('/cart/'.$item->id) : URL::to('login') }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

<script>
    function myFunction() {
        let param = $("#inputSearch").val();
        var url_string = window.location.href
        var url = new URL(url_string);
        var cate = url.searchParams.get("category");
        var brand = url.searchParams.get("brand");
        if(cate) {
            window.location.replace(`http://localhost:8000/danh-sach-san-pham?category=${cate}&search=${param}`);
        } else if(brand) {
            window.location.replace(`http://localhost:8000/danh-sach-san-pham?brand=${brand}&search=${param}`);
        }
    }
</script>
