<?php


namespace App\Repositories\Order;


interface OrderRepositoryInterface
{
    public function getAll();
    public function getOrdersByClient(int $clientId);
    public function getNewOrdersCount();
    public function getCompletedOrdersCount();
    public function getRejectedOrdersCount();
}
