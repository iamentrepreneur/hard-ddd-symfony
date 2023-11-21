<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use http\Exception\InvalidArgumentException;

class CompanyName
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function assertCompanyNameIsValid($value): void
    {
        if (!preg_match('/^ООО .+/u', $value)) {
            throw new InvalidArgumentException('Название компании должно начинаться с ООО');
        }
    }
}
