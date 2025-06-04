<?php

namespace App\Actions;

use App\Http\Controllers\UnescapedUnicodeResponses;
use App\Http\Requests\IncomesRequest;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetIncomesListAction
{
    use AsAction, UnescapedUnicodeResponses;

    /**
     * @param IncomesRequest $request
     * @return JsonResponse
     */
    public function handle(IncomesRequest $request): JsonResponse
    {
        try {
            $dateFrom = $request->input('dateFrom');
            $dateTo = $request->input('dateTo');
            $limit = $request->input('limit', 500);

            $incomes = Income::query()
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->paginate($limit);

            return $this->success($incomes)
                ->pagination($incomes)
                ->send();
        } catch (\Exception $e) {
            return $this->error('Ошибка при получении доходов')
                ->exception($e->getMessage())->send();
        }
    }
}
