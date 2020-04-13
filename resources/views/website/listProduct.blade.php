@extends('app')
@section('content')
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Dach sách sản phẩm</h2>
    @foreach($all as $key=>$item)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="/backend/images/{{($item->image)}}" alt="" />
                    <h2>{{number_format($item->price)}} VND</h2>
                    <p>{{$item->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{number_format($item->price)}} VND</h2>
                        <p> <a style="color: white" href="{{URL::to('/chi-tiet-san-pham/'.$item->id)}}">{{$item->product_name}}</a></p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection