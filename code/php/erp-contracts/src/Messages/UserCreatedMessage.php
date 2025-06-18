<?php
namespace ERP\Contracts\Messages;

use ERP\Contracts\DTOs\UserDTO;

class UserCreatedMessage
{
    public function __construct(public UserDTO $user) {}

    public static function fromArray(array $data): self
    {
        return new self(UserDTO::fromArray($data['user']));
    }

    public function toArray(): array
    {
        return ['user' => $this->user->toArray()];
    }
}
