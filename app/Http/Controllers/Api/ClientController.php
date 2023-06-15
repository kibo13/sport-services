<?php

namespace App\Http\Controllers\Api;


use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        // Получаем значение параметра поиска из запроса
        $searchQuery = $request->input('search');

        // Получаем объект запроса для поиска клиентов
        // Добавляем условие для исключения клиентов, которые уже заняли все 12 мест в группе
        // TODO: добавить в запрос проверку активности (плавание, тренажерный зал, теннис)
        $clientsSql = User::query()
            ->where('role_id', Role::CLIENT)
            ->whereDoesntHave('places', function ($query) {
                $query->where('is_busy', true);
            });

        // Добавляем условие поиска в запрос
        if (! empty($searchQuery))
        {
            $clientsSql->where(function ($query) use ($searchQuery) {
                $query->where('full_name', 'LIKE', '%' . $searchQuery . '%');
            });
        }

        // Выполняем запрос с учетом пагинации
        $clients = $clientsSql->get();

        return response()->json($clients);
    }

}
