@extends('admin.layout.layout')
@section('title', 'Blog')

@section('content')
    <h1 class="mt-4">Blog</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog</a></li>
        <li class="breadcrumb-item active">Tạo mới</li>
    </ol>
    <div class="container">
        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" name="title" value="{{ $blog->title }}" class="form-control" id="title"
                        aria-describedby="title">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="summary" class="form-label">Tóm tắt</label>
                    <input type="text" name="summary" value="{{ $blog->summary }}" class="form-control" id="summary"
                        aria-describedby="summary">
                    @error('summary')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="content" class="form-label">Nội dung</label>
                    <textarea name="content" class="form-control summernote">{{ $blog->content }}</textarea>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <div>
                        <img src="{{ $blog->thumbnail }}" alt="thumnail" class="img-thumbnail" width="100" height="100">
                    </div>
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <div class="input-group mb-3">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fas fa-image"></i> Chọn tệp
                        </a>
                        <input type="text" name="thumbnail" id="thumbnail"
                            class="form-control">
                    </div>
                    @error('thumbnail')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div id="holder" style="margin-top:15px"></div>
                </div>

                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" name="status" value="1"
                        {{ $blog->status ? 'checked' : null }} role="switch" id="status">
                    <label class="form-check-label" for="status">Disable/ Active </label>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
