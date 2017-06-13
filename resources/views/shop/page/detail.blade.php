@extends('shop/layout/blog')

@section('content')
<div id="post-detail" class="container">

    @include('shop/partials/blog/nav')

    <div class="post row">
        <!--Chi tiết bài viết-->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h1 class="title-post">
                {{ $page->getTitle() }}
            </h1>
            <span class="date">
                {{ date('d.m.Y', strtotime($page->created_at)) }}
            </span>
            <div class="detail">
                {{ $page->getTeaser() }}
            </div>

            <div id="descriptionblog" class="description descriptionblog">
                {!! $page->getContent() !!}
            </div>
        </div>
    </div>
</div>
@stop