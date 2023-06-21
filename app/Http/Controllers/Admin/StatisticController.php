<?php

namespace App\Http\Controllers\Admin;


use App\Charts\MasterChart;
use App\Http\Controllers\Controller;
use App\Repositories\Activity\ActivityRepositoryInterface;
use App\Repositories\Card\CardLessonRepositoryInterface;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Services\Chart\ChartService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    protected $paymentRepository;
    protected $activityRepository;
    protected $eventRepository;
    protected $cardLessonRepository;

    public function __construct(
        ActivityRepositoryInterface $activityRepository,
        PaymentRepositoryInterface $paymentRepository,
        EventRepositoryInterface $eventRepository,
        CardLessonRepositoryInterface $cardLessonRepository
    )
    {
        $this->activityRepository = $activityRepository;
        $this->paymentRepository = $paymentRepository;
        $this->eventRepository = $eventRepository;
        $this->cardLessonRepository = $cardLessonRepository;
    }

    public function index(Request $request)
    {
        $from = $request->input('from', Carbon::now()->subYear()->endOfMonth()->format('Y-m-d'));
        $till = $request->input('till', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $labels = ChartService::generateLabels($from, $till);
        $activities = $this->activityRepository->getAll();
        $activityPayments = $this->initializeActivityData($activities, $labels);
        $activityEvents = $this->initializeActivityData($activities, $labels);
        $activityLessons = $this->initializeActivityData($activities, $labels);

        foreach ($activities as $activity) {
            $payments = $this->paymentRepository->getPaymentsByActivity($activity->id, $from, $till);
            $events = $this->eventRepository->getEventsByActivity($activity->id, $from, $till);
            $lessons = $this->cardLessonRepository->getLessonsByActivity($activity->id, $from, $till);

            $this->updateActivityData($activityPayments[$activity->id], $payments);
            $this->updateActivityData($activityEvents[$activity->id], $events);
            $this->updateActivityData($activityLessons[$activity->id], $lessons);
        }

        $paymentChart = $this->createChart($labels, $activityPayments);
        $eventChart = $this->createChart($labels, $activityEvents);
        $lessonChart = $this->createChart($labels, $activityLessons);

        return view('admin.pages.statistics.index', [
            'paymentChart' => $paymentChart,
            'eventChart' => $eventChart,
            'lessonChart' => $lessonChart
        ]);
    }

    private function initializeActivityData($activities, $labels): array
    {
        $activityData = [];

        foreach ($activities as $activity) {
            $activityData[$activity->id] = array_fill_keys($labels, 0);
        }

        return $activityData;
    }

    private function updateActivityData(&$activityData, $items)
    {
        foreach ($items as $item) {
            if (array_key_exists($item->period, $activityData)) {
                $activityData[$item->period] = $item->count;
            }
        }
    }

    private function createChart($labels, $activityData): MasterChart
    {
        $chart = new MasterChart;
        $chart->labels($labels);

        foreach ($activityData as $activityId => $activity) {
            $activityName = $this->activityRepository->getNameActivityById($activityId);
            $activityColor = $this->activityRepository->getColorActivityById($activityId);

            $chart->dataset($activityName, 'bar', array_values($activity))
                ->options([
                    'backgroundColor' => $activityColor,
                    'borderColor' => 'transparent',
                ]);
        }

        return $chart;
    }
}
