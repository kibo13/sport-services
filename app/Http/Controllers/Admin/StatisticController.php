<?php

namespace App\Http\Controllers\Admin;


use App\Charts\MasterChart;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Repositories\Activity\ActivityRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Services\Chart\ChartService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(Request $request, PaymentRepositoryInterface $paymentRepository, ActivityRepositoryInterface $activityRepository)
    {
        $from = $request->input('from', Carbon::now()->subYear()->endOfMonth()->format('Y-m-d'));
        $till = $request->input('till', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $labels = ChartService::generateLabels($from, $till);
        $activities = Activity::all();
        $activityPayments = [];

        foreach ($activities as $activity) {
            $activityPayments[$activity->id] = array_fill_keys($labels, 0);
            $payments = $this->paymentRepository->getPaymentsByActivity($activity->id, $from, $till);

            foreach ($payments as $payment) {
                if (array_key_exists($payment->period, $activityPayments[$activity->id])) {
                    $activityPayments[$activity->id][$payment->period] = $payment->count;
                }
            }
        }

        $chart = new MasterChart;
        $chart->labels($labels);

        foreach ($activityPayments as $activityId => $activityPayment) {
            $activityName = $activityRepository->getNameActivityById($activityId);
            $activityColor = $activityRepository->getColorActivityById($activityId);

            $chart->dataset($activityName, 'bar', array_values($activityPayment))
                ->options([
                    'backgroundColor' => $activityColor,
                    'borderColor' => 'transparent',
                ]);
        }


        return view('admin.pages.statistics.index', compact('chart'));
    }
}
