@extends('app')
@section('content')
<div class="blog-post-area">
    <h2 class="title text-center">Latest From our Blog</h2>
    @foreach($data as $key=>$item)
        <div class="single-blog-post">
            <h3>{{$item->news_name}}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> Admin</li>
                    <li><i class="fa fa-calendar"></i> {{$item->created_at}}</li>
                </ul>
                <span>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </span>
            </div>
            <a href="{{URL::to('/chi-tiet-tin-tuc/'.$item->id)}}">
                <img src="/backend/images/{{($item->image)}}" alt="" />
            </a>
            <p>{{$item->desc}}</p>
            <a class="btn btn-primary" href="{{URL::to('/chi-tiet-tin-tuc/'.$item->id)}}">Read More</a>
        </div>
    @endforeach    
</div>
@endsection