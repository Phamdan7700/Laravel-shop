<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
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

        $productList =  $this->productService->getAll();
        return view('admin.pages.product.index', compact('productList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryList = $this->categoryService->getAll();
        return view('admin.pages.product.create', compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads', $file_name);
        }
        $attr = $request->all();
        $attr['thumbnail'] = $file_name;
        $this->productService->store($attr);
        session()->flash('success', "Tạo mới sản phẩm thành công");
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryList = $this->categoryService->getAll();
        $product = $this->productService->findById($id);
        return view('admin.pages.product.edit', compact('product', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        if (!$request->input('status')) {
            $request->merge(['status' => 0]);
        }
        $this->productService->update($id, $request->all());
        session()->flash('success', "Cập nhật thành công");

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $this->productService->destroy($id);
            session()->flash('success', "Xóa thành công!");
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('error', "Không thể xóa!");
            return redirect()->route('admin.product.index');
        }
    }
}
