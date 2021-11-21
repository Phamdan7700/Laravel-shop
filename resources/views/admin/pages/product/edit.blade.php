
@extends('admin.layout.layout')
@section('title', 'Sản phẩm')

@section('content')
    <h1 class="mt-4">Sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Sản phẩm</li>
    </ol>
    <div class="container">
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST">
            @csrf
            @method("PUT")

            <div class="row">
                <div class="col-md-9">
                    <div class="mb-3">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Tên sản phẩm</label>
                            <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Nhập tên sản phẩm, ví dụ: Samsung S20">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="content" class="form-label">Thông tin sản phẩm</label>
                            <textarea name="content" class="form-control summernote">{{ $product->content}}</textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="detail" class="form-label">Thông số kỹ thuật</label>
                            <textarea name="detail" class="form-control summernote">{{ $product->detail }}</textarea>
                            @error('detail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="img_list" class="form-label">Hình ảnh</label>
                            <input type="text" name="img_list" value="{{ old('img_list') }}" class="form-control">
                            @error('img_list')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" name="status" value="1"
                                {{ $product->status?  'checked': null}} role="switch" id="status">
                            <label class="form-check-label" for="status">Active / Inactive</label>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label for="category_id" class="form-label">Danh mục</label>
                        <select name="category_id" class="form-select">
                            <option selected disabled>Chọn danh mục</option>
                            @foreach ($categoryList as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id === $category->id ? 'selected' : null }}>
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
                        <input type="text" name="price" value="{{ number_format($product->price, 0, '.') }}" class="price form-control" placeholder="Ví dụ: 100.000" aria-describedby="price">
                        <span class="input-group-text" id="price">đ</span>
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <label for="price_sale" class="form-label" >Giá khuyến mãi</label>
                    <div class="input-group mb-3">
                        <input type="text" name="price_sale" value="{{ number_format($product->price_sale, 0, '.') }}" class="price form-control" placeholder="Ví dụ: 100.000" aria-describedby="price_sale">
                        <span class="input-group-text" id="price_sale">đ</span>
                        @error('price_sale')
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
                let input_val = Number($(this).val().replace(/\D/g,''));
                $(this).val(input_val.toLocaleString());

            });
            $('.price').val()
        });
    </script>
@endsection
