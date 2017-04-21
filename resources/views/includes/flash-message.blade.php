@if (count($errors) > 0)
<div class="ibox-content">
    <div class="alert alert-danger" style="margin-bottom:0px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif


@if (Session::has('flash_message'))
    <div class="ibox-content">
        <div class="alert alert-success"  style="margin-bottom:0px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!! Session::get('flash_message') !!}
        </div>
    </div>
@endif

@if (Session::has('success'))
    <div class="ibox-content">
        <div class="alert alert-success"  style="margin-bottom:0px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!! Session::get('success') !!}
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div class="ibox-content">
        <div class="alert alert-error"  style="margin-bottom:0px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!! Session::get('error') !!}
        </div>
    </div>
@endif