<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use http\Exception\InvalidArgumentException;

class PersonName
{
    private string $firstName;
    private string $surName;
    private ?string $middleName = null;

    private function __construct(string $firstName, string $surName, ?string $middleName)
    {
        $this->assertNameIsValid($firstName);
        $this->assertSurNameIsValid($surName);
        $this->assertMiddleNameIsValid($middleName);

        $this->firstName = $firstName;
        $this->surName = $surName;
        $this->middleName = $middleName;
    }

    public function getFullName(): string
    {
        $fullName = array_filter(
            [
                $this->surName,
                $this->firstName,
                $this->middleName,
            ]
        );

        return implode(' ', $fullName);
    }

    public function getAbbreviatedName(): string
    {
        $fullName = array_filter(
            [
                $this->firstName,
                $this->middleName,
            ]
        );
        $abbreviatedComponent = array_map(
            static fn ($string) => mb_substr($string, 0, 1).'.',
            $fullName
        );

        return $this->surName.' '.implode($abbreviatedComponent);
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getSurName(): string
    {
        return $this->surName;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public static function fromSurNameAndFirstName(string $firsName, string $surName): self
    {
        return new self(
            $firsName,
            $surName,
            null
        );
    }

    public static function fromSurNameAndFirstNameAndMiddleName(string $firsName, string $surName, $middleName): self
    {
        return new self(
            $firsName,
            $surName,
            $middleName
        );
    }

    public function assertNameIsValid($value): void
    {
        if (!preg_match('/^[А-ЯЁ][а-яё]+$/u', $value)) {
            throw new InvalidArgumentException('Имя должно состоять из русских символов');
        }
    }

    public function assertSurNameIsValid($value): void
    {
        if (!preg_match('/^[А-ЯЁ][а-яё]+$/u', $value)) {
            throw new InvalidArgumentException('Фамилия должно состоять из русских символов');
        }
    }

    public function assertMiddleNameIsValid($value): void
    {
        if (null === $value) {
            return;
        }
        if (!preg_match('/^[А-ЯЁ][а-яё]+$/u', $value)) {
            throw new InvalidArgumentException('Отчество должно состоять из русских символов');
        }
    }
}
