@extends('app')
@section('content')
<div class="blog-post-area">
    <h2 class="title text-center">Latest From our Blog</h2>
    <div class="single-blog-post">
        <h3>{{$data->news_name}}</h3>
        <div class="post-meta">
            <ul>
                <li><i class="fa fa-user"></i> Admin</li>
                <li><i class="fa fa-calendar"></i> {{$data->created_at}}</li>
            </ul>
            <span>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
            </span>
        </div>
        <a href="">
            <img src="/backend/images/{{($data->image)}}" alt="" />
        </a>
        <p>
          {{$data->content}}
        </p>
       
    </div>
</div>
@endsection