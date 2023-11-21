<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\Id;
use App\Domain\ValueObject\PersonBirthday;
use App\Domain\ValueObject\PersonInn;
use App\Domain\ValueObject\PersonName;
use App\Domain\ValueObject\PersonPassport;
use App\Domain\ValueObject\Phone;

class Person
{
    private Id $id;
    private PersonName $personName;
    private PersonInn $personInn;
    private PersonBirthday $personBirthday;
    private PersonPassport $personPassport;
    private Phone $phone;

    public function __construct(Id $id, PersonName $personName, PersonInn $personInn, PersonBirthday $personBirthday, PersonPassport $personPassport, Phone $phone)
    {
        $this->id = $id;
        $this->personName = $personName;
        $this->personInn = $personInn;
        $this->personBirthday = $personBirthday;
        $this->personPassport = $personPassport;
        $this->phone = $phone;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getPersonName(): PersonName
    {
        return $this->personName;
    }

    public function getPersonInn(): PersonInn
    {
        return $this->personInn;
    }

    public function getPersonBirthday(): PersonBirthday
    {
        return $this->personBirthday;
    }

    public function getPersonPassport(): PersonPassport
    {
        return $this->personPassport;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function setPersonName(PersonName $personName): Person
    {
        $this->personName = $personName;
        return $this;
    }

    public function setPersonInn(PersonInn $personInn): Person
    {
        $this->personInn = $personInn;
        return $this;
    }

    public function setPersonBirthday(PersonBirthday $personBirthday): Person
    {
        $this->personBirthday = $personBirthday;
        return $this;
    }

    public function setPersonPassport(PersonPassport $personPassport): Person
    {
        $this->personPassport = $personPassport;
        return $this;
    }

    public function setPhone(Phone $phone): Person
    {
        $this->phone = $phone;
        return $this;
    }

}
