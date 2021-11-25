<?php

namespace App\Services;

use App\Models\Slider;

/**
 * Class SliderService
 * @package App\Services
 */
class SliderService
{
    /* Get all */
    public function getAll()
    {
        return Slider::orderBy('position')->get();
    }
    /* Find by id */
    public function findById($id)
    {
        return Slider::findOrFail($id);
    }
    /* Create */
    public function store(array $attr)
    {
        $postion =  0;
        $postion = ($slider = Slider::orderByDesc('position')->first()) ? ($slider->position + 1) : $postion;
        $attr = array_merge($attr, ['position' => $postion]);
        Slider::create($attr);
    }
    /* Update */
    public function update($id, array $attr)
    {
        $slider = $this->findById($id);
        $slider->update($attr);
    }
    /* Delete */
    public function destroy($id)
    {
        $slider = $this->findById($id);
        $slider->delete();
    }
}
