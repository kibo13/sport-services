<?php


namespace App\Repositories\Client;


interface ClientRepositoryInterface
{
    public function getAll();
    public function getTotalClientsCount();
    public function getTotalClientPlaceCount();
    public function getClientsWithActivities();
}
