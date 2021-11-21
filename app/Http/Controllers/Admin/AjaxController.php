<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\AjaxService;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    private $ajaxService;
    public function __construct(AjaxService $ajaxService)
    {
        $this->ajaxService = $ajaxService;
    }

    /* Change Category Status */
    function changeCategoryStatus($id)
    {
        $this->ajaxService->changeCategoryStatus($id);
        return response()->json([
            'message' => 'success',
            'status' => 200
        ]);
    }

    /* Change Product Status */
    function changeProductStatus($id)
    {
        $this->ajaxService->changeProductStatus($id);
        return response()->json([
            'message' => 'success',
            'status' => 200
        ]);
    }
}
