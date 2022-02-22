<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private int $number;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank()
     */
    private string $channelType;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank()
     */
    private string $channelName;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank()
     */
    private string $city;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private int $postalCode;

    /**
     * @ORM\ManyToOne(targetEntity=CompanyHistoric::class, inversedBy="addresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private CompanyHistoric $companyHistoric;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getChannelType(): ?string
    {
        return $this->channelType;
    }

    public function setChannelType(string $channelType): self
    {
        $this->channelType = $channelType;

        return $this;
    }

    public function getChannelName(): ?string
    {
        return $this->channelName;
    }

    public function setChannelName(string $channelName): self
    {
        $this->channelName = $channelName;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCompanyHistoric(): ?CompanyHistoric
    {
        return $this->companyHistoric;
    }

    public function setCompanyHistoric(?CompanyHistoric $companyHistoric): self
    {
        $this->companyHistoric = $companyHistoric;

        return $this;
    }
}
