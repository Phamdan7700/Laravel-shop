@extends('admin.layout.layout')
@section('title', 'Danh mục')

@section('content')
    <h1 class="mt-4">Danh mục</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Danh mục</a></li>
        <li class="breadcrumb-item active">Tạo mới</li>
    </ol>
    <div class="container">
        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <div class="form-group">
                    <label for="title" class="form-label">Danh mục</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" aria-describedby="title">
                </div>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" name="status" value="1" checked role="switch" id="status">
                    <label class="form-check-label" for="status">Disable/ Active </label>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
