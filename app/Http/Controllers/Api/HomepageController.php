<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\HomepageResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SliderResource;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\SliderService;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    private $categoryService;
    private $productService;
    private $sliderService;

    public function __construct(CategoryService $categoryService, ProductService $productService, SliderService $sliderService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->sliderService = $sliderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliderList = SliderResource::collection($this->sliderService->getAll());
        $categoryList =  CategoryResource::collection($this->categoryService->getActive());
        $data =  compact('sliderList', 'categoryList');

        return $data;
    }
}
