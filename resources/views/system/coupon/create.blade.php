@extends('layout.admin.index')

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2><i class="fa fa-list"></i> Tạo mã coupon</h2>
        </div>
    </div>
@stop

@section('content')

<div class="row">
    <div class="col-xs-12 animated">

        @include('includes/flash-message')

        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-lg-12">

                    @include('system/coupon/form')
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
<link rel="stylesheet" type="text/css" href="/js/plugins/loopj-jquery-tokeninput/styles/token-input.css">
<link rel="stylesheet" type="text/css" href="/js/plugins/loopj-jquery-tokeninput/styles/token-input-facebook.css">
<script src="/js/plugins/loopj-jquery-tokeninput/src/jquery.tokeninput.js" type="text/javascript"></script>


<script type="text/javascript">
    $(function() {
        $('#choice-single-product').find('.form-control').tokenInput('/system/shop/coupon/ajax/products', {
            preventDuplicates: true
        });

        $('#choice-product-group').find('.form-control').tokenInput('/system/shop/coupon/ajax/product-group', {
            preventDuplicates: true
        });

        $('#type').on('change', function() {
            var $this = $(this);

            $('.choice-something').addClass('hide');
            if($this.val() == 1) {
                $('#choice-single-product').removeClass('hide')
                                            .find('.form-control')
                                            .focus();
            } else if($this.val() == 2) {
                $('#choice-product-group').removeClass('hide')
                                            .find('.form-control')
                                            .focus();
            }
            else {
                $('.choice-something').addClass('hide');
            }
        });


        $('#form-data').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);

            $.ajax({
                url : '{{ route('system.coupon.store') }}',
                type : "POST",
                data: $form.serialize(),
                dataType: 'json',
                success: function(response) {
                    toastr.success(response.message);
                    window.location.href = '{{ route('system.coupon.index') }}';
                },
                error: function(response) {
                    var errors = response.responseJSON;
                    for(var i in errors) {
                        var error = errors[i];
                        for( var j in error) {
                            toastr.error(error[j], '');
                        }
                    }
                }
            })
        });
    });
</script>

@stop
