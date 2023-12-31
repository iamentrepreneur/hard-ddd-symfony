<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use http\Exception\InvalidArgumentException;

class Phone
{
    private string $value;
    public function __construct(string $value)
    {
        $this->assertValidPhone($value);
        $this->value = $value;
    }
    public function getValue(): string
    {
        return $this->value;
    }

    private function assertValidPhone(string $value): void
    {
        if (!preg_match('/^\d{10}$/', $value)) {
            throw new InvalidArgumentException('Телефон должен содержать 10 цифр');
        }
    }
}