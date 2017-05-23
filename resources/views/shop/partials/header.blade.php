<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html" />
        <meta charset="utf-8" />
        <title>{{ array_get($metadata, 'title') }}</title>
        <meta name="description" content="{{ array_get($metadata, 'description') }}" />
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ array_get($metadata, 'title') }}">
        <meta property="og:image" content="{{ array_get($metadata, 'image') }}">
        <meta property="og:description" content="{{ array_get($metadata, 'description') }}">
        <meta property="og:url" content="{{ array_get($metadata, 'url') }}">
        <meta property="og:site_name" content="{{ url('/') }}">
        <link rel="canonical" href="{{ array_get($metadata, 'url', Request::url()) }}" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <link rel="shortcut icon" type="image/png" href="{{ $GLB_Setting->favicon ? url(parse_image_url($GLB_Setting->favicon)) : url('/') }}" />

        <!-- Boostrap,owl.carousel,animated -->
        {{-- <link href='/shop/assets/hstatic.net/969/1000003969/1000161857/bootstrap_juno.min.css%3Fv=8910.css' rel='stylesheet' type='text/css'  media='all'  /> --}}
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href='/shop/assets/hstatic.net/969/1000003969/1000161857/style.full.css%3Fv=8910.css' rel='stylesheet' type='text/css'  media='all'  />

        <link rel="stylesheet" type="text/css" href="/shop/assets/css/animate.css">

        <link href='/shop/assets/hstatic.net/969/1000003969/1000161857/font-awesome.css%3Fv=8910.css' rel='stylesheet' type='text/css'  media='all'  />
        <script src='/shop/assets/js/jquery.js' type='text/javascript'></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

        <link rel="stylesheet" type="text/css" href="/shop/assets/js/OwlCarousel2-2.2.0/dist/assets/owl.carousel.min.css">
        <script src="/shop/assets/js/OwlCarousel2-2.2.0/dist/owl.carousel.min.js" type="text/javascript"></script>

        <script src='/shop/assets/hstatic.net/969/1000003969/1000161857/wow.js%3Fv=8910' type='text/javascript'></script>
        <script src='/shop/assets/hstatic.net/969/1000003969/1000161857/script.js%3Fv=8910' type='text/javascript'></script>
        <script src='/shop/assets/hstatic.net/969/1000003969/1000161857/api.jquery.js%3Fv=8910' type='text/javascript'></script>

        <link href='/shop/assets/hstatic.net/969/1000003969/1000161857/filter.css%3Fv=8910.css' rel='stylesheet' type='text/css'  media='all'  />

        <link href='/shop/assets/hstatic.net/969/1000003969/1000161857/picbox.css%3Fv=8910.css' rel='stylesheet' type='text/css'  media='all'  />
        <script src='/shop/assets/hstatic.net/969/1000003969/1000161857/picbox.js%3Fv=8910' type='text/javascript'></script>

        <!-- Swipe box -->
        <link rel="stylesheet" type="text/css" href="/shop/assets/js/jQuery-swipebox/css/swipebox.min.css">
        <script type="text/javascript" src="/shop/assets/js/jQuery-swipebox/js/jquery.swipebox.min.js"></script>

        <link href='/shop/assets/hstatic.net/969/1000003969/1000161857/section-gioi-thieu.scss.css%3Fv=8910.css' rel='stylesheet' type='text/css'  media='all'  />

        <link href='/shop/assets/hstatic.net/969/1000003969/1000161857/picbox.css%3Fv=8910.css' rel='stylesheet' type='text/css'  media='all'  />
        <script src='/shop/assets/hstatic.net/969/1000003969/1000161857/picbox.js%3Fv=8910' type='text/javascript'></script>

        <link rel="stylesheet" type="text/css" href="/shop/assets/css/shop.css">

        <link rel="stylesheet" type="text/css" href="/bundle/style.css">

        <!-- MY PLUGIN -->
        <script type="text/javascript" src="/shop/assets/js/my-plugin/add-to-cart.js"></script>
        <script type="text/javascript" src="/shop/assets/js/my-plugin/load-district.js"></script>

    </head>
    <body class="cms-index-index">
        <div id="script-head-body"></div>
        <div id="myModal-popup" class="modal fade" role="dialog" style="background: rgba(0, 0, 0, 0.5);z-index: 999999;">
            <div class="modal-dialog">
                <!-- Modal content-->
            </div>
        </div>

        <!-- Wrapper -->
        <div id="wrapper">