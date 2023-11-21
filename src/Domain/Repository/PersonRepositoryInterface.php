<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Person;
use App\Domain\ValueObject\Id;

interface PersonRepositoryInterface
{
    public function add(Person $person);

    public function remove(Person $person);

    public function getById(Id $id);

    public function getNextId(): Id;
}