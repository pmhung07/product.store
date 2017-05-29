@extends('layout/admin/index')

@section('styles')
<style type="text/css">
    .item > div{
        border: 1px solid #d4d4d4;
        padding: 3px;
        margin: 2px;
        background: #f5f5f5;
        cursor: pointer;
    }
    ul, .list-unstyled {
        list-style: none;
        padding-left: 30px;
    }
</style>
@stop

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>
                Thiết kế menu
                <a class="pull-right btn-xs btn-primary" href="{{ route('system.navigation.index') }}">Quay lại</a>
            </h2>
        </div>
    </div>
@stop

{{-- Page content --}}
@section('content')
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-10">
            <?php
                function showCategories($categories, $parent_id = 0, $first = 0)
                {
                    // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
                    $cate_child = array();
                    foreach ($categories as $key => $item)
                    {
                        // Nếu là chuyên mục con thì hiển thị
                        if ($item['parent_id'] == $parent_id)
                        {
                            $cate_child[] = $item;
                            // unset($categories[$key]);
                        }
                    }

                    // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
                    if ($cate_child)
                    {
                        $class = ($first == 0 ? 'sortable' : '');
                        $first ++;
                        echo '<ul class="list-unstyled '. $class .'">';
                        foreach ($cate_child as $key => $item)
                        {
                            // Hiển thị tiêu đề chuyên mục
                            echo '<li id="menu_item_'.$item->getId().'" class="item">
                                    <div>
                                        <a class="editable" data-name="label" data-level="'.$item->level.'" data-pk="'.$item->id.'" data-type="text">'.$item['label'].'</a>
                                    </div>
                                    ';

                            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                            showCategories($categories, $item['id'], 1);
                            echo '</li>';
                        }
                        echo '</ul>';
                    }
                }

                showCategories($menus);
            ?>
            </div>
            <div class="col-sm-2">
                @if($menus->count())
                    <button id="submit" type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                @endif
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script type="text/javascript">
     $(document).ready(function(){

        $('.sortable').nestedSortable({
            handle: 'div',
            items: 'li',
            toleranceElement: '> div',
            listType: 'ul',
            maxLevels: 2
        });


        $('.editable').editable({
            showbuttons : true,
            url : '{{ route('system.navigation.ajax.editable') }}',
            params : {
               _token : '{{ csrf_token() }}'
            }
        });

        $('#submit').on('click', function(e) {
            e.preventDefault();
            var data = $('.sortable').nestedSortable('serialize');
            $.ajax({
                url : "{{ route('system.navigation.design') }}",
                type : "POST",
                data : {
                    menu_item : data,
                    _token : "{{ csrf_token() }}"
                },
                success : function(response) {
                    if(response.code == 1) {
                        window.location.reload();
                    }
                }
            })
        });

    });
</script>
@endsection