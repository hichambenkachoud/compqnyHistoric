<?php

namespace App\Entity;

use App\Repository\CompanyHistoricRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyHistoricRepository::class)
 */
class CompanyHistoric
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private string $registrationCity;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $registrationDate;

    /**
     * @ORM\Column(type="integer")
     */
    private int $capital;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $updatedDate;

    /**
     * @ORM\ManyToOne(targetEntity=LegalStatus::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private LegalStatus $legalStatus;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="companyHistorics", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private Company $company;

    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="companyHistoric", orphanRemoval=true, cascade={"persist"})
     */
    private Collection $addresses;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->updatedDate = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRegistrationCity(): ?string
    {
        return $this->registrationCity;
    }

    public function setRegistrationCity(string $registrationCity): self
    {
        $this->registrationCity = $registrationCity;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTimeInterface $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    public function getCapital(): ?int
    {
        return $this->capital;
    }

    public function setCapital(int $capital): self
    {
        $this->capital = $capital;

        return $this;
    }

    public function getUpdatedDate(): DateTimeInterface
    {
        return $this->updatedDate;
    }


    public function setUpdatedDate(DateTimeInterface $updatedDate): void
    {
        $this->updatedDate = $updatedDate;
    }

    public function getLegalStatus(): ?LegalStatus
    {
        return $this->legalStatus;
    }

    public function setLegalStatus(?LegalStatus $legalStatus): self
    {
        $this->legalStatus = $legalStatus;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->setCompanyHistoric($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getCompanyHistoric() === $this) {
                $address->setCompanyHistoric(null);
            }
        }

        return $this;
    }
}
