<?php

use ERP\Contracts\DTOs\UserDTO;
use PHPUnit\Framework\TestCase;

class UserDTOTest extends TestCase
{
    public function testCanConvertToAndFromArray()
    {
        $data = [
            'id' => 'abc123',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '08123456789',
            'role' => 'admin',
        ];

        $dto = UserDTO::fromArray($data);

        $this->assertInstanceOf(UserDTO::class, $dto);
        $this->assertSame($data, $dto->toArray());
    }
}