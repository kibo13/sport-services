<?php

namespace App\Http\Controllers\Admin;


use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Activity\ActivityRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Trainer\TrainerRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(OrderRepositoryInterface $orderRepository)
    {
        // Получаем текущего пользователя
        $user = auth()->user();

        // Проверяем, является ли пользователь клиентом
        $isClient = $user->role_id == Role::CLIENT;

        // Если пользователь является клиентом
        if ($isClient) {
            // Получаем список заказов, связанных с клиентом
            $orders = $orderRepository->getOrdersByClient($user->id);
        } else {
            // Если пользователь не является клиентом, получаем все заказы
            $orders = $orderRepository->getAll();
        }

        // Возвращаем представление 'admin.pages.orders.index' и передаем в него список заказов
        return view('admin.pages.orders.index', compact('orders'));
    }

    public function create(ActivityRepositoryInterface $activityRepository, TrainerRepositoryInterface $trainerRepository)
    {
        // Получаем все активности
        $activities = $activityRepository->getAll();

        // Получаем всех тренеров
        $trainers = $trainerRepository->getAll();

        // Возвращаем представление 'admin.pages.orders.form' и передаем в него список активностей и тренеров
        return view('admin.pages.orders.form', [
            'activities' => $activities,
            'trainers' => $trainers,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        // Создаем новый заказ на основе данных из запроса
        Order::query()->create($request->all());

        // Перенаправляем пользователя на маршрут 'orders.index' с сообщением об успешном добавлении записи
        return redirect()
            ->route('orders.index')
            ->with('success', __('_record.added'));
    }

    public function edit(Order $order)
    {
        // Возвращаем представление 'admin.pages.orders.form' и передаем в него объект заказа
        return view('admin.pages.orders.form', compact('order'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        // Обновляем заказ на основе данных из запроса
        $order->update($request->all());

        // Перенаправляем пользователя на маршрут 'orders.index' с сообщением об успешном обновлении записи
        return redirect()
            ->route('orders.index')
            ->with('success', __('_record.updated'));
    }
}
