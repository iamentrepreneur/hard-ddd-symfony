<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Company;
use App\Domain\Repository\CompanyRepositoryInterface;
use App\Domain\ValueObject\Id;

class CompanyInMemoryRepository implements CompanyRepositoryInterface
{
    private array $entities = [];
    public function add(Company $person): void
    {
        $entityKey = $person->getId()->getValue();
        if (!array_key_exists($entityKey, $this->entities)) {
            $this->entities[$entityKey] = $person;
        }
    }

    public function remove(Company $person): void
    {
        $entityKey = $person->getId()->getValue();
        if (array_key_exists($entityKey, $this->entities)) {
            unset($this->entities[$entityKey]);
        }
    }

    public function getById(Id $id)
    {
        $entityKey = $id->getValue();

        return $this->entities[$entityKey] ?? null;
    }

    public function getNextId(): Id
    {
        return new Id(count($this->entities) + 1);
    }
}
