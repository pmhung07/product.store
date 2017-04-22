@extends('shop/layout/blog')

@section('content')
<div class="container blogs-container">

    @include('shop/partials/blog/nav')

    <div class="items-doc">
        <div class="row">
            @foreach($posts as $item)
                <div class="col-xs-12 col-sm-4 col-md-4" style="margin: 10px 0">
                    <a class="ClickBlogItem" href="{{ $item->getUrl() }}">
                        <div class="item-img ClickBlogItem" style="height:305px !important;background: url('{{ parse_image_url('md_'. $item->image) }}') no-repeat;background-size: cover;background-position: center;">
                        </div>
                    </a>
                    <h3 class="ClickBlogItem">
                        <a class="ClickBlogItem" href="{{ $item->getUrl() }}">{{ $item->getTitle() }}</a>
                    </h3>
                    <span class="date Khỏe">{{ date('d.m.Y', strtotime($item->updated_at)) }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="text-center">
        {!! $posts->links() !!}
    </div>
</div>
@stop