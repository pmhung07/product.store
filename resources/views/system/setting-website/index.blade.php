@extends('layout.admin.index')

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2><i class="fa fa-list"></i> Cấu hình website</h2>
        </div>
    </div>
@stop

@section('content')

<div class="row">
    <div class="col-xs-12 animated">

        @include('includes/flash-message')

        <div class="ibox-content m-b-sm border-bottom">
            <form class="form" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Thông tin website</b></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <div>
                                        <img src="{{ parse_image_url('sm_'.$setting->logo) }}" onerror="this.src='/img/default_picture.png'" height="50">
                                        <input type="file" name="logo" class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>
                                        Favicon (*.png)
                                    </label>
                                    <div>
                                        <img src="{{ parse_image_url('sm_'.$setting->favicon) }}" onerror="this.src='/img/default_picture.png'" height="50">
                                        <input type="file" name="favicon" class="form-control input-sm" accept="image/png">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Tên công ty</label>
                                    <input type="text" name="company_name" value="{{ $setting->company_name }}" class="form-control input-sm">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label>Tỉnh/Thành phố - Quận/Huyện</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="province_id" id="province_id" class="form-control input-sm">
                                                <option value="">Chọn tỉnh/Thành phố</option>
                                                @foreach($provinces as $item)
                                                    <option value="{{ $item->id }}" {{ $item->id == $setting->province_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="district_id" id="district_id" class="form-control input-sm">
                                                <option value="">Chọn Quận/Huyện</option>
                                                @foreach($districts as $item)
                                                    <option value="{{ $item->id }}" {{ $item->id == $setting->district_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Trụ sở chính</label>
                                    <input type="text" name="address" value="{{ $setting->address }}" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Thông tin liên hệ</b></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" name="phone" value="{{ $setting->phone }}" class="form-control input-sm">
                                </div>
                                <div class="form-group">
                                    <label>Mail</label>
                                    <input type="text" name="mail" value="{{ $setting->mail }}" class="form-control input-sm">
                                </div>
                                <div class="form-group">
                                    <label>Skype</label>
                                    <input type="text" name="skype" value="{{ $setting->skype }}" class="form-control input-sm">
                                </div>
                                <div class="form-group">
                                    <label>Yahoo</label>
                                    <input type="text" name="yahoo" value="{{ $setting->yahoo }}" class="form-control input-sm">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Kết nối mạng xã hội</b></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input type="text" name="facebook" value="{{ $setting->facebook }}" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label>Google+</label>
                                            <input type="text" name="google" value="{{ $setting->google }}" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label>Youtube</label>
                                            <input type="text" name="youtube" value="{{ $setting->youtube }}" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label>Twitter</label>
                                            <input type="text" name="twitter" value="{{ $setting->twitter }}" class="form-control input-sm">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Pinterest</label>
                                            <input type="text" name="pinterest" value="{{ $setting->pinterest }}" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label>LinkedIn</label>
                                            <input type="text" name="linkedin" value="{{ $setting->linkedin }}" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label>Tumblr</label>
                                            <input type="text" name="tumblr" value="{{ $setting->tumblr }}" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label>Instagram</label>
                                            <input type="text" name="instagram" value="{{ $setting->instagram }}" class="form-control input-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>SEO</b></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Meta title</label>
                                    <input type="text" name="meta_title" value="{{ $setting->meta_title }}" class="form-control input-sm">
                                </div>
                                <div class="form-group">
                                    <label>Meta keyword</label>
                                    <input type="text" name="meta_keyword" value="{{ $setting->meta_keyword }}" class="form-control input-sm">
                                </div>
                                <div class="form-group">
                                    <label>Meta description</label>
                                    <input type="text" name="meta_description" value="{{ $setting->meta_description }}" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Scripts</b></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Mã</label>
                                    <textarea class="form-control" name="embed_code">{!! $setting->embed_code !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-md btn-primary">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('script')
<script type="text/javascript">
$(function() {
    $('#province_id').ajaxLoadDistrict({
        observers: '#district_id'
    });
});
</script>

@stop
