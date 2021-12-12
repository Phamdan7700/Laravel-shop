<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total = [
            'category' => Category::count(),
            'product' => Product::count(),
            'blog' => Post::count(),
            'slider' => Slider::count(),
            'order' => Order::count(),
            'user' => User::count(),
            'dashboard' => null,
            'file' => null
        ];
        return view('admin.index', compact('total'));
    }


    public function filemanager()
    {
        return view('admin.file-manager');
    }
}
