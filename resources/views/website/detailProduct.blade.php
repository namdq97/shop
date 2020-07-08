@extends('app')
@section('content')

    <div class="product-details">
        <!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">
                <img src="/backend/images/{{($data->image)}}" alt="" />
            </div>
        </div>
        <div class="col-sm-7">
            <div class="product-information">
                <!--/product-information-->
                <h2>{{$data->product_name}}</h2>
                <span>
                    <span>{{number_format($data->price)}} VND</span>
                    <a href="{{URL::to('/cart/'.$data->id)}}">
                    <button type="button" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm vào giỏ hàng
                    </button></a>
                </span>
                <p><b class="{{ $data->status === 0 ? 'a' : 'b' }}">Tình trạng:</b> {{$data->status === 0 ? 'Hết hàng' : 'Còn hàng'}}</p>
                <p><b>Thương hiệu:</b> {{$brand_name}}</p>
                <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
            </div>
            <!--/product-information-->
        </div>
    </div>
    <!--/product-details-->

    <div class="category-tab shop-details-tab">
        <!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
                <li><a href="#reviews" data-toggle="tab">Đánh giá </a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="details">
                {!! $data->content !!}
            </div>

            <div class="tab-pane fade in" id="reviews">
                <div class="col-sm-12">
                @foreach($review as $key => $value)
                    <ul>
                        <li><a href=""><i class="fa fa-user"></i>{{$value->name}}</a></li>
                        <li><a href=""><i class="fa fa-clock-o"></i>{{$value->created_at}}</a></li>
                    </ul>
                    <p>{{$value->content}}</p>
                @endforeach    

                    @if (Auth::check()) 

                    <p><b>Đánh giá của bạn</b></p>

                    <form method="post" action="{{URL::to('submit-review/'.$data->id)}}">
                    {{csrf_field()}}
                        <textarea name="content"></textarea>
                        <button type="submit" class="btn btn-default pull-right">
                            Đăng
                        </button>
                    </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <!--/category-tab-->
@endsection