<?php

namespace App\Services;

use App\DTO\CompanyDto;
use App\Entity\Address;
use App\Entity\Company;
use App\Entity\CompanyHistoric;
use App\Repository\CompanyHistoricRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class CompanyService
{

    private EntityManagerInterface $entityManager;
    private CompanyHistoricRepository $companyHistoricRepository;

    public function __construct(EntityManagerInterface $entityManager, CompanyHistoricRepository $companyHistoricRepository)
    {
        $this->entityManager = $entityManager;
        $this->companyHistoricRepository = $companyHistoricRepository;
    }

    public function addCompany(CompanyDto $companyDto): int {
        $company = new Company();
        $company->setSiren($companyDto->siren);

        $this->_save($companyDto, $company);

        return $company->getId();
    }

    public function updateCompany(CompanyHistoric $companyHistoric, CompanyDto $companyDto): void {
        $company = $companyHistoric->getCompany();
        $company->setSiren($companyDto->siren);

        $this->_save($companyDto, $company);
    }

    private function _save(CompanyDto $companyDto, Company $company): void {
        $history = new CompanyHistoric();
        $history->setName($companyDto->name);
        $history->setCapital($companyDto->capital);
        $history->setLegalStatus($companyDto->legalStatus);
        $history->setRegistrationCity($companyDto->registrationCity);
        $history->setRegistrationDate($companyDto->registrationDate);
        $history->setCompany($company);

        /** @var Address $address */
        foreach ($companyDto->address as $address) {
            $newAdd = new Address();
            $newAdd->setCity($address->getCity());
            $newAdd->setChannelName($address->getChannelName());
            $newAdd->setChannelType($address->getChannelType());
            $newAdd->setNumber($address->getNumber());
            $newAdd->setPostalCode($address->getPostalCode());
            $history->addAddress($newAdd);
        }

        $this->entityManager->persist($history);
        $this->entityManager->flush();
    }

    public function getCompanyInformation(Company $company, ?DateTime $date = null): ?CompanyHistoric
    {
        if ($date) {
            return $this->companyHistoricRepository->findOneBy(['company' => $company, 'updatedDate' => $date], ['id' => 'DESC']);
        }
        return $this->companyHistoricRepository->findOneBy(['company' => $company], ['id' => 'DESC']);
    }
}