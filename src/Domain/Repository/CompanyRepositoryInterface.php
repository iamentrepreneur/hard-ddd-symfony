<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Company;
use App\Domain\ValueObject\Id;

interface CompanyRepositoryInterface
{
    public function add(Company $person);

    public function remove(Company $person);

    public function getById(Id $id);

    public function getNextId(): Id;
}