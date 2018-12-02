<?php

namespace Langeland\AnvilCore\Domain\Model;

/*
 * This file is part of the Langeland.AnvilCore package.
 */

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Unit
{

    /**
     * @var integer
     *
     * @Flow\Identity
     * @ORM\Id
     */
    protected $code;

    /**
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(nullable=true)
     * @var string|null
     */
    protected $street;

    /**
     * @ORM\Column(nullable=true)
     * @var integer|null
     */
    protected $number;

    /**
     * @ORM\Column(nullable=true)
     * @var string|null
     */
    protected $zipcode;

    /**
     * @ORM\Column(nullable=true)
     * @var string|null
     */
    protected $city;

    /**
     * @ORM\Column(nullable=true)
     * @var float|null
     */
    protected $latitude;

    /**
     * @ORM\Column(nullable=true)
     * @var float|null
     */
    protected $longitude;

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return Unit
     */
    public function setCode(int $code): Unit
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Unit
     */
    public function setName(string $name): Unit
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     * @return Unit
     */
    public function setStreet(?string $street): Unit
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int|null $number
     * @return Unit
     */
    public function setNumber(?int $number): Unit
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    /**
     * @param string|null $zipcode
     * @return Unit
     */
    public function setZipcode(?string $zipcode): Unit
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return Unit
     */
    public function setCity(?string $city): Unit
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float|null $latitude
     * @return Unit
     */
    public function setLatitude(?float $latitude): Unit
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float|null $longitude
     * @return Unit
     */
    public function setLongitude(?float $longitude): Unit
    {
        $this->longitude = $longitude;
        return $this;
    }


}
