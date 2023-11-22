<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Domain\Entity\Person;
use App\Domain\Repository\PersonRepositoryInterface;
use App\Domain\ValueObject\PersonBirthday;
use App\Domain\ValueObject\PersonInn;
use App\Domain\ValueObject\PersonName;
use App\Domain\ValueObject\PersonPassport;
use App\Domain\ValueObject\Phone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DebugController extends AbstractController
{
    private PersonRepositoryInterface $personRepository;

    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    #[Route('/debug')]
    public function debug(): void
    {
        $id = $this->personRepository->getNextId();

        // dd($id);

        $ivanov = new Person(
            $this->personRepository->getNextId(),
            PersonName::fromSurNameAndFirstNameAndMiddleName('Илья', 'Волков', 'Викторович'),
            new PersonInn('123456789012'),
            new PersonBirthday(new \DateTimeImmutable('1988-04-26')),
            new PersonPassport('4614', '540247', new \DateTimeImmutable('2014-04-01')),
            new Phone('9252228304')
        );

        dd($ivanov);
    }
}
