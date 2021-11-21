@extends('admin.layout.layout')
@section('title', 'Sản phẩm')

@section('content')
    <h1 class="mt-4">Sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Sản phẩm</li>
    </ol>
    <div class="container">
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-9">
                    <div class="mb-3">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Tên sản phẩm</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Nhập tên sản phẩm, ví dụ: Samsung S20">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="content" class="form-label">Thông tin sản phẩm</label>
                            <textarea name="content" class="form-control summernote">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="detail" class="form-label">Thông số kỹ thuật</label>
                            <textarea name="detail" class="form-control summernote">{{ old('detail') }}</textarea>
                            @error('detail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="img_list" class="form-label">Hình ảnh</label>
                            <input type="file" name="img_list" value="{{ old('img_list') }}" class="form-control" multiple>
                            @error('img_list')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" name="status" value="1"
                            checked role="switch" id="status">
                            <label class="form-check-label" for="status">Active / Inactive</label>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label for="category_id" class="form-label">Danh mục</label>
                        <select name="category_id" class="form-select">
                            <option {{ old('category_id')? '' : 'selected' }} disabled>--Chọn danh mục--</option>
                            @foreach ($categoryList as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : null }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach

                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <label for="price" class="form-label" >Giá</label>
                    <div class="input-group mb-3">
                        <input type="number" name="price" value="{{ old('price') }}" class="price form-control" placeholder="Ví dụ: 100.000" aria-describedby="price">
                        <span class="input-group-text" id="price">đ</span>
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <label for="price_sale" class="form-label" >Giá khuyến mãi</label>
                    <div class="input-group mb-3">
                        <input type="number" name="price_sale" value="{{ old('price_sale') }}" class="price form-control" placeholder="Ví dụ: 100.000" aria-describedby="price_sale">
                        <span class="input-group-text" id="price_sale">đ</span>
                        @error('price_sale')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="thumbnail" class="form-label" >Hình ảnh</label>
                        <input type="file" name="thumbnail" value="{{ old('thumbnail') }}" class="form-control" accept="image/*">
                        @error('thumbnail')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.price').on('input', function () {
                let input_val = $(this).val();
                $(this).val(input_val.toLocaleString());

            });
        });
    </script>
@endsection
