<?php

namespace App\DTO;

use App\Entity\CompanyHistoric;
use App\Entity\LegalStatus;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CompanyDto
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(9)
     */
    public string $siren;

    /**
     * @Assert\NotBlank()
     */
    public string $name;

    /**
     * @Assert\NotBlank()
     */
    public string $registrationCity;

    /**
     * @Assert\NotBlank()
     */
    public DateTimeInterface $registrationDate;

    /**
     * @Assert\NotBlank()
     */
    public int $capital;

    /**
     * @Assert\NotBlank()
     */
    public LegalStatus $legalStatus;

    /**
     * @Assert\NotBlank()
     */
    public $address;

    public static function fromHistory(CompanyHistoric $companyHistory): self {
        $dto = new self();
        $dto->name = $companyHistory->getName();
        $dto->siren = $companyHistory->getCompany()->getSiren();
        $dto->address = $companyHistory->getAddresses();
        $dto->capital = $companyHistory->getCapital();
        $dto->registrationDate = $companyHistory->getRegistrationDate();
        $dto->registrationCity = $companyHistory->getRegistrationCity();
        $dto->legalStatus = $companyHistory->getLegalStatus();

        return $dto;
    }
}