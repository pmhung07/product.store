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
        <link href='http://9119.vn/shop/assets/hstatic.net/969/1000003969/1000161857/style.full.css%3Fv=8910.css' rel='stylesheet' type='text/css'  media='all'  />

        <link rel="stylesheet" type="text/css" href="/shop/assets/css/animate.css">

        <link href='http://9119.vn/shop/assets/hstatic.net/969/1000003969/1000161857/font-awesome.css%3Fv=8910.css' rel='stylesheet' type='text/css'  media='all'  />
        <script src='/shop/assets/js/jquery.js' type='text/javascript'></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

        <link rel="stylesheet" type="text/css" href="/shop/assets/js/OwlCarousel2-2.2.0/dist/assets/owl.carousel.min.css">
        <link rel="stylesheet" type="text/css" href="/shop/assets/js/OwlCarousel2-2.2.0/dist/assets/owl.theme.default.min.css">
        <script src="/shop/assets/js/OwlCarousel2-2.2.0/dist/owl.carousel.min.js" type="text/javascript"></script>

        <script src='http://9119.vn/shop/assets/hstatic.net/969/1000003969/1000161857/wow.js%3Fv=8910' type='text/javascript'></script>
        <script src='http://9119.vn/shop/assets/hstatic.net/969/1000003969/1000161857/script.js%3Fv=8910' type='text/javascript'></script>
        <script src='http://9119.vn/shop/assets/hstatic.net/969/1000003969/1000161857/api.jquery.js%3Fv=8910' type='text/javascript'></script>

        <link href='http://9119.vn/shop/assets/hstatic.net/969/1000003969/1000161857/filter.css%3Fv=8910.css' rel='stylesheet' type='text/css'  media='all'  />

        <link href='http://9119.vn/shop/assets/hstatic.net/969/1000003969/1000161857/picbox.css%3Fv=8910.css' rel='stylesheet' type='text/css'  media='all'  />
        <script src='http://9119.vn/shop/assets/hstatic.net/969/1000003969/1000161857/picbox.js%3Fv=8910' type='text/javascript'></script>

        <!-- Swipe box -->
        <link rel="stylesheet" type="text/css" href="/shop/assets/js/jQuery-swipebox/css/swipebox.min.css">
        <script type="text/javascript" src="/shop/assets/js/jQuery-swipebox/js/jquery.swipebox.min.js"></script>

        <link href='http://9119.vn/shop/assets/hstatic.net/969/1000003969/1000161857/section-gioi-thieu.scss.css%3Fv=8910.css' rel='stylesheet' type='text/css'  media='all'  />

        <link href='http://9119.vn/shop/assets/hstatic.net/969/1000003969/1000161857/picbox.css%3Fv=8910.css' rel='stylesheet' type='text/css'  media='all'  />
        <script src='http://9119.vn/shop/assets/hstatic.net/969/1000003969/1000161857/picbox.js%3Fv=8910' type='text/javascript'></script>

        <link rel="stylesheet" type="text/css" href="/shop/assets/css/shop.css">

        <link rel="stylesheet" type="text/css" href="/bundle/shop.style.css">
        <link rel="stylesheet" type="text/css" href="/shop/assets/css/suggest.css">

        <!-- MY PLUGIN -->
        <script type="text/javascript" src="/shop/assets/js/my-plugin/add-to-cart.js"></script>
        <script type="text/javascript" src="/shop/assets/js/my-plugin/load-district.js"></script>

        <?php
            $countMenuLevel1 = 0;
            foreach($GLB_Menus as $item) {
                if($item->parent_id == 0) {
                    $countMenuLevel1 ++;
                }
            }
        ?>
        <style type="text/css">
            .menu-top>li {
                width: calc(100%/{{ $countMenuLevel1 }});
            }
        </style>

        <!-- Facebook Pixel Code -->
        <!--<script>
          !function(f,b,e,v,n,t,s)
          {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
          n.callMethod.apply(n,arguments):n.queue.push(arguments)};
          if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
          n.queue=[];t=b.createElement(e);t.async=!0;
          t.src=v;s=b.getElementsByTagName(e)[0];
          s.parentNode.insertBefore(t,s)}(window, document,'script',
          'https://connect.facebook.net/en_US/fbevents.js');
          fbq('init', '141873229708189');
          fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
          src="https://www.facebook.com/tr?id=141873229708189&ev=PageView&noscript=1"
        /></noscript>-->
        <!-- End Facebook Pixel Code -->


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