<?php
namespace ERP\Contracts\Responses;

abstract class ApiResponse
{
    abstract public function toArray(): array;
}
