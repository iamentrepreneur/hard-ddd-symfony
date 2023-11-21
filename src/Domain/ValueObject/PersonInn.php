<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use http\Exception\InvalidArgumentException;

class PersonInn extends AbstractInn
{
    public function assertInnIsValid($value): void
    {
        if (!preg_match('/^\d{12}$/', $value)) {
            throw new InvalidArgumentException('ИНН физ.лица должен содержать 12 цифр');
        }
    }
}