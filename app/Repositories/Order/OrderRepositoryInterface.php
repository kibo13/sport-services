<?php


namespace App\Repositories\Order;


interface OrderRepositoryInterface
{
    public function getAll();
    public function getOrdersByClient(int $clientId);
}
