<?php
namespace ERP\Contracts\Responses;

class ErrorResponse extends ApiResponse
{
    public function __construct(
        protected string $message,
        protected int $code = 400,
        protected ?array $errors = null,
    ) {}

    public function toArray(): array
    {
        return [
            'success' => false,
            'message' => $this->message,
            'errors' => $this->errors,
        ];
    }
}
