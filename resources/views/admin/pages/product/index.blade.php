@extends('admin.layout.layout')
@section('title', 'Sản phẩm')

@section('css')

    <style>
        table {
            text-align: center;
        }

        .status {
            min-width: 100px;
        }

        .img-thumbnail {
            max-width: 100px;
        }

    </style>
@endsection
@section('content')
    <h1 class="mt-4">Sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Sản phẩm

        </li>
    </ol>
    <div><a class="btn btn-success" href="{{ route('admin.product.create') }}">Tạo mới</a></div>
    <div class="container mt-2">
        <table id="table_id" class="display table table-hover table-striped ">
            <thead class="sticky top-14">
                <tr>
                    <th scope="col" class="text-nowrap">#</th>
                    <th scope="col" class="text-nowrap">Tên sản phẩm</th>
                    <th scope="col" class="text-nowrap">Hình ảnh</th>
                    <th scope="col" class="text-nowrap">Danh mục</th>
                    <th scope="col" class="text-nowrap">Giá</th>
                    <th scope="col" class="text-nowrap">Khuyến mãi</th>
                    <th scope="col" class="text-nowrap">Trạng thái</th>
                    <th scope="col" class="text-nowrap">Tồn kho</th>
                    <th scope="col" class="text-nowrap">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productList as $product)
                    <tr class="align-middle product">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td class="name">{{ $product->name }}</td>
                        <td>
                            <img src="{{ $product->thumbnail }}"
                                class="img-thumbnail thumbnail" alt="thumbnail" type="button" data-bs-toggle="modal"
                                data-bs-target="#thumbnail">
                        </td>
                        <td>{{ $product->category->title }}</td>
                        <td class="text-nowrap">{{ number_format($product->price) }} đ</td>
                        <td class="text-nowrap">{{ number_format($product->price_sale) }} đ</td>

                        <td>
                            <a href="{{ route('admin.product.changeStatus', $product->id) }}"
                                class="btn {{ $product->status ? 'btn-success' : 'btn-warning' }} rounded-pill status">
                                {{ $product->status ? 'Active' : 'Disable' }}
                            </a>
                        </td>
                        <td>{{ $product->count_in_sock }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('admin.product.edit', $product->id) }}" class="edit btn btn-primary "><i
                                    class="fas fa-edit"></i></a>
                            <a href="{{ route('admin.product.destroy', $product->id) }}" class="delete btn btn-danger"><i
                                    class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div>{{ $productList->links() }}</div>
    </div>
    <form action="" method="post">
        @csrf
        @method('DELETE')
    </form>

    <!-- Modal -->
    <div class="modal fade" id="thumbnail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modal-thumbnail" src="" alt="thmbnail" width="100%">
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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

            // Datatables
            $('#table_id').DataTable({
                paging: false,
                info: false,
                "columnDefs": [{
                    "type": "formatted-num",
                    targets: [3, 4]
                }]
            });
            // Format number sort
            jQuery.extend(jQuery.fn.dataTableExt.oSort, {
                "formatted-num-pre": function(a) {
                    a = (a === "-" || a === "") ? 0 : a.replace(/[^\d\-\.]/g, "");
                    return parseFloat(a);
                },

                "formatted-num-asc": function(a, b) {
                    return a - b;
                },

                "formatted-num-desc": function(a, b) {
                    return b - a;
                }
            });

            /* Change status */
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
                            $(_this).text('Disable')


                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });

            $('.thumbnail').click(function(e) {
                e.preventDefault();
                let name = $(this).parent().siblings('.name').text();
                let src = $(this).attr('src');
                $('#modal-thumbnail').attr('src', src);
                $('.modal-title').text(name);

            });



        });
    </script>
@endsection
