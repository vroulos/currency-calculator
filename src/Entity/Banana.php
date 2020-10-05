<?php

namespace App\Entity;

use App\Repository\BananaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BananaRepository::class)
 */
class Banana
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
    private $FromCurrencyId;

    /**
     * @ORM\Column(type="integer")
     */
    private $ToCurrencyId;

    /**
     * @ORM\Column(type="date")
     */
    private $RateDate;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=10)
     */
    private $ExchangeRate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromCurrencyId(): ?int
    {
        return $this->FromCurrencyId;
    }

    public function setFromCurrencyId(int $FromCurrencyId): self
    {
        $this->FromCurrencyId = $FromCurrencyId;

        return $this;
    }

    public function getToCurrencyId(): ?int
    {
        return $this->ToCurrencyId;
    }

    public function setToCurrencyId(int $ToCurrencyId): self
    {
        $this->ToCurrencyId = $ToCurrencyId;

        return $this;
    }

    public function getRateDate(): ?\DateTimeInterface
    {
        return $this->RateDate;
    }

    public function setRateDate(\DateTimeInterface $RateDate): self
    {
        $this->RateDate = $RateDate;

        return $this;
    }

    public function getExchangeRate(): ?string
    {
        return $this->ExchangeRate;
    }

    public function setExchangeRate(string $ExchangeRate): self
    {
        $this->ExchangeRate = $ExchangeRate;

        return $this;
    }
}
