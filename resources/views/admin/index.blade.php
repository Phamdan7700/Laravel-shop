@extends('admin.layout.layout')

@section('css')
    <style>
        .card {
            background-color: #fff;
            border-radius: 10px;
            border: none;
            position: relative;
            margin-bottom: 30px;
            box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1), 0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12), 0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);
        }

        .l-bg-cherry {
            background: linear-gradient(to right, #493240, #f09) !important;
            color: #fff;
        }

        .l-bg-blue-dark {
            background: linear-gradient(to right, #373b44, #4286f4) !important;
            color: #fff;
        }

        .l-bg-green-dark {
            background: linear-gradient(to right, #0a504a, #38ef7d) !important;
            color: #fff;
        }

        .l-bg-orange-dark {
            background: linear-gradient(to right, #a86008, #ffba56) !important;
            color: #fff;
        }

        .card .card-statistic-3 .card-icon-large .fas,
        .card .card-statistic-3 .card-icon-large .far,
        .card .card-statistic-3 .card-icon-large .fab,
        .card .card-statistic-3 .card-icon-large .fal {
            font-size: 110px;
        }

        .card .card-statistic-3 .card-icon {
            text-align: center;
            line-height: 50px;
            margin-left: 15px;
            color: #000;
            position: absolute;
            right: -5px;
            top: 20px;
            opacity: 0.1;
        }

        .l-bg-cyan {
            background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
            color: #fff;
        }

        .l-bg-green {
            background: linear-gradient(135deg, #23bdb8 0%, #43e794 100%) !important;
            color: #fff;
        }

        .l-bg-orange {
            background: linear-gradient(to right, #f9900e, #ffba56) !important;
            color: #fff;
        }

        .l-bg-cyan {
            background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
            color: #fff;
        }

    </style>
@endsection
@php
$bg = ['l-bg-cherry', 'l-bg-cherry', 'l-bg-blue-dark', 'l-bg-blue-dark', 'l-bg-green-dark', 'l-bg-orange-dark', 'l-bg-green-dark', 'l-bg-orange-dark'];

$progress = ['l-bg-cyan', 'l-bg-green', 'l-bg-orange', 'l-bg-cyan'];
@endphp
@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        @foreach (config('menu') as $item)
            <div class="col-xl-4 col-md-6">
                <div class="card {{ $bg[random_int(0, count($bg) - 1)] }}">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas {{ $item['icon'] }}"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">{{ $item['title'] }}</h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    $11.61k
                                </h2>
                            </div>
                            <div class="col-4 text-right">
                                <span>2.5% <i class="fa fa-arrow-up"></i></span>
                            </div>
                        </div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar {{ $progress[random_int(0, count($progress) - 1)] }}"
                                role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                style="width: 25%;"></div>
                        </div>
                        <div class="mt-2 d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route($item['link']) }}">Xem chi tiết</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let bg = ['l-bg-cherry', 'l-bg-cherry', 'l-bg-blue-dark', 'l-bg-blue-dark', 'l-bg-green-dark',
                'l-bg-orange-dark', 'l-bg-green-dark', 'l-bg-orange-dark'
            ];

            function randomColor() {
                let index = Math.floor(Math.random() * bg.length);
                return bg[index];
            }

            setInterval(() => {
                $('.card').each(function(index, element) {
                    for (const className of element.classList) {
                        if (className.startsWith('l-bg')) {
                            $(this).removeClass(className);
                            $(this).addClass(randomColor());
                        }
                    }
                });
            }, 1500);
        });
    </script>
@endsection
