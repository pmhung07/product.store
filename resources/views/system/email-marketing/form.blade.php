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
<form class="form" method="POST" id="form-main">
    <div class="form-group {{ hasValidator('name') }}">
        <label class="control-label">Tên chiến dịch</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" required>
        {!! alertError('name') !!}
    </div>

    <div class="row">
        <div class="col-sm-5">
            <div class="panel panel-primary">
                <div class="panel-heading">Chọn mẫu email</div>
                <div class="panel-body">
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
                    {{-- @for($i = 0; $i < 5; $i ++)
                        <div class="email-template-selected-item">
                            <p class="title">#1 Lorem tuyet voi</p>
                            <p class="time text-success">24/10/2018 10:00</p>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info btn-timer" data-toggle="tooltip" title="Đặt lịch"><i class="fa fa-clock-o"></i></button>
                                <button class="btn btn-xs btn-danger btn-delete" data-toggle="tooltip" title="Xóa"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </div>
                    @endfor
                    <div class="email-template-selected-item">
                        <p class="title">#1 Lorem tuyet voi</p>
                        <p class="time text-success">Ngay bây giờ</p>
                        <div class="btn-group">
                            <button class="btn btn-xs btn-info" data-toggle="tooltip" data-title="Đặt lịch"><i class="fa fa-clock-o"></i></button>
                            <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-title="Xóa"><i class="fa fa-trash-o"></i></button>
                        </div>
                    </div> --}}
                </div>
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


<script id="tpl-email-selected" type="text/template">
    <div id="selected-item-id-@{{ id }}" class="email-template-selected-item">
        <p class="title">#@{{ id }} @{{ title }}</p>
        <p class="time text-success">@{{ time }}</p>
        <div class="btn-group">
            <button class="btn btn-xs btn-info btn-timer" data-id="@{{ id }}" data-toggle="tooltip" data-title="Đặt lịch"><i class="fa fa-clock-o"></i></button>
            <button class="btn btn-xs btn-danger btn-delete" data-id="@{{ id }}" data-toggle="tooltip" data-title="Xóa"><i class="fa fa-trash-o"></i></button>
        </div>
    </div>
</script>