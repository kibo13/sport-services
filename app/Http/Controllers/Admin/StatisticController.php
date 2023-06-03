<?php

namespace App\Http\Controllers\Admin;


use App\Charts\MasterChart;
use App\Enums\Service\ServiceActivity;
use App\Http\Controllers\Controller;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Services\Chart\ChartService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(Request $request, PaymentRepositoryInterface $paymentRepository)
    {
        $from = $request->input('from', Carbon::now()->subYear()->endOfMonth()->format('Y-m-d'));
        $till = $request->input('till', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $labels = ChartService::generateLabels($from, $till);
        $activities = ServiceActivity::NAMES;
        $activityPayments = [];

        foreach ($activities as $activityId => $activity) {
            $activityPayments[$activityId] = array_fill_keys($labels, 0);

            $payments = $paymentRepository->getDataByActivity($activityId, $from, $till);

            foreach ($payments as $payment) {
                if (array_key_exists($payment->period, $activityPayments[$activityId])) {
                    $activityPayments[$activityId][$payment->period] = $payment->count;
                }
            }
        }

        $chart = new MasterChart;
        $chart->labels($labels);

        foreach ($activityPayments as $activityId => $activityPayment) {
            $chart->dataset(ServiceActivity::NAMES[$activityId], 'bar', array_values($activityPayment))
                ->options([
                    'backgroundColor' => ServiceActivity::COLORS[$activityId],
                    'borderColor' => 'transparent',
                ]);
        }


        return view('admin.pages.statistics.index', compact('chart'));
    }
}
