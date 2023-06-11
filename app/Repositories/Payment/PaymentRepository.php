<?php


namespace App\Repositories\Payment;


use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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

    public function getPaymentsByActivity(int $activityId, $from, $till)
    {
        return $this->createQuery()
            ->select([
                DB::raw('DATE_FORMAT(paid_at, \'%m.%Y\') AS period'),
                DB::raw('COUNT(id) AS count')
            ])
            ->where('activity_id', $activityId)
            ->whereBetween('paid_at', [$from, $till])
            ->groupBy('period')
            ->get();
    }

    public function getMaxPaymentId()
    {
        return $this->createQuery()->max('id');
    }

    public function setAutoIncrementValue($value)
    {
        DB::statement("ALTER TABLE payments AUTO_INCREMENT = $value;");
    }
}
