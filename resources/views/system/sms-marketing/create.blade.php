@extends('layout.admin.index')

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>
                <i class="fa fa-plus"></i> Tạo chiến dịch
                <a class="pull-right btn btn-sm btn-default" href="{{ route('system.emailMarketing.index') }}"><i class="fa fa-arrow-left"></i> Quay lại</a>
                <div class="clearfix"></div>
            </h2>
        </div>
    </div>
@stop

@section('content')
<style type="text/css">
    .email-template-selected-item {
        border: 1px solid #ccc;
        float: left;
        margin: 3px;
        text-align: center;
        padding: 5px;
    }
    .email-template-selected-item .time {
        font-size: 10px;
    }
</style>
    <div class="row">
        <div class="col-xs-12 animated">

            @include('includes/flash-message')

            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="form" method="POST" id="form-main" enctype="multipart/form-data">
                            <div class="form-group {{ hasValidator('name') }}">
                                <label class="control-label">Tên chiến dịch</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                {!! alertError('name') !!}
                            </div>

                            <div class="form-group {{ hasValidator('sms') }}">
                                <label class="control-label">Nội dung tin nhắn</label>
                                <textarea name="sms" class="form-control" rows="10" required>{{ old('sms') }}</textarea>
                                {!! alertError('sms') !!}
                            </div>

                            <div class="form-group">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Chọn tập khách hàng</div>
                                    <div class="panel-body">
                                        <p>Chọn tệp khách hàng từ máy tính</p>
                                        <p>
                                            <input type="file" id="file-customers" name="file-customers">
                                        </p>
                                        <p>File bắt buộc phải là file có dạng *.xls hoặc *.xlsx</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-md btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<script type="text/javascript">
    $(function() {

    });
</script>
@stop