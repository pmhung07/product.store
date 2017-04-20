
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản lý bán hàng :: Logistics System </title>
    <base href="{{asset('')}}">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Data picker -->
    <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- FooTable -->
    <script src="js/plugins/footable/footable.all.min.js"></script>

    <!-- SUMMERNOTE -->
    <script src="js/plugins/summernote/summernote.min.js"></script>

    <script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <script src="js/functions.js"></script>
    <script src="js/core/core.js"></script>

    <script type="text/javascript">
        if(typeof App === 'undefined') {
            var App = {};
            App.config = {
                token: '{{ csrf_token() }}'
            };
        }
    </script>
</head>

<body>
    <div id="wrapper">
        @include('layout.admin.sidebar')

        <div id="page-wrapper" class="default-bg">
        @include('layout.admin.header')


        @yield('breadcrumbs')

        <div class="wrapper wrapper-content">
        @yield('content')
        </div>


        @include('layout.admin.footer')

        </div>
    </div>

    @yield('script')

</body>
</html>
