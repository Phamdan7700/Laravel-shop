<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Services\SliderService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    private $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliderList = $this->sliderService->getAll();
        return view('admin.pages.slider.index', compact('sliderList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $postion =  0;
        ($slider = Slider::orderByDesc('position')->first()) ? ($slider->position + 1) : $postion;
        $request->merge(['position' => $postion]);
        $this->sliderService->store([
            'img' => $request->thumbnail,
            'postion' => $postion
        ]);
        session()->flash('success', "Tạo mới thành công");
        return redirect()->route('admin.slider.index');
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
        $slider = $this->sliderService->findById($id);
        return view('admin.pages.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SliderRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, $id)
    {

        $this->sliderService->update($id, $request->all());
        session()->flash('success', "Cập nhật thành công");

        return redirect()->route('admin.slider.index');
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

            $this->sliderService->destroy($id);
            session()->flash('success', "Xóa thành công!");
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('error', "Không thể xóa!");
            return redirect()->route('admin.slider.index');
        }
    }
}
