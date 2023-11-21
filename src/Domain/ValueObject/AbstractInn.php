<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

abstract class AbstractInn
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->assertInnIsValid($value);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    abstract protected function assertInnIsValid($value);
}