<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Domain\Entity\Company;
use App\Domain\Entity\Person;
use App\Domain\Repository\CompanyRepositoryInterface;
use App\Domain\Repository\PersonRepositoryInterface;
use App\Domain\ValueObject\CompanyInn;
use App\Domain\ValueObject\CompanyName;
use App\Domain\ValueObject\PersonBirthday;
use App\Domain\ValueObject\PersonInn;
use App\Domain\ValueObject\PersonName;
use App\Domain\ValueObject\PersonPassport;
use App\Domain\ValueObject\Phone;
use function Sodium\add;

class CreateCompanyUseCase
{
    private PersonRepositoryInterface $personRepository;
    private CompanyRepositoryInterface $companyRepository;

    public function __construct(PersonRepositoryInterface $personRepository, CompanyRepositoryInterface $companyRepository)
    {
        $this->personRepository = $personRepository;
        $this->companyRepository = $companyRepository;
    }

    public function execute(): int
    {
        $ivanov = new Person(
            $this->personRepository->getNextId(),
            PersonName::fromSurNameAndFirstNameAndMiddleName('Илья', 'Волков', 'Викторович'),
            new PersonInn('123456789012'),
            new PersonBirthday(new \DateTimeImmutable('1988-04-26')),
            new PersonPassport('4614', '540247', new \DateTimeImmutable('2014-04-01')),
            new Phone('9252228304')
        );

        $this->personRepository->add($ivanov);

        $petrov = new Person(
            $this->personRepository->getNextId(),
            PersonName::fromSurNameAndFirstNameAndMiddleName('Петр', 'Петров', 'Петрович'),
            new PersonInn('123456789012'),
            new PersonBirthday(new \DateTimeImmutable('1980-05-06')),
            new PersonPassport('1234', '456789', new \DateTimeImmutable('2010-01-01')),
            new Phone('9252228306')
        );

        $this->personRepository->add($petrov);

        $company = new Company(
            $this->companyRepository->getNextId(),
            new CompanyName('ООО Рога и Копыта'),
            new CompanyInn('9876543211'),
            new Phone('4951234567'),
            $petrov
        );

        $this->companyRepository->add($company);

        $company
            ->addSharedHolder($petrov)
            ->addSharedHolder($ivanov);

        return $company->getId()->getValue();
    }
}
