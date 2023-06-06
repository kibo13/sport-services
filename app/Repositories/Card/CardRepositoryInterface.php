<?php


namespace App\Repositories\Card;


interface CardRepositoryInterface
{
    public function getActiveCards(array $activities, int $clientId);
}
