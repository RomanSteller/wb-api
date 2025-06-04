<?php

namespace App\Actions;

use App\Http\Controllers\UnescapedUnicodeResponses;
use App\Http\Requests\StocksRequest;
use App\Models\Stock;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class GetStocksListAction
{
    use AsAction, UnescapedUnicodeResponses;

    /**
     * @param StocksRequest $request
     * @return JsonResponse
     */
    public function handle(StocksRequest $request): JsonResponse
    {
        try {
            $dateFrom = $request->input('dateFrom');
            $limit = $request->input('limit', 500);

            $stocks = Stock::query()
                ->whereDate('date', $dateFrom)
                ->paginate($limit);

            return $this->success($stocks)
                ->pagination($stocks)
                ->send();
        } catch (\Exception $e) {
            return $this->error('Ошибка при получении продаж')
                ->exception($e->getMessage())->send();
        }
    }
}
