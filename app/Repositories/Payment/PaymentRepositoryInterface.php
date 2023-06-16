<?php


namespace App\Repositories\Payment;


interface PaymentRepositoryInterface
{
    public function getAll($from = null, $till = null);
    public function getTotalAmount($from = null, $till = null);
    public function getPreviousMonthAmount();
    public function getCurrentMonthAmount();
    public function getPaymentsByActivity(int $activityId, $from, $till);
    public function getMaxPaymentId();
    public function setAutoIncrementValue($value);
}
