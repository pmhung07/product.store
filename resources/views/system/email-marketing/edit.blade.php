@extends('layout.admin.index')

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>
                <i class="fa fa-plus"></i> Chiến dịch <small>{{ $campain->name }}</small>
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
                        <form class="form" method="POST" id="form-main">
                            <div class="form-group {{ hasValidator('name') }}">
                                <label class="control-label">Tên chiến dịch</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $campain->name) }}" required>
                                {!! alertError('name') !!}
                            </div>

                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Chọn mẫu email</div>
                                        <div class="panel-body" id="email-template-container">
                                            <button type="button" class="btn btn-sm btn-danger btn-action-new-email-template" style="margin-bottom: 5px;">Tạo mới</button>
                                            @foreach($templateEmails as $item)
                                            <button type="button" data-id="{{ $item->id }}" data-title="{{ $item->title }}" class="btn btn-sm btn-default btn-action-select-template-email" style="margin-bottom: 5px;">
                                                #{{ $item->id }} {{ $item->title }}
                                            </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Mẫu được chọn</div>
                                        <div class="panel-body" id="email-selected-container">
                                            @foreach($templateSelected as $v)
                                                <div id="selected-item-id-{{ $v->id }}" class="email-template-selected-item">
                                                    <p class="title">#{{ $v->id }} {{ $v->title }}</p>
                                                    <p class="time text-success">{{ date('d/m/Y H:i', strtotime($v->send_schedule_at)) }}</p>
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs btn-info btn-timer" data-time="{{ strtotime($v->send_schedule_at) }}" data-campain_id="{{ $campain->id }}" data-id="{{ $v->id }}" data-toggle="tooltip" data-title="Đặt lịch"><i class="fa fa-clock-o"></i></button>
                                                        <button class="btn btn-xs btn-danger btn-delete" data-id="{{ $v->id }}" data-toggle="tooltip" data-title="Xóa"><i class="fa fa-trash-o"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
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

                        <div id="modal-timer" class="modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form class="form" id="form-set-timer">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Đặt lịch gửi</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group {{ hasValidator('name') }}">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <input type="text" name="day" class="form-control input-sm" placeholder="Ngày" required>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" name="month" class="form-control input-sm" placeholder="Tháng" required>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" name="year" class="form-control input-sm" placeholder="Năm" required>
                                                    </div>
                                                    <div class="col-xs-6" style="margin-top: 5px;">
                                                        <input type="text" name="hour" class="form-control input-sm" placeholder="Giờ" required>
                                                    </div>
                                                    <div class="col-xs-6" style="margin-top: 5px;">
                                                        <input type="text" name="minute" class="form-control input-sm" placeholder="Phút" required>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <div class="checkbox">
                                                            <label><input id="timer-checkbox-right-now" type="checkbox" value="now" name="now">Ngay lập tức</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="help-inline text-info">Chú ý: Giờ: 00-23,Phút: 00-59,Ngày: 01-31,Tháng: 01-12</span>
                                                {!! alertError('name') !!}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btn-set-change-timer" class="btn btn-sm btn-primary">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div id="modal-form-new-email-template" class="modal fade">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form id="form-new-email-template" class="form">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Tạo mới mẫu email</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="control-label">Tiêu đề</label>
                                                <input type="text" name="title" class="form-control" value="">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Nội dung</label>
                                                <textarea name="content" id="tiny-editor-new-email-template" class="form-control tiny-editor"></textarea>
                                            </div>
                                            <div class="form-group">
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-sm btn-primary btn-submit">Cập nhật</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <script id="tpl-email-selected" type="text/template">
                            <div id="selected-item-id-@{{ id }}" class="email-template-selected-item">
                                <p class="title">#@{{ id }} @{{ title }}</p>
                                <p class="time text-success">@{{ time }}</p>
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-info btn-timer" data-time="0" data-campain_id="{{ $campain->id }}" data-id="@{{ id }}" data-toggle="tooltip" data-title="Đặt lịch"><i class="fa fa-clock-o"></i></button>
                                    <button class="btn btn-xs btn-danger btn-delete" data-id="@{{ id }}" data-toggle="tooltip" data-title="Xóa"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                        </script>

                        <script type="text/template" id="tpl-email-template">
                            <button type="button" data-id="@{{ id }}" data-title="@{{ title }}" class="btn btn-sm btn-default btn-action-select-template-email" style="margin-bottom: 5px;">
                                #@{{ id }} @{{ title }}
                            </button>
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('script')
<script type="text/javascript">
    $(function() {
        new app.EmailMarketingEditController({
            token: "{{ csrf_token() }}",
            campain_id: {{ $campain->id }}
        }).init();
    });
</script>
@stop