<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use http\Exception\InvalidArgumentException;

class PersonBirthday
{
    private \DateTimeImmutable $value;

    public function __construct(\DateTimeImmutable $value)
    {
        $this->assertDateIsInThePast($value);
        $this->value = $value;
    }

    public function assertDateIsInThePast($value): void
    {
        if ($value > new \DateTimeImmutable()) {
            throw new InvalidArgumentException('Дата рождения должна быть вв прошлом');
        }
    }

    public function getValue(): \DateTimeImmutable
    {
        return $this->value;
    }
}
