<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use http\Exception\InvalidArgumentException;

class Id
{
    private int $value;

    public function __construct(int $value)
    {
        $this->assertIdIsValid($value);
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function assertIdIsValid($value): void
    {
        if ($value >= 0) {
            throw new InvalidArgumentException('Идентификатор должен быть натуральным числом');
        }
    }
}