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
        return Category::all();
    }
    /* Find by id */
    public function findById($id)
    {
        return Category::findOrFail($id);
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
