<?php

namespace App\Http\Controllers\Admin;


use App\Charts\MasterChart;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Activity\ActivityRepositoryInterface;
use App\Repositories\Card\CardLessonRepositoryInterface;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Trainer\TrainerRepositoryInterface;
use App\Services\Chart\ChartService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    protected $paymentRepository;
    protected $activityRepository;
    protected $eventRepository;
    protected $cardLessonRepository;
    protected $trainerRepository;

    public function __construct(
        ActivityRepositoryInterface $activityRepository,
        PaymentRepositoryInterface $paymentRepository,
        EventRepositoryInterface $eventRepository,
        CardLessonRepositoryInterface $cardLessonRepository,
        TrainerRepositoryInterface $trainerRepository
    )
    {
        $this->activityRepository = $activityRepository;
        $this->paymentRepository = $paymentRepository;
        $this->eventRepository = $eventRepository;
        $this->cardLessonRepository = $cardLessonRepository;
        $this->trainerRepository = $trainerRepository;
    }

    public function index(Request $request)
    {
        $from = $request->input('from', Carbon::now()->subYear()->endOfMonth()->format('Y-m-d'));
        $till = $request->input('till', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $labels = ChartService::generateLabels($from, $till);
        $activities = $this->activityRepository->getAll();
        $trainers = $this->trainerRepository->getAll();
        $activityPayments = $this->initializeData($activities, $labels);
        $activityEvents = $this->initializeData($activities, $labels);
        $activityLessons = $this->initializeData($activities, $labels);
        $trainerClients = $this->initializeData($trainers, $labels);

        foreach ($activities as $activity) {
            $payments = $this->paymentRepository->getPaymentsByActivity($activity->id, $from, $till);
            $events = $this->eventRepository->getEventsByActivity($activity->id, $from, $till);
            $lessons = $this->cardLessonRepository->getLessonsByActivity($activity->id, $from, $till);

            $this->updateData($activityPayments[$activity->id], $payments);
            $this->updateData($activityEvents[$activity->id], $events);
            $this->updateData($activityLessons[$activity->id], $lessons);
        }

        foreach ($trainers as $trainer) {
            $clients = $this->trainerRepository->getClientCountByTrainer($trainer->id, $from, $till);

            $this->updateData($trainerClients[$trainer->id], $clients);
        }

        $paymentChart = $this->createActivityChart($labels, $activityPayments);
        $eventChart = $this->createActivityChart($labels, $activityEvents);
        $lessonChart = $this->createActivityChart($labels, $activityLessons);
        $trainerChart = $this->createTrainerChart($labels, $trainerClients);

        return view('admin.pages.statistics.index', [
            'paymentChart' => $paymentChart,
            'eventChart' => $eventChart,
            'lessonChart' => $lessonChart,
            'trainerChart' => $trainerChart,
        ]);
    }

    private function initializeData($resources, $labels): array
    {
        $data = [];

        foreach ($resources as $resource) {
            $data[$resource->id] = array_fill_keys($labels, 0);
        }

        return $data;
    }

    private function updateData(&$data, $items)
    {
        foreach ($items as $item) {
            if (array_key_exists($item->period, $data)) {
                $data[$item->period] = $item->count;
            }
        }
    }

    private function createActivityChart($labels, $activityData): MasterChart
    {
        $chart = new MasterChart;
        $chart->labels($labels);

        foreach ($activityData as $activityId => $activityValues) {
            $activityName = $this->activityRepository->getNameActivityById($activityId);
            $activityColor = $this->activityRepository->getColorActivityById($activityId);

            $chart->dataset($activityName, 'bar', array_values($activityValues))
                ->options([
                    'backgroundColor' => $activityColor,
                    'borderColor' => 'transparent',
                ]);
        }

        return $chart;
    }

    private function createTrainerChart($labels, $trainerData): MasterChart
    {
        $chart = new MasterChart;
        $chart->labels($labels);

        foreach ($trainerData as $trainerId => $trainerValues) {
            $trainer = User::query()->find($trainerId);

            $chart->dataset($trainer->short_name, 'bar', array_values($trainerValues))
                ->options([
                    'backgroundColor' => generate_color(),
                    'borderColor' => 'transparent',
                ]);
        }

        return $chart;
    }
}
