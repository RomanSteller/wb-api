<?php

namespace App\Actions;

use App\Http\Controllers\UnescapedUnicodeResponses;
use App\Http\Requests\OrdersRequest;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetOrdersListAction
{
    use AsAction, UnescapedUnicodeResponses;

    /**
     * @param OrdersRequest $request
     * @return JsonResponse
     */
    public function handle(OrdersRequest $request): JsonResponse
    {
        try {
            $dateFrom = $request->input('dateFrom');
            $dateTo = $request->input('dateTo');
            $limit = $request->input('limit', 500);

            $orders = Order::query()
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->paginate($limit);

            return $this->success($orders)
                ->pagination($orders)
                ->send();
        } catch (\Exception $e) {
            return $this->error('Ошибка при получении заказов')
                ->exception($e->getMessage())->send();
        }
    }
}
