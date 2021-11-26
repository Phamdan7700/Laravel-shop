<?php

namespace App\Services;

use App\Models\Category;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService
{
    /* Get all */
    public function getAll()
    {
        return Category::orderBy('position')->paginate();
    }
    /* Get active */
    public function getActive()
    {
        return Category::active()->get();
    }
    /* Find by id */
    public function findById($id)
    {
        return Category::findOrFail($id);
    }
    /* Find by slug */
    public function findBySlug($slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }
    /* Create */
    public function store(array $attr)
    {
        Category::create($attr);
    }
    /* Update */
    public function update($id, array $attr)
    {
        $category = $this->findById($id);
        $category->update($attr);
    }
    /* Delete */
    public function destroy($id)
    {
        $category = $this->findById($id);
        $category->delete();
    }
}
