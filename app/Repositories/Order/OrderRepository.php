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

    public function getNewOrdersCount(): int
    {
        return $this->createQuery()
            ->where('status_id', 1)
            ->count();
    }

    public function getCompletedOrdersCount(): int
    {
        return $this->createQuery()
            ->where('status_id', 2)
            ->count();
    }

    public function getRejectedOrdersCount(): int
    {
        return $this->createQuery()
            ->where('status_id', 4)
            ->count();
    }
}
