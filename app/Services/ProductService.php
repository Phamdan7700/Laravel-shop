<?php

namespace App\Services;

use App\Models\Product;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService
{
    /* Get all */
    public function getAll()
    {
        return Product::paginate();
    }

    /* Get active */
    public function getActive()
    {
        return Product::active()->paginate(12);
    }

    /* Find by id */
    public function findById($id)
    {
        return Product::findOrFail($id);
    }

    /* Create */
    public function store(array $attr)
    {
        Product::create($attr);
    }

    /* Update */
    public function update($id, array $attr)
    {
        $product = $this->findById($id);
        $product->update($attr);
    }

    /* Delete */
    public function destroy($id)
    {
        $product = $this->findById($id);
        $product->delete();
    }
}
