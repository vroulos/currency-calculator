<?php

namespace App\Entity;

use App\Repository\CurrencyExchanerateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CurrencyExchanerateRepository::class)
 */
class CurrencyExchangerate
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
    private $CurrencyExchangerateId;

    /**
     * @ORM\Column(type="integer")
     */
    private $FromCurrentId;

    /**
     * @ORM\Column(type="integer")
     */
    private $ToCurrencyId;

    /**
     * @ORM\Column(type="date")
     */
    private $RateDate;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $ExchangeRate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCurrencyExchangerateId(): ?int
    {
        return $this->CurrencyExchangerateId;
    }

    public function setCurrencyExchangerateId(int $CurrencyExchangerateId): self
    {
        $this->CurrencyExchangerateId = $CurrencyExchangerateId;

        return $this;
    }

    public function getFromCurrentId(): ?int
    {
        return $this->FromCurrentId;
    }

    public function setFromCurrentId(int $FromCurrentId): self
    {
        $this->FromCurrentId = $FromCurrentId;

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
