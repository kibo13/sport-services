<?php


namespace App\Repositories\Payment;


interface PaymentRepositoryInterface
{
    public function getTotalAmount();
    public function getPreviousMonthAmount();
    public function getCurrentMonthAmount();
    public function getPaymentsByActivity(int $activityId, $from, $till);
    public function getMaxPaymentId();
    public function setAutoIncrementValue($value);
}
