<h4>Sản phẩm</h4>

@include('system/navigation/partials/general-control')

<div class="form-group {{ hasValidator('object_id') }}">
    <label class="control-label"><b class="text-danger">*</b> Sản phẩm</label>
    <input type="text" id="keyword" name="object_id" class="form-control" placeholder="Tìm một sản phẩm">
    {!! alertError('object_id') !!}
</div>

@section('script')
<script type="text/javascript">
    $(function() {
        $('#keyword').tokenInput('{{ route('system.navigation.ajax.searchProduct') }}', {
            method: 'GET',
            queryParam: 'q',
            tokenLimit: 1
        });

        @if($menu->getId() > 0 && $menu->getType() == App\Models\Navigation::TYPE_PRODUCT)
            <?php
                $product = App\Product::find($menu->getObjectId());
            ?>
            @if($product)
                $('#keyword').tokenInput('add', {
                    id: {{ $product->getId() }},
                    name: '{{ $product->getName() }}'
                });
            @endif
        @endif
    });
</script>
@endsection
