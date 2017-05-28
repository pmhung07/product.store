<form class="" method="POST" action="">
    <div class="row">
        <div class="col-sm-3">
            <h4>Loại danh mục</h4>
            <div class="list-group">
                @foreach(App\Models\Navigation::getTypeOptions() as $key => $value)
                    <?php
                        $url = route('system.navigation.create', ['type' => $key]);
                        if($menu->getId() > 0) {
                            $url = route('system.navigation.edit', [$menu->getId(), 'type' => $key]);
                        }
                    ?>
                    <a href="{{ $url }}" class="list-group-item {{ $type == $key ? 'active' : '' }}">{{ $value }}</a>
                @endforeach
            </div>
        </div>

        <div class="col-sm-9">
            @if($type == App\Models\Navigation::TYPE_CUSTOM)
                @include('system/navigation/partials/custom')
            @elseif($type == App\Models\Navigation::TYPE_POST)
                @include('system/navigation/partials/post')
            @elseif($type == App\Models\Navigation::TYPE_POST_CATEGORY)
                @include('system/navigation/partials/post-category')
            @elseif($type == App\Models\Navigation::TYPE_PAGE)
                @include('system/navigation/partials/page')
            @endif

            <div class="form-group">
                {!! csrf_field() !!}
                <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
            </div>
        </div>
    </div>
</form>