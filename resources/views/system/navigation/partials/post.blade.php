<h4>Tin tức</h4>

@include('system/navigation/partials/general-control')

<div class="form-group {{ hasValidator('object_id') }}">
    <label class="control-label"><b class="text-danger">*</b> Tin tức</label>
    <input type="text" id="keyword" name="object_id" class="form-control" placeholder="Tìm một tin tức">
    {!! alertError('object_id') !!}
</div>

@section('script')
<script type="text/javascript">
    $(function() {
        $('#keyword').tokenInput('{{ route('system.navigation.ajax.searchPost') }}', {
            method: 'GET',
            queryParam: 'q',
            tokenLimit: 1
        });

        @if($menu->getId() > 0 && $menu->getType() == App\Models\Navigation::TYPE_POST)
            <?php
                $post = App\ShopPost::find($menu->getObjectId());
            ?>
            @if($post)
                $('#keyword').tokenInput('add', {
                    id: {{ $post->getId() }},
                    name: '{{ $post->getTitle() }}'
                });
            @endif
        @endif
    });
</script>
@endsection
