@extends('admin.layout.layout')
@section('title', 'Sản phẩm')

@section('content')
    <h1 class="mt-4">Sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{ route('admin.product.index') }}">Sản phẩm</a></li>
        <li class="breadcrumb-item active">Tạo mới</li>
    </ol>
    <div class="container">
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-9">
                    <div class="mb-3">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Tên sản phẩm</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Ví dụ: Samsung S20">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="manufacturer" class="form-label">Hãng sản xuất</label>
                            <input type="text" name="manufacturer" value="{{ old('manufacturer') }}" class="form-control" placeholder="Ví dụ: Samsung ">
                            @error('namanufacturerme')
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
                            <div class="input-group">
                                <a id="" data-input="img_list" data-preview="img_list_preview" class="btn btn-primary lfm">
                                    <i class="fas fa-image"></i> Chọn tệp
                                </a>
                                <input type="text" name="img_list" id="img_list" value="{{ old('img_list') }}" class="form-control">
                                @error('img_list')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @error('img_list')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div id="img_list_preview" style="margin-top:15px"></div>
                        </div>

                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" name="status" value="1"
                            checked role="switch" id="status">
                            <label class="form-check-label" for="status">Disable/ Active </label>
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
                    </div>
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label for="price_sale" class="form-label" >Giá khuyến mãi</label>
                    <div class="input-group mb-3">
                        <input type="number" name="price_sale" value="{{ old('price_sale')?? 0 }}" class="price form-control" placeholder="Ví dụ: 100.000" aria-describedby="price_sale">
                        <span class="input-group-text" id="price_sale">đ</span>
                    </div>
                    @error('price_sale')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <label for="count_in_sock" class="form-label" >Tồn kho</label>
                    <div class="form-group mb-3">
                        <input type="number" name="count_in_sock" value="{{ old('count_in_sock')?? 0 }}" class="price form-control" placeholder="Ví dụ: 100.000" aria-describedby="count_in_sock">
                        @error('count_in_sock')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <label for="thumbnail" class="form-label" >Thumbnail</label>
                    <div class="input-group mb-3">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fas fa-image"></i> Chọn tệp
                        </a>
                        <input type="text" name="thumbnail" id="thumbnail" class="form-control">
                        @error('thumbnail')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div id="holder" style="margin-top:15px"></div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

@endsection

@section('js')

@endsection
