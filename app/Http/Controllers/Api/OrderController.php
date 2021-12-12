<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Notifications\OrderNotification;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    function handleOrder(Request $request)
    {
        $user = $request->user;
        $ward = json_decode($request['formData']['ward'])->name;
        $district = json_decode($request['formData']['district'])->name;
        $province = json_decode($request['formData']['province'])->name;
        $village = $request['formData']['village'];
        $address = "$village, $ward, $district, $province";
        $shoppingCart = $request['shoppingCart'];

        $order = Order::create([
            'user_id' => $user['id'],
            'receiver' => $request['formData']['name'],
            'address' => $address,
            'phone' => $request['formData']['phone'],
            'total_price' => $shoppingCart['totalPrice'],

        ]);
        foreach ($shoppingCart['cart'] as $item) {
            $cart[] = [
                'product_id' => $item['id'],
                'amount' => $item['amount'],
                'order_id' => $order['id'],
                'total_price' => $item['amount'] * $item['price'],
            ];
        }
        OrderDetail::insert($cart);
        // auth()->user()->notify(new OrderNotification($order));
        return response()->json([
            'success' => true,
            'message' => 'Đặt hàng thành công',
            'order' => $order->id

        ]);
    }
}
