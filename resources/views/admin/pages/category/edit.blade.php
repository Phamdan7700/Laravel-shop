@extends('admin.layout.layout')
@section('title', 'Danh mục')

@section('content')
    <h1 class="mt-4">Danh mục</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Danh mục</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    <div class="container">
        <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <div class="form-group">
                    <label for="title" class="form-label">Danh mục</label>
                    <input type="text" name="title" value="{{ $category->title }}" class="form-control" id="title"
                        aria-describedby="title">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" value="{{ $category->slug }}" class="form-control" id="slug"
                        aria-describedby="slug">
                    @error('slug')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title" class="form-label">Thứ tự</label>
                    <input type="number" name="position" value="{{ $category->position }}" class="form-control" id="position"
                        aria-describedby="position">
                    @error('position')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" name="status" value="1"
                        {{ $category->status ? 'checked' : null }} role="switch" id="status">
                    <label class="form-check-label" for="status">Disable/ Active </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
