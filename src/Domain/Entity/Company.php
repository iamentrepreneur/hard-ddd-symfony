<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\CompanyInn;
use App\Domain\ValueObject\CompanyName;
use App\Domain\ValueObject\Id;
use App\Domain\ValueObject\Phone;

class Company
{
    private Id $id;
    private CompanyName $companyName;
    private CompanyInn $companyInn;
    private Phone $phone;
    private Person $ceo;
    private array $sharedHolders = [];

    public function __construct(Id $id, CompanyName $companyName, CompanyInn $companyInn, Phone $phone, Person $ceo)
    {
        $this->id = $id;
        $this->companyName = $companyName;
        $this->companyInn = $companyInn;
        $this->phone = $phone;
        $this->ceo = $ceo;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getCompanyName(): CompanyName
    {
        return $this->companyName;
    }

    public function getCompanyInn(): CompanyInn
    {
        return $this->companyInn;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function getCeo(): Person
    {
        return $this->ceo;
    }

    /**
     * @return Person[]
     */
    public function getSharedHolders(): array
    {
        return $this->sharedHolders;
    }

    public function setCompanyName(CompanyName $companyName): Company
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function setCompanyInn(CompanyInn $companyInn): Company
    {
        $this->companyInn = $companyInn;

        return $this;
    }

    public function setPhone(Phone $phone): Company
    {
        $this->phone = $phone;

        return $this;
    }

    public function setCeo(Person $ceo): Company
    {
        $this->ceo = $ceo;

        return $this;
    }

    public function setSharedHolders(array $sharedHolders): Company
    {
        $this->sharedHolders = $sharedHolders;

        return $this;
    }

    public function addSharedHolder(Person $person): Company
    {
        $personKey = $person->getId()->getValue();
        if (!array_key_exists($personKey, $this->sharedHolders)) {
            $this->sharedHolders[$personKey] = $person;
        }

        return $this;
    }

    public function removeSharedHolder(Person $person): Company
    {
        $personKey = $person->getId()->getValue();
        if (array_key_exists($personKey, $this->sharedHolders)) {
            unset($this->sharedHolders[$personKey]);
        }

        return $this;
    }
}
