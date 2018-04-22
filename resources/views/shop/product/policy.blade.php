<!--<div class="deliver-top withStore"></div>-->
<div class="ssec-policies-feature">
    <div class='col-right'>
        <div class='title-col'>
            <h3 style="font-size: 15px;margin-top: 0px;margin-bottom: 20px;">
                Có thể bạn quan tâm
            </h3>
        </div>
        <div class='list-r'>
            <div class='row'>
                @foreach($relatedPosts as $item)
                <div class='one-r col-md-12 col-sm-5 col-xs-10' style="padding-bottom: 10px;border-bottom: solid 1px #cecece;margin-bottom: 20px;">
                    <a href="{{ $item->getUrl() }}">
                        <div class='img-one' style="background: url('{{ parse_image_url('md_' . $item->image) }}') no-repeat;background-size: cover;background-position: center;"></div>
                    </a>
                    <h3 class='title-one'>
                        <a href="{{ $item->getUrl() }}">{{ $item->getTitle() }}</a>
                    </h3>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    
.title-col {
    font-size: 25px;
    font-weight: bold;
    color: #000;
    position: relative;
    z-index: 0;
    margin: auto;
}
.title-col h3 {
    position: relative;
    z-index: 5;
    display: table;
    margin: 20px auto 10px;
    background: #fff;
    font-family: 'SFU', Arial, sans-serif;
    text-transform: uppercase;
    font-weight: bold;
    font-size: 22px;
    padding: 5px 10px;
}
h3.title-one {
    font-size: 18px;
    line-height: 1.2;
    margin-top: 10px;
    text-align: center;
}
h3.title-one a {
    color: #000;
}
span.date {
    font-size: 11px;
    color: #666;
    display: block;
    font-family: Arial, sans-serif;
}
.img-one {
    height: 170px;
}
</style>