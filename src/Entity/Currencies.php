<?php

namespace App\Entity;

use App\Repository\CurrenciesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CurrenciesRepository::class)
 */
class Currencies
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $CurrencyId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ISO_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCurrencyId(): ?int
    {
        return $this->CurrencyId;
    }

    public function setCurrencyId(int $CurrencyId): self
    {
        $this->CurrencyId = $CurrencyId;

        return $this;
    }

    public function getISOCode(): ?string
    {
        return $this->ISO_code;
    }

    public function setISOCode(?string $ISO_code): self
    {
        $this->ISO_code = $ISO_code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }
}
