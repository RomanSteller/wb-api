<?php

namespace App\Actions;

use App\Http\Controllers\UnescapedUnicodeResponses;
use App\Http\Requests\SalesRequest;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetSalesListAction
{
    use AsAction, UnescapedUnicodeResponses;

    /**
     * @param SalesRequest $request
     * @return JsonResponse
     */
    public function handle(SalesRequest $request): JsonResponse
    {
        try {
            $dateFrom = $request->input('dateFrom');
            $dateTo = $request->input('dateTo');
            $limit = $request->input('limit', 500);

            $sales = Sale::query()
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->paginate($limit);

            return $this->success($sales)
                ->pagination($sales)
                ->send();
        } catch (\Exception $e) {
            return $this->error('Ошибка при получении продаж')
                ->exception($e->getMessage())->send();
        }
    }
}
