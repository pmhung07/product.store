<form class="form" method="POST">
    <div class="form-group {{ hasValidator('title') }}">
        <label class="control-label">Tiêu đề</label>
        <input type="text" name="title" class="form-control" value="{{ $item->title }}">
    </div>
    <div class="form-group {{ hasValidator('content') }}">
        <label class="control-label">Nội dung</label>
        <textarea name="content" class="form-control tiny-editor">{{ $item->content }}</textarea>
    </div>
    <div class="form-group">
        {!! csrf_field() !!}
        <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
    </div>
</form>