<?php
namespace ERP\Contracts\Responses;

class PaginatedResponse extends ApiResponse
{
    public function __construct(
        protected array $items,
        protected int $total,
        protected int $page,
        protected int $perPage,
    ) {}

    public function toArray(): array
    {
        return [
            'success' => true,
            'data' => $this->items,
            'pagination' => [
                'total' => $this->total,
                'page' => $this->page,
                'per_page' => $this->perPage,
            ],
        ];
    }
}
