@extends('admin.layout.layout')
@section('title', 'Danh mục')

@section('content')
    <h1 class="mt-4">Danh mục</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Danh mục</li>
    </ol>
    <div class="container">
        <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Danh mục</label>
                <input type="text" name="title" value="{{ $category->title }}" class="form-control" id="title" aria-describedby="title">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
