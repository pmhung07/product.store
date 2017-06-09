            <div class="footer-map container-fluid wow fadeIn">
                <div class="row">
                    <div class=" col-lg-12 col-md-12 button-store">
                        <a class="store-footer" target="_blank" href="/">Mời bạn xem địa chỉ hệ thống cửa hàng</a>
                    </div>
                </div>
            </div>
            <footer >
                <div class="5icons wow fadeIn" style="background:#e5e5e5">
                    <div class="">
                        <div class="bottom">
                            <div class="container">
                                <div class="row">
                                    <ul class="menu_footer">
                                        <?php foreach($GLB_Categories as $item): ?>
                                            <?php if($item->parent_id > 0) continue; ?>
                                            <li class="col-xs-6 col-sm-3 col-md-3 col-lg-2">
                                                <a class="link" href="{{ $item->getUrl() }}" title="{{ $item->name }}">
                                                    <img class="image" src="{{ parse_image_url($item->icon) }}" alt="{{ $item->name }}" class="img-responsive" />
                                                    <span class="label_footer">{{ $item->getName() }}</span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="signUp wow fadeIn" style="background:#fff">
                    <div class="">
                        <div class="container">
                            <div class="row" style="padding-top:20px;padding-bottom:20px">
                                <div class="wrap_foo_switchboard col-md-6 col-lg-6 col-sm-10 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-5 col-xs-12 footer-colsystem">
                                            <div class="icon_phone">
                                                <img src="/shop/assets/hstatic.net/969/1000003969/1000161857/icon_phone_circle.jpg%3Fv=8910" />
                                            </div>
                                            <div class="phone_footer">
                                                <strong>Gọi mua hàng(8:30-21:30)</strong>
                                                <br>
                                                <span class="number_phone">{{ $GLB_Setting->phone }}</span>
                                                <span class="moreinfo">Tất cả các ngày trong tuần</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-6 col-sm-6 col-xs-12 footer-colsystem">
                                            <div class="icon_phone">
                                                <img src="/shop/assets/hstatic.net/969/1000003969/1000161857/icon_phone_circle.jpg%3Fv=8910" />
                                            </div>
                                            <div class="phone_footer">
                                                <strong>Góp ý, khiếu nại(8:30-21:30)</strong>
                                                <br>
                                                <span class="number_phone">{{ $GLB_Setting->phone }}</span>
                                                <span class="moreinfo">Nghỉ chiều thứ 7, Chủ nhật, ngày lễ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap_foo_social col-md-6 col-lg-6 col-sm-10 col-xs-12">
                                    <div class="row">
                                        <div class="wrapper_embed col-sm-6 col-xs-12">
                                            <div class="ttmail">
                                                <span>
                                                <strong>đăng ký nhận thông tin mới</strong>
                                                </span>
                                            </div>
                                            <div id="mc_embed_signup" style="margin-bottom: 10px;">
                                                <form action="https://juno.us8.list-manage.com/subscribe/post?u=c6a1ff4613972aee4c6da0254&amp;id=380ebe08a5" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                                    <div id="mc_embed_signup_scroll">
                                                        <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Nhập email của bạn tại đây..." required>
                                                        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                                        <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                                            <input type="text" name="b_c6a1ff4613972aee4c6da0254_380ebe08a5" tabindex="-1" value="">
                                                        </div>
                                                        <div class="clear">
                                                            <input type="submit" value="Đăng ký" name="subscribe" id="mc-embedded-subscribe" class="button" style="background:#3c3c3c;border:1px solid #3c3c3c !important">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="social col-sm-6 col-xs-12">
                                            <p class="title-md-footer">
                                                <strong>Mạng xã hội</strong>
                                            </p>
                                            <ul class="navbar-social">
                                                <li class="social-face">
                                                    <a href="{{ $GLB_Setting->facebook }}" target="_blank" rel="nofollow">
                                                    <i class="fa fa-facebook-official" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $GLB_Setting->instagram }}" target="_blank" rel="nofollow">
                                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $GLB_Setting->youtube }}" target="_blank" rel="nofollow">
                                                    <i class="fa fa-youtube" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid fooMenu hide" style="background:#f4f4f4">
                    <div class="">
                        <div class="top">
                            <div class="container">
                                <div class="row">
                                    <ul class="instuction_footer">
                                        <li><a href="" title="Hướng dẫn chọn cỡ giày">Tin tức, khuyến mãi</a></li>
                                        <li><a href="" title="Hướng dẫn chọn cỡ giày">Hướng dẫn chọn cỡ giày</a></li>
                                        <li><a href="" title="Chính sách khách hàng thân thiết">Chính sách khách hàng thân thiết</a></li>
                                        <li><a href="" title="Chính sách đổi trả">Chính sách Đổi/Trả</a></li>
                                        <li><a href="" title="Thanh toán giao nhận">Thanh toán giao nhận</a></li>
                                        <li><a href="" title="Chính sách bảo mật">Chính sách bảo mật</a></li>
                                        <li><a href="" title="Giới thiệu; Liên hệ...">Các thông tin khác</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <div class="back-to-top">
                <a href="javascript:void(0);">Top</a>
            </div>
        </div><!-- End wrapper -->

        <!--QV-->
        <div id="quickView" class="modal fade" role="dialog" style="background: rgba(0, 0, 0, 0.5); z-index: 999999;">
            <div class="modal-dialog">
                <!-- Modal content-->
            </div>
        </div>
        <!--end QV-->

        <script type="text/javascript">
            $(function() {
                var productId = 0;
                $('.quick-view').click(function() {
                    productId = $(this).data('id');
                    $('#quickView').modal('show');
                });

                $('#quickView').on('show.bs.modal', function() {
                    var $this = $(this);
                    $.ajax({
                        url: '/ajax/product/quick-view',
                        type: 'GET',
                        dataType: 'html',
                        data: {
                            product_id : productId
                        },
                        success: function(response) {
                            $('#quickView').find('.modal-dialog').html(response);
                        }
                    });
                });
            });
        </script>


        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/593ac58e4374a471e7c5247e/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
    </body>
</html>