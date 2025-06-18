<?php
namespace ERP\Contracts\DTOs;

class UserDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public ?string $phone = null,
        public ?string $role = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['phone'] ?? null,
            $data['role'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
        ];
    }
}
