@extends('admin.layout.layout')
@section('title', 'Đơn hàng')

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

        .border-left {
            /* border-left: 4px solid rgb(89, 0, 255); */
        }
        .bg-warning {
            background-color: orangered !important;
            color: white
        }

    </style>
@endsection
@section('content')
    <h1 class="mt-4">Đơn hàng</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Đơn hàng</li>
    </ol>
    <div class="container mt-2">
        <table id="table_id" class="table table-hover table-striped ">
            <thead class="sticky top-14 ">
                <tr>
                    <th scope="col" class="text-nowrap">#</th>
                    <th scope="col" class="text-nowrap">Order ID</th>
                    <th scope="col" class="text-nowrap">Khách hàng</th>
                    <th scope="col" class="text-nowrap">Tổng tiền</th>
                    <th scope="col" class="text-nowrap">Trạng thái</th>
                    <th scope="col" class="text-nowrap">Ngày đặt hàng</th>
                    <th scope="col" class="text-nowrap">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderList as $order)
                    <tr class="align-middle">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <th scope="row">#{{ $order->id }}</th>
                        <td scope="row">{{ $order->user->name }}</td>
                        <td scope="row">{{ number_format($order->total_price) }} đ</td>
                        <td class="text-nowrap">Đặt mới</td>
                        <td class="text-nowrap">{{ $order->created_at->format('H:m:s d/m/Y')}}</td>
                        <td class="text-nowrap">
                            <button type="button" class="action-detail btn btn-primary" data-order-id="{{ $order->id }}"
                                data-bs-toggle="modal" data-bs-target="#thumbnail">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a href="{{ route('admin.order.destroy', $order->id) }}" class="delete btn btn-danger"><i
                                    class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div>{{ $orderList->links() }}</div>

    </div>
    <form action="" method="post">
        @csrf
        @method('DELETE')
    </form>

    <!-- Modal -->
    <div class="modal fade" id="thumbnail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-100 w-75">
            <div class="modal-content">

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

            $('.action-detail').click(function(e) {
                let id = $(this).data('order-id');
                console.log(id);
                e.preventDefault();
                $.get(`order/${id}`, null,
                    function(data, textStatus, jqXHR) {
                        $('.modal-content').html(data);
                    },
                    "html"
                );


            });

        });
    </script>
@endsection
