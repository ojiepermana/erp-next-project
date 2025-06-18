<?php
namespace ERP\Contracts\Contracts;

use ERP\Contracts\DTOs\UserDTO;

interface UserContract
{
    public function findById(string $id): ?UserDTO;
    public function findByEmail(string $email): ?UserDTO;
    public function list(array $filters = []): array;
    public function create(array $data): UserDTO;
    public function update(string $id, array $data): UserDTO;
    public function delete(string $id): bool;
}
