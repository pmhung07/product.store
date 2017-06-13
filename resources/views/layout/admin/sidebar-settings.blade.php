<div class="col-lg-3">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="file-manager">
                <h5>Cài đặt thông tin</h5>
                <ul class="folder-list m-b-md" style="padding: 0">
                    <li>
                        <a href="/system/channel/index"
                        @if(
                            Request::is('system/channel/*')
                        )  {!! 'style="color: #115c8c;font-weight: 600;"' !!} @endif>
                            <i class="fa fa-rss"></i>
                            Kênh bán hàng
                        </a>
                    </li>
                    <li>
                        <a href="/system/payment-method/index"
                        @if(
                            Request::is('system/payment-method/*')
                        )  {!! 'style="color: #115c8c;font-weight: 600;"' !!} @endif>
                            <i class="fa fa-money"></i>
                            Phương thức thanh toán
                        </a>
                    </li>
                    <li>
                        <a href="/system/units/index"
                        @if(
                            Request::is('system/units/*')
                        )  {!! 'style="color: #115c8c;font-weight: 600;"' !!} @endif>
                            <i class="fa fa-ticket"></i>
                            Đơn vị đo sản phẩm
                        </a>
                    </li>
                    <li>
                        <a href="/system/supplier/index"
                        @if(
                            Request::is('system/supplier/*')
                        )  {!! 'style="color: #115c8c;font-weight: 600;"' !!} @endif>
                            <i class="fa fa-briefcase"></i>
                            Nhà cung cấp
                        </a>
                    </li>
                    <li>
                        <a href="/system/position/index"
                        @if(
                            Request::is('system/position/*')
                        )  {!! 'style="color: #115c8c;font-weight: 600;"' !!} @endif>
                            <i class="fa fa fa-sitemap"></i>
                            Chức vụ nhân viên
                        </a>
                    </li>
                    <!--<li>
                        <a href="/system/permissions/index"
                        @if(
                            Request::is('system/permissions/*')
                        )  {!! 'style="color: #115c8c;font-weight: 600;"' !!} @endif>
                            <i class="fa fa-unlock-alt"></i>
                            Cấu hình phân quyền
                        </a>
                    </li>-->
                    <li>
                        <a href="{{ route('system.emailTemplate.index') }}" {{ Request::is('system/email-template/*') ? 'style="color: #115c8c;font-weight: 600;"' : '' }}>
                            <i class="fa fa fa-inbox"></i>
                            Mẫu Email
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>