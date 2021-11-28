@extends('admin.layout.layout')
@section('title', 'Blog')

@section('content')
    <h1 class="mt-4">Blog</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog</a></li>
        <li class="breadcrumb-item active">Tạo mới</li>
    </ol>
    <div class="container">
        <form action="{{ route('admin.blog.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title"
                        aria-describedby="title">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="summary" class="form-label">Tóm tắt</label>
                    <input type="text" name="summary" value="{{ old('summary') }}" class="form-control" id="summary"
                        aria-describedby="summary">
                    @error('summary')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="content" class="form-label">Nội dung</label>
                    <textarea name="content" class="form-control summernote">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <div class="input-group mb-3">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fas fa-image"></i> Chọn tệp
                        </a>
                        <input type="text" name="thumbnail" id="thumbnail" value="{{ old('thumbnail') }}" disabled
                            class="form-control" accept="image/*">
                    </div>
                    @error('thumbnail')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div id="holder" style="margin-top:15px"></div>
                </div>

                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" name="status" value="1" checked role="switch"
                        id="status">
                    <label class="form-check-label" for="status">Disable/ Active </label>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
