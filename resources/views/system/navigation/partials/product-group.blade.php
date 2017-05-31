<h4>Danh mục sản phẩm</h4>

@include('system/navigation/partials/general-control')

<div class="form-group {{ hasValidator('object_id') }}">
    <label class="control-label"><b class="text-danger">*</b> Danh mục</label>
    <select class="form-control" name="object_id">
        <option value="">Chọn một danh mục</option>
        @foreach($productCategories as $item)
            <option value="{{ $item->getId() }}" {{ $menu->getType() == App\Models\Navigation::TYPE_PRODUCT_GROUP && $menu->getObjectId() == $item->getId() ? 'selected' : '' }}><?php for($i = 0; $i < $item->level; $i ++) echo '--'; ?>{{ $item->getName() }}</option>
        @endforeach
    </select>
    {!! alertError('object_id') !!}
</div>

@section('scripts')
<script type="text/javascript">
    $(function() {
        $('#keyword').tokenInput('{{ route('system.navigation.ajax.searchProductGroup') }}', {
            method: 'GET',
            queryParam: 'q',
            tokenLimit: 1
        });

        @if($menu->getId() > 0 && $menu->getType() == App\Models\Navigation::TYPE_PRODUCT_GROUP)
            <?php
                $productGroup = App\ProductGroup::find($menu->getObjectId());
            ?>
            @if($productGroup)
                $('#keyword').tokenInput('add', {
                    id: {{ $productGroup->getId() }},
                    name: '{{ $productGroup->getName() }}'
                });
            @endif
        @endif
    });
</script>
@endsection