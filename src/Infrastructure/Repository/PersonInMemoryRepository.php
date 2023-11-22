<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Person;
use App\Domain\Repository\PersonRepositoryInterface;
use App\Domain\ValueObject\Id;

class PersonInMemoryRepository implements PersonRepositoryInterface
{
    private array $entities = [];

    public function add(Person $person): void
    {
        $entityKey = $person->getId()->getValue();
        if (!array_key_exists($entityKey, $this->entities)) {
            $this->entities[$entityKey] = $person;
        }
    }

    public function remove(Person $person): void
    {
        $entityKey = $person->getId()->getValue();
        if (array_key_exists($entityKey, $this->entities)) {
            unset($this->entities[$entityKey]);
        }
    }

    public function getById(Id $id): ?Person
    {
        $entityKey = $id->getValue();
        return $this->entities[$entityKey] ?? null;
    }

    public function getNextId(): Id
    {
        return new Id(count($this->entities) + 1);
    }
}