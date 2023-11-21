<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use http\Exception\InvalidArgumentException;

class PersonPassport
{
    private string $serial;
    private string $number;
    private \DateTimeImmutable $date;

    public function __construct(string $serial, string $number, \DateTimeImmutable $date)
    {
        $this->serial = $serial;
        $this->number = $number;
        $this->date = $date;
    }

    public function assertSerialIsValid($value): void
    {
        if (!preg_match('/^\d{4}$/', $value)) {
            throw new InvalidArgumentException('Серия должна содержать 4 цифры');
        }
    }

    public function assertNumberIsValid($value): void
    {
        if (!preg_match('/^\d{6}$/', $value)) {
            throw new InvalidArgumentException('Номер должен содержать 6 цифр');
        }
    }

    public function assertDateIsValid($value): void
    {
        if ($value > new \DateTimeImmutable()) {
            throw new InvalidArgumentException('Дата выдачи паспорта должна быть вв прошлом');
        }
    }

    public function getSerial(): string
    {
        return $this->serial;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function getFullPassportInformation(): string
    {
        return "Паспорт {$this->serial} {$this->number}, выдан: {$this->date->format('d.m.y')}";
    }
}
