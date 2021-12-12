@extends('admin.layout.layout')
@section('title', 'Users')

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
    <h1 class="mt-4">User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">User</li>
    </ol>
    {{-- <div><a class="btn btn-success" href="{{ route('admin.user.create') }}">Tạo mới</a></div> --}}
    <div class="container">
        <table id="table_id" class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-nowrap">#</th>
                    <th scope="col" class="text-nowrap">Name</th>
                    <th scope="col" class="text-nowrap">Email</th>
                    <th scope="col" class="text-nowrap">Ngày tạo</th>
                    <th scope="col" class="text-nowrap">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userList as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('admin.user.destroy', $user->id) }}" class="delete btn btn-danger"><i
                                    class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div>{{ $userList->links() }}</div>
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

            // Datatables
            $('#table_id').DataTable({
                paging: false,
                info: false
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
                            $(_this).text('Disable')


                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });



        });
    </script>
@endsection
