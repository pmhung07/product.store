<div class="form-group">
    <label class="control-label">Menu cha</label>
    <select class="form-control" name="parent_id">
        <option value="">Chọn menu cha</option>
        @foreach($menus as $item)
            <option value="{{ $item->getId() }}" {{ $menu->getParentId() == $item->getId() ? 'selected' : '' }}><?php for($i = 0; $i < $item->level; $i ++) echo '--'; ?>{{ $item->getLabel() }}</option>
        @endforeach
    </select>
</div>

<div class="form-group {{ hasValidator('label') }}">
    <label class="control-label"><b class="text-danger">*</b> Nhãn</label>
    <input type="text" name="label" value="{{ old('label', $menu->getLabel()) }}" class="form-control">
    {!! alertError('label') !!}
</div>