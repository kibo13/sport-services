<?php


namespace App\Repositories\Payment;


use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PaymentRepository implements PaymentRepositoryInterface
{
    private function createQuery(): Builder
    {
        return Payment::query();
    }

    public function getTotalAmount()
    {
        return $this->createQuery()->sum('amount');
    }

    public function getPreviousMonthAmount()
    {
        $previousMonth = Carbon::now()->subMonth();

        return $this->createQuery()
            ->whereYear('paid_at', $previousMonth->year)
            ->whereMonth('paid_at', $previousMonth->month)
            ->sum('amount');
    }

    public function getCurrentMonthAmount()
    {
        $currentMonth = Carbon::now();

        return $this->createQuery()
            ->whereYear('paid_at', $currentMonth->year)
            ->whereMonth('paid_at', $currentMonth->month)
            ->sum('amount');
    }
}
