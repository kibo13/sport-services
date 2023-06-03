<?php


namespace App\Repositories\Payment;


interface PaymentRepositoryInterface
{
    public function getTotalAmount();
    public function getPreviousMonthAmount();
    public function getCurrentMonthAmount();
    public function getDataByActivity(int $activityId, $from, $till);
}
