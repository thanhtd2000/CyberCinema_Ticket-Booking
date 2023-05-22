@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <form class="col-md-8" action="{{ route('posts.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $post->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="title" aria-describedby="emailHelp"
                value="{{ $post->title }}">
        </div>
        <div class="error">
            @if ($errors->has('title'))
                <span class="text-danger fs-5">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nội dung</label>
            <textarea name="content" id="editor">{{ $post->content }}</textarea>
        </div>
        <div class="error">
            @if ($errors->has('content'))
                <span class="text-danger fs-5">
                    {{ $errors->first('content') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ảnh</label>
            <input type="file" class="form-control" id="exampleInputEmail1" name="image" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Thêm ảnh hiển thị đại diện</div>
        </div>
        <div class="error">
            @if ($errors->has('image'))
                <span class="text-danger fs-5">
                    {{ $errors->first('image') }}
                </span>
            @endif
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
    <script src={{ url('ckeditor/ckeditor.js') }}></script>
    <script>
        CKEDITOR.replace('editor', {
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}',
        });
    </script>
@endsection
