<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use http\Exception\InvalidArgumentException;

class CompanyInn extends AbstractInn
{
    protected function assertInnIsValid($value): void
    {
        if (!preg_match('/^\d{10}$/', $value)) {
            throw new InvalidArgumentException('ИНН физ.лица должен содержать 10 цифр');
        }
    }
}