@extends('admin.layout.layout')
@section('title', 'Danh mục')

@section('css')
    <style>
        table {
            text-align: center;
        }

        .status {
            min-width: 100px;
        }

    </style>
@endsection
@section('content')
    <h1 class="mt-4">Danh mục</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Danh mục

        </li>
    </ol>
    <div><a class="btn btn-success" href="{{ route('admin.category.create') }}">Tạo mới</a></div>
    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Tổng sản phẩm</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categoryList as $category)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->products->count() }}</td>
                        <td>
                            <a href="{{ route('admin.category.changeStatus', $category->id) }}"
                                class="btn {{ $category->status ? 'btn-success' : 'btn-warning' }} rounded-pill status">
                                {{ $category->status ? 'Active' : 'Inactive' }}
                            </a>
                        </td>
                        <td>{{ $category->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('admin.category.edit', $category->id) }}" class="edit btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <a href="{{ route('admin.category.destroy', $category->id) }}" class="delete btn btn-danger"><i
                                    class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <form action="" method="post">
        @csrf
        @method('DELETE')
    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.delete').click(function(e) {
                e.preventDefault();
                let href = this.href;

                Swal.fire({
                    title: 'Bạn muốn xóa mục này?',
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                    confirmButtonColor: 'red'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $('form').attr('action', href).submit();
                    }
                })

            });


            $('.status').click(function(e) {
                e.preventDefault();
                var url = this.href;
                var _this = this;
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success: function(response) {
                        $(_this).toggleClass('btn-success btn-warning')
                        $(_this).hasClass('btn-success') ?
                            $(_this).text('Active') :
                            $(_this).text('InActive')


                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });



        });
    </script>
@endsection
