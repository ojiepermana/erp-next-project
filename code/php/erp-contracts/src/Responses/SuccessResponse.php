<?php
namespace ERP\Contracts\Responses;

class SuccessResponse extends ApiResponse
{
    public function __construct(
        protected mixed $data,
        protected string $message = 'OK',
        protected int $code = 200,
    ) {}

    public function toArray(): array
    {
        return [
            'success' => true,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }
}
