@extends('admin.layout.layout')
@section('title', 'Slider')

@section('css')

    <style>
        table {
            text-align: center;
        }

        .status {
            min-width: 100px;
        }

        .img-thumbnail {
            max-height: 50px;
            max-width: max-content;
        }


    </style>
@endsection
@section('content')
    <h1 class="mt-4">Slider</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Slider</li>
    </ol>
    <div><a class="btn btn-success" href="{{ route('admin.slider.create') }}">Tạo mới</a></div>
    <div class="container mt-2">
        <table id="table_id" class="display table table-hover table-striped ">
            <thead>
                <th scope="col" class="text-nowrap">#</th>
                <th scope="col" class="text-nowrap">Thumbnail</th>
                <th scope="col" class="text-nowrap">Thứ tự</th>
                <th scope="col" class="text-nowrap">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sliderList as $slider)
                    <tr class="align-middle">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <img src="{{ asset($slider->img) }}" class="img-thumbnail thumbnail" alt="thumbnail"
                                type="button" data-bs-toggle="modal" data-bs-target="#thumbnail">
                        </td>
                        <td>{{ $slider->position }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('admin.slider.edit', $slider->id) }}" class="edit btn btn-primary "><i
                                    class="fas fa-edit"></i></a>
                            <a href="{{ route('admin.slider.destroy', $slider->id) }}" class="delete btn btn-danger"><i
                                    class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{--  --}}
        <h5>Demo</h5>
        @if (!$sliderList->isEmpty())
            <div id="slider" class="carousel slide carousel-dark" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($sliderList as $slider)
                        <button type="button" data-bs-target="#slider" data-bs-slide-to="{{ $loop->index }}"
                            class="{{ $loop->first ? 'active' : null }}" aria-current="true"
                            aria-label="Slide {{ $loop->iteration }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($sliderList as $slider)
                        <div class="carousel-item {{ $loop->first ? 'active' : null }}">
                            <img src="{{ asset($slider->img ?? 'uploads/thumbnail.jpg') }}" alt="slider">
                        </div>
                    @endforeach

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @endif
        {{--  --}}
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
                info: false
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
