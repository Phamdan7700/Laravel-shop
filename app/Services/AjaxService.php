<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;

/**
 * Class AjaxService
 * @package App\Services
 */
class AjaxService
{
    function changeCategoryStatus($id)
    {
        $item = Category::findOrFail($id);
        $item->status = !boolval($item->status);
        $item->save();
    }

    function changeProductStatus($id)
    {
        $item = Product::findOrFail($id);
        $item->status = !boolval($item->status);
        $item->save();
    }
}
