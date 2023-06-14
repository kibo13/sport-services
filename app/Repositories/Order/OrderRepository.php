<?php


namespace App\Repositories\Order;


use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;

class OrderRepository implements OrderRepositoryInterface
{
    private function createQuery(): Builder
    {
        return Order::query();
    }

    public function getAll()
    {
        return $this->createQuery()
            ->get();
    }

    public function getOrdersByClient(int $clientId)
    {
        return $this->createQuery()
            ->where('client_id', $clientId)
            ->get();
    }
}
