@extends('shop/layout/blog')

@section('content')
<div class="container">

    @include('shop/partials/blog/nav')

    <div class="post row">
        <!--Chi tiết bài viết-->
        <div class="col-md-7 col-sm-6 col-xs-10">
            <h2 class="parent">
                <a href="{{ $post->category->getUrl() }}">{{ $post->category->getName() }}</a>
            </h2>
            <h1 class="title-post">
                {{ $post->getTitle() }}
            </h1>
            <span class="date">
                {{ date('d.m.Y', strtotime($post->created_at)) }}
            </span>
            <div class="detail">
                {{ $post->getTeaser() }}
            </div>

            <div id="descriptionblog" class="description descriptionblog">
                {!! $post->getContent() !!}
            </div>
            <div class="news-all ">
                <div class='title-news line-1'>
                    Bài viết liên quan
                </div>
            </div>
        </div>
        <!--Chuyên đề-->
        <div class="col-md-3 col-sm-4 col-xs-10">
            <div class='col-right'>
                <div class='title-col'>
                    <h3>
                        Có thể bạn quan tâm
                    </h3>
                </div>
                <div class='list-r'>
                    <div class='row'>
                        @foreach($relatedPosts as $item)
                        <div class='one-r col-md-5 col-sm-5 col-xs-10'>
                            <a href="{{ $item->getUrl() }}">
                                <div class='img-one' style="background: url('{{ parse_image_url('md_' . $item->image) }}') no-repeat;background-size: cover;background-position: center;"></div>
                            </a>
                            <h3 class='title-one'>
                                <a href="{{ $item->getUrl() }}">{{ $item->getTitle() }}</a>
                            </h3>
                            <span class='date'>{{ date('d.m.Y', strtotime($item->updated_at)) }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-sm-6 col-xs-10" id="orther-article">
            <div class="blog-category-items">
                <h3 class="category-title article-title">
                    <a href="javascript:void(0)">tin bài khác</a>
                </h3>
                <div class="items-doc">
                    <div class="row">
                        @foreach($relatedPosts as $item)
                            <div class="col-xs-5 col-md-25" style="margin:10px 0;">
                                <a href="{{ $item->getUrl() }}">
                                    <div class="item-img" style="background: url('{{ parse_image_url('md_' . $item->image) }}') no-repeat;background-size: cover;background-position: center;">
                                    </div>
                                </a>
                                <h3>
                                    <a href="txn062-co-ban-than-cua-nang-cong-so.html">{{ $item->getTitle() }}</a>
                                </h3>
                                <span class="date">{{ date('d.m.Y', strtotime($item->updated_at)) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop