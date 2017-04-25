<?php
    function showCategoriesForMobile($categories, $parent_id = 0, $navClassFlag = 0)
    {
        $cate_child = array();
        foreach ($categories as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['parent_id'] == $parent_id)
            {
                $cate_child[] = $item;
            }
        }

        if ($cate_child)
        {
            echo '<ul class="'. ($navClassFlag == 0 ? 'nav navbar-nav' : 'dropdown-menu') .'">';
            foreach ($cate_child as $key => $item)
            {
                $navClassFlag ++;
                $hasChild = 0;
                foreach ($categories as $i)
                {
                    // Nếu là chuyên mục con thì hiển thị
                    if ($i['parent_id'] == $item->id)
                    {
                        $hasChild = 1;
                    }
                }

                if($hasChild) {
                    $attrToggleDropdown = 'data-toggle="dropdown" class="dropdown-toggle"';
                    $caret = ' <span class="caret"></span>';
                } else {
                    $attrToggleDropdown = '';
                    $caret = '';
                }

                // Hiển thị tiêu đề chuyên mục
                echo '<li class="'. ($hasChild == 0 ? '' : 'dropdown') .'">';
                    echo '<a '. $attrToggleDropdown .' href="'. $item->getUrl() .'">'. $item->getName() . $caret .'</a>';
                    // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                    showCategoriesForMobile($categories, $item['id'], $navClassFlag);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
?>
<nav class="navbar navbar-default fixed-nav">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">9119</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @php showCategoriesForMobile($GLB_Categories, 0); @endphp
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>