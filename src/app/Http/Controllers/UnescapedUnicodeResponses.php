<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait UnescapedUnicodeResponses
{
    /**
     * @var array
     *
     * For response
     */
    private array $response = [];

    /**
     * @var string
     *
     * Статус
     */
    private string $status = 'success';

    /**
     * @var int
     *
     * Код ответа
     */
    private int $code = ResponseAlias::HTTP_OK;

    /**
     * @param array $data
     * @return $this
     *
     * Добавить данные
     */
    public function success($data = [])
    {
        $this->response = [
            'data' => $data,
            'status' => $this->status
        ];

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     *
     * Добавить данные по предупреждению
     */
    public function warning($data = [])
    {
        $this->response = [
            'data' => $data
        ];

        $this->status = 'warning';

        return $this;
    }

    /**
     * @param string $message
     * @return $this
     *
     * Добавить сообщение ошибки
     */
    public function error(string $message)
    {
        $this->response = [
            'message' => $message
        ];

        $this->status = 'error';
        $this->code = 400;

        return $this;
    }

    /**
     * @param string $message
     * @return $this
     *
     * Добавить сообщение исключение
     */
    public function exception(string $message)
    {
        Log::error($message);

        $this->response = array_merge($this->response, [
            'exception' => $message
        ]);

        $this->status = 'error';

        return $this;
    }

    /**
     * @param LengthAwarePaginator $pagination
     * @return $this
     *
     * Добавить пагинацию
     */
    public function pagination($pagination): static
    {
        $this->response = array_merge($this->response, [
            'pagination' => [
                'total' => $pagination->total(),
                'count' => $pagination->count(),
                'perPage' => $pagination->perPage(),
                'currentPage' => $pagination->currentPage(),
                'totalPages' => $pagination->lastPage()
            ]
        ]);

        return $this;
    }

    /**
     * @return $this
     */
    public function simplePagination(Paginator $pagination): self
    {
        $this->response = array_merge($this->response, [
            'pagination' => [
                'currentPage' => $pagination->currentPage(),
                'perPage' => $pagination->perPage()
            ]
        ]);

        return $this;
    }

    /**
     * @return $this
     */
    public function cursorPagination(CursorPaginator $pagination): self
    {
        $this->response = array_merge($this->response, [
            'pagination' => [
                'perPage' => $pagination->perPage(),
                'next' => $pagination->nextPageUrl(),
                'previous' => $pagination->previousPageUrl()
            ]
        ]);

        return $this;
    }

    public function withCookie(\Symfony\Component\HttpFoundation\Cookie $cookie)
    {
        $this->response['cookie'] = $cookie;

        return $this;
    }

    /**
     */
    public function send()
    {
        $response = response()->json(array_merge($this->response, [
            'status' => $this->status
        ]), $this->code, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

        if (isset($this->response['cookie'])) {
            $response->withCookie($this->response['cookie']);
        }

        return $response;
    }
}
