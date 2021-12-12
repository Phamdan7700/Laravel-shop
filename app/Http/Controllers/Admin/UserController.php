<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\userRequest;
use App\Services\UserService;
use Illuminate\Support\Str;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $userList =  $this->userService->getAll();
        return view('admin.pages.user.index', compact('userList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\userRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(userRequest $request)
    {
        $request->merge(['slug' => Str::slug($request->title)]);
        // dd($request->all());
        $this->userService->store($request->all());
        session()->flash('success', "Tạo mới thành công");
        return redirect()->route('admin.user.index');
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
        $user = $this->userService->findById($id);
        return view('admin.pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\userRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(userRequest $request, $id)
    {
        if (!$request->input('status')) {
            $request->merge(['status' => 0]);
        }
        $this->userService->update($id, $request->all());
        session()->flash('success', "Cập nhật thành công");

        return redirect()->route('admin.user.index');
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

            $this->userService->destroy($id);
            session()->flash('success', "Xóa thành công!");
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('error', "Không thể xóa!");
            return redirect()->route('admin.user.index');
        }
    }
}
