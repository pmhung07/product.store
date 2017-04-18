<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn"><i class="fa fa-bars"></i> </a>
            <a href="system/channel/index" class="minimalize-styl-2 btn"><i class="fa fa-cogs"></i> Cài đặt </a>
            <a style="background-color: #4e5863;border-color: #4e5863;color: #dcf1ff;border-right: solid 1px #677d90;" href="system/orders/index?filter-order-status=0" class="minimalize-styl-2 btn"><i class="fa fa-undo"></i> 
            	Đơn chờ duyệt <? if(countOrderByStatus(0) != 0){ echo '('.countOrderByStatus(0).')'; } ?>             
            </a>
            <a style="background-color: #4e5863;border-color: #4e5863;color: #dcf1ff;" href="system/orders/index?filter-order-status=2" class="minimalize-styl-2 btn"><i class="fa fa-truck"></i> 
                Vận chuyển <? if(countOrderByStatus(2) != 0){ echo '('.countOrderByStatus(2).')'; } ?>
            </a>
            <a class="minimalize-styl-2 btn" href="auth/logout">
                <i class="fa fa-sign-out"></i> Đăng xuất
            </a>
        </div>
    </nav>
</div>