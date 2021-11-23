<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogList = $this->blogService->getAll();
        return view('admin.pages.blog.index', compact('blogList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\BlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        if (!$request->input('status')) {
            $request->merge(['status' => 0]);
        }
        $this->blogService->store($request->all());
        session()->flash('success', "Tạo mới thành công");
        return redirect()->route('admin.blog.index');
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
        $blog = $this->blogService->findById($id);
        return view('admin.pages.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\BlogRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        if (!$request->input('status')) {
            $request->merge(['status' => 0]);
        }

        $this->blogService->update($id, $request->all());
        session()->flash('success', "Cập nhật thành công");

        return redirect()->route('admin.blog.index');
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

            $this->blogService->destroy($id);
            session()->flash('success', "Xóa thành công!");
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('error', "Không thể xóa!");
            return redirect()->route('admin.blog.index');
        }
    }
}
