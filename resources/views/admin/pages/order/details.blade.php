<div class="modal-header border-0">
    <h5 class="modal-title">Chi tiết đơn hàng #{{ $order->id }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col col-md-6">
            <div class="jumbotron">
                <h6 class=" bg-warning rounded-2 p-2 ">Thông tin đơn hàng:</h6>
                <p class="text border-left pl-1 ">Mã đơn hàng: <span class="badge bg-primary">#{{ $order->id }}</span>
                </p>
                <p class="text border-left pl-1 ">Người đặt hàng: <span>{{ $order->user->name }}</span></p>
                <p class="text border-left pl-1">Ngày đặt hàng: {{ $order->created_at->format('l, d/m/Y') }}</p>
                <p class="text border-left pl-1">Trạng thái: <span class="badge bg-primary">Đặt mới</span> </p>
            </div>
        </div>
        <div class="col col-md-6">
            <div class="jumbotron">
                <h6 class=" bg-warning rounded-2 p-2 ">Thông tin nhận hàng:</h6>
                <p class="text border-left pl-1 ">Người nhận: <span
                        class="badge bg-primary">{{ $order->receiver }}</span>
                </p>
                <p class="text border-left pl-1">Địa chỉ: {{ $order->address }}</p>
                <p class="text border-left pl-1">Số điện thoại: <span class="badge bg-primary">{{ $order->phone }}</span>
                </p>
            </div>
        </div>
    </div>
    <hr class="my-4">

    <table id="table_id" class="table table-hover table-striped ">
        <thead class="sticky top-14 bg-white">
            <tr>
                <th scope="col">#</th>
                <th scope="col" colspan="2">Sản phẩm</th>
                <th scope="col">Giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->details as $item)
                @php
                    $product = $item->product;
                    $price = $product->price_sale > 0 ? $product->price_sale : $product->price;
                @endphp
                <tr class="align-middle product">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        {{ $product->name }}
                    </td>
                    <td>
                        <img src="{{ asset("$product->thumbnail") }}" class="img-thumbnail thumbnail" alt="thumbnail">
                    </td>
                    <td>{{ number_format($price) }}</td>
                    <td class="text-nowrap">{{ $item->amount }}</td>
                    <td class="text-nowrap">{{ number_format($item->total_price) }} đ</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="">
        <h5 class="font-bold bg-primary rounded-1 float-right text-white pt-2 pb-2 pr-3 pl-3">Tổng thanh toán:
            <span>{{ number_format($order->total_price) }}
                đ</span></h5>
    </div>
</div>
