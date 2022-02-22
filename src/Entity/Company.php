<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 * @UniqueEntity("siren")
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=9, unique=true)
     */
    private string $siren;

    /**
     * @ORM\OneToMany(targetEntity=CompanyHistoric::class, mappedBy="company", orphanRemoval=true)
     */
    private Collection $companyHistorics;

    public function __construct()
    {
        $this->companyHistorics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    /**
     * @return Collection<int, CompanyHistoric>
     */
    public function getCompanyHistorics(): Collection
    {
        return $this->companyHistorics;
    }

    public function addCompanyHistoric(CompanyHistoric $companyHistoric): self
    {
        if (!$this->companyHistorics->contains($companyHistoric)) {
            $this->companyHistorics[] = $companyHistoric;
            $companyHistoric->setCompany($this);
        }

        return $this;
    }

    public function removeCompanyHistoric(CompanyHistoric $companyHistoric): self
    {
        if ($this->companyHistorics->removeElement($companyHistoric)) {
            // set the owning side to null (unless already changed)
            if ($companyHistoric->getCompany() === $this) {
                $companyHistoric->setCompany(null);
            }
        }

        return $this;
    }
}
