<?php

namespace App\Services;

use App\Models\Order;

/**
 * Class OrderService
 * @package App\Services
 */
class OrderService
{
    /* Get all */
    public function getAll()
    {
        return Order::paginate();
    }
    /* Find by id */
    public function findById($id)
    {
        return Order::findOrFail($id);
    }
    /* Create */
    public function store(array $attr)
    {
        Order::create($attr);
    }
    /* Update */
    public function update($id, array $attr)
    {
        $order = $this->findById($id);
        $order->update($attr);
    }
    /* Delete */
    public function destroy($id)
    {
        $order = $this->findById($id);
        $order->details()->delete();
        $order->delete();
    }
}
