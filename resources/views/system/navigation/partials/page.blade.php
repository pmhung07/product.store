<h4>Trang tĩnh</h4>

@include('system/navigation/partials/general-control')

<div class="form-group {{ hasValidator('object_id') }}">
    <label class="control-label"><b class="text-danger">*</b> Trang tĩnh</label>
    <input type="text" id="keyword" name="object_id" class="form-control" placeholder="Tìm một trang tĩnh">
    {!! alertError('object_id') !!}
</div>

@section('script')
<script type="text/javascript">
    $(function() {
        $('#keyword').tokenInput('{{ route('system.navigation.ajax.searchPage') }}', {
            method: 'GET',
            queryParam: 'q',
            tokenLimit: 1
        });

        @if($menu->getId() > 0 && $menu->getType() == App\Models\Navigation::TYPE_PAGE)
            <?php
                $page = App\ShopPage::find($menu->getObjectId());
            ?>
            @if($page)
                $('#keyword').tokenInput('add', {
                    id: {{ $page->getId() }},
                    name: '{{ $page->getTitle() }}'
                });
            @endif
        @endif
    });
</script>
@endsection
