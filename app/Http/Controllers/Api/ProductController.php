<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;
    private $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productList =  $this->productService->getActive();
        return ProductResource::collection($productList);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productService->findById($id);
        return new ProductResource($product);
    }

    public function productsByCategory(Request $request, $slug)
    {
        $search = $request->input('search');
        $sort = $request->input('sort');
        $rating = $request->input('rating');
        $topSale = $request->input('sale');
        $new = $request->input('new');


        $category = $this->categoryService->findBySlug($slug);
        $queryProducts = $category->products()->active();
        if ($search) {
            $queryProducts = $queryProducts->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('manufacturer', 'like', "%$search%")
                    ->orWhere('price', 'like', "%$search%")
                    ->orWhere('price_sale', 'like', "%$search%");
            });
        }

        if ($topSale) {
            $queryProducts = $queryProducts->reorder()->orderByDesc('price_sale');
        }

        if ($rating) {
            $queryProducts = $queryProducts->reorder()->orderByDesc('rate');
        }

        if ($sort) {
            $queryProducts = $queryProducts->reorder()->orderBy('price', $sort);
        }

        if ($new) {
            $queryProducts = $queryProducts->reorder()->latest();
        }

        $products = $queryProducts->paginate(16);
        return ProductResource::collection($products);
    }
}
