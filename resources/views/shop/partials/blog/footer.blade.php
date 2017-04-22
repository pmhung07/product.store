    </div>
        <a rel="nofollow" title="Về đầu trang" id="back-top" href="javascript:void(0)" class="seoquake-nofollow"><i class="fa fa-caret-up"></i> Về đầu trang</a>
        <footer>
            <div class='footer'>
                <div class='container'>
                    <div class='menu-foot hidden-xs'>
                        <ul>
                            @foreach($GLB_PostCategories as $item)
                                <li>
                                    <a href="{{ $item->getUrl() }}">{{ $item->getName() }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <a title="Trang shop JUNO" id="home-foot" href="/" target="_blank" ><i class="fa fa-home"></i> Trang shop JUNO</a>
                    </div>
                    <div class='row foot'>
                        <div class='col-md-5 col-sm-10 col-xs-10'>
                            <div class='files'>
                                <ul>
                                    <li><a href="">Giới thiệu</a></li>
                                    <li><a href="">Liên hệ</a></li>
                                    <li><a href="">Site map</a></li>
                                </ul>
                            </div>
                            <div class='coppyright'>
                                <p>
                                    @2015 Công ty cổ phần sản xuất thương mại dịch vụ 9119
                                </p>
                                <p>
                                    Địa chỉ văn phòng chính: 313 Nguyễn Thị Thập, Q.7, TP.HCM
                                </p>
                            </div>
                        </div>
                        <div class='col-md-4 col-sm-10 col-xs-10 pull-right'>
                            <div class='form-mail'>
                                <p>
                                    Hãy đăng ký mail của bạn để chúng tôi gửi những thông tin cập nhật mới nhất
                                </p>
                                <form accept-charset='UTF-8' action='https://juno.vn/account/contact' class='contact-form' method='post'>
                                    <input name='form_type' type='hidden' value='customer'>
                                    <input name='utf8' type='hidden' value='✓'>
                                    <input type="hidden" id="contact_tags" name="contact[tags]" value="khách hàng tiềm năng, bản tin" />
                                    <input name="contact[email]" type="email" id="contact_email" placeholder="Nhập email của bạn" required="required" />
                                    <input type='submit' value=''>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='link'>
                <div class='container'>
                    <div class='link-top'>
                        <ul>
                            <li class='fa'><a href=''><img src='https://hstatic.net/288/1000046288/1000069273/face.jpg?v=72' alt=''  /></a></li>
                            <li class='tt'><a href=''><img src='https://hstatic.net/288/1000046288/1000069273/tt.jpg?v=72' alt=''  /></a></li>
                            <li class='gg'><a href=''><img src='https://hstatic.net/288/1000046288/1000069273/gg.jpg?v=72' alt=''  /></a></li>
                            <li class='yt'><a href=''><img src='https://hstatic.net/288/1000046288/1000069273/yt.jpg?v=72' alt=''  /></a></li>
                        </ul>
                    </div>
                    <div class='link-bottom'>
                        <ul>
                            @foreach($GLB_Categories as $item)
                                <li><a href="{{ $item->getUrl() }}">{{ $item->getName() }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <script>
            $(window).load(function() {
                $('.cms-index-index').removeClass('bodyOnload');
            })
            $(document).ready(function(){
                if(window.location.href=='//juno.vn/black-friday')
                {

                    window.location = "/pages/black-friday";
                }
                $("#owl-blog-slider").owlCarousel({
                    pagination : true,
                    navigation : true,
                    navigationText:["<i class=\"insert-left\"><\/i>","<i class=\"insert-right\"><\/i>"],
                    autoPlay: 8000,
                    items :1,
                    itemsDesktop : [1024,1],
                    itemsDesktopSmall : [967,1],
                    itemsTablet: [600,1],
                });
                $('#owl-insert-slider').owlCarousel({
                    pagination : false,
                    navigation : true,
                    items :4,
                    navigationText:["<i class=\"insert-left\"><\/i>","<i class=\"insert-right\"><\/i>"],
                    itemsDesktop : [1024,3],
                    itemsDesktopSmall : [967,2],
                    itemsTablet: [600,1],
                    itemsMobile : [600,1]
                });
                var maxheight=200;
                $('.list-r > .row > .one-r').each(function(){
                    if($(this).height() > maxheight)
                    {
                        maxheight=$(this).height();
                    }
                });
                $('.one-r').css("height",maxheight);
                var heightbody=$(window).height()-$('.footer').height();
                var heightfooter=$('footer').height();
                $(window).scroll(function(){
                    if( $(window).scrollTop() < 200  ) {
                        $('#back-top').stop(false,true).fadeOut(600);
                    }
                    else{
                        $('#back-top').stop(false,true).fadeIn(600);
                    }
                    if($(document).height() - $(window).scrollTop() - $(window).height() < $('footer').height() - 30 ){
                        $('#back-top').css('bottom',$('footer').height() - 17);
                    }else{
                        $('#back-top').css('bottom', '45px');
                    }
                });
                $('#back-top').click(function(){
                    $('body,html').animate({scrollTop:0},600);
                    return false;
                });
                $('.wrapper').on("click",".share .share-icon",function(){
                    $(this).parent().next('.content').slideToggle(500);
                })
                $('.topsearch').each(function(){
                    $(this).submit(function() {
                        window.location = '/search?type=article&q=filter=((blogid:article=-1000009307)(title:article**' + $('input[name=q]', this).val() +')||(body:article**'+$('input[name=q]', this).val()+'))&view=articles';
                        return false;
                    });
                });
            })
        </script>
        <script>
            var check_drop = true;
            timeOutMenu = setTimeout(function(){
                if (check_drop) {
                    $('.drop-menu').stop().slideUp(200);
                    //$(this).removeClass('active');
                    //$(this).parent('li').removeClass('drop').children('.drop-menu').stop().slideUp(200);
                }
            },500);
            $('.menu-top > li > a').hover(
                function(){
                    clearTimeout(timeOutMenu);
                    $('.menu-top > li > a:not(.main)').removeClass('active');
                    $(this).addClass('active');
                    $('.drop-menu').stop().slideUp(200);
                    $(this).parent('li').addClass('drop').children('.drop-menu').slideDown(200);
                },
                function(){
                    if ( $('.menu-top > li > a.main').length == 0 && $(this).parent('li.hasChild').length == 0 ) {
                        $(this).removeClass('active');
                    }
                    if ( $(this).parent('li:not(.hasChild)').length == 1 && $('.menu-top > li > a.main').length == 1 ) {
                        $(this).not('.main').removeClass('active');
                    }
                }
            );
            $('.drop-menu').hover(
                function() {
                    check_drop = false;
                },
                function() {
                    if ( $(this).parent('li').children('a:not(.main)') ) {
                        $(this).parent('li').children('a:not(.main)').removeClass('active');
                    }
                    check_drop = true;
                    $(this).stop().slideUp(200);
                }
            );
        </script>
    </body>
</html>