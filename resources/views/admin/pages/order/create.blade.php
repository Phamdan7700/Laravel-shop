@extends('admin.layout.layout')
@section('title', 'Slider')

@section('content')
    <h1 class="mt-4">Slider</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">Slider</a></li>
        <li class="breadcrumb-item active">Tạo mới</li>
    </ol>
    <div class="container">
        <form action="{{ route('admin.slider.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                {{--  --}}
                <div class="form-group mb-3">
                    <label for="thumbnail" class="form-label">Hình ảnh</label>
                    <div class="input-group mb-3">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fas fa-image"></i> Chọn tệp
                        </a>
                        <input type="text" name="thumbnail" id="thumbnail" value="{{ old('thumbnail') }}"
                            class="form-control" accept="image/*">
                    </div>
                    @error('thumbnail')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div id="holder" style="margin-top:15px"></div>
                </div>
                {{--  --}}

            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
