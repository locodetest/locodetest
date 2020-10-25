<?php

namespace App\Entity;

use App\Repository\LocodeRepository;
use App\Types\FunctionType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocodeRepository::class)
 * @ORM\Table(name="locode", options={"collate":"utf8mb4_general_ci", "charset":"utf8mb4"})
 */
class Locode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $Country;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $Location;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $NameWoDiacritics;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $Subdivision;

    /**
     * @ORM\Column(type="function_type")
     */
    private $Function;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $Status;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $Iata;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $Coordinates;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $Remarks;

    /**
     * Locode constructor.
     * @param $Country
     * @param $Location
     * @param $NameWoDiacritics
     * @param $Name
     * @param $Subdivision
     * @param $Function
     * @param $Status
     * @param $Date
     * @param $Iata
     * @param $Coordinates
     * @param $Remarks
     */
    public function __construct($Country, $Location, $Name, $NameWoDiacritics, $Subdivision, $Function, $Status, $Date, $Iata, $Coordinates, $Remarks)
    {
        $this->setCountry($Country);
        $this->setLocation($Location);
        $this->setName($Name);
        $this->setNameWoDiacritics($NameWoDiacritics);
        $this->setSubdivision($Subdivision);
        $this->setFunction($Function);
        $this->setStatus($Status);
        $this->setDate($Date);
        $this->setIata($Iata);
        $this->setCoordinates($Coordinates);
        $this->setRemarks($Remarks);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(string $Location): self
    {
        $this->Location = $Location;

        return $this;
    }

    public function getNameWoDiacritics(): ?string
    {
        return $this->NameWoDiacritics;
    }

    public function setNameWoDiacritics(string $NameWoDiacritics): self
    {
        $this->NameWoDiacritics = $NameWoDiacritics;

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

    public function getSubdivision(): ?string
    {
        return $this->Subdivision;
    }

    public function setSubdivision(string $Subdivision): self
    {
        $this->Subdivision = $Subdivision;

        return $this;
    }

    public function getFunction(): array
    {
        return $this->Function;
    }

    public function setFunction(array $Function): self
    {
        $this->Function = $Function;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getIata(): ?string
    {
        return $this->Iata;
    }

    public function setIata(string $Iata): self
    {
        $this->Iata = $Iata;

        return $this;
    }

    public function getCoordinates(): ?string
    {
        return $this->Coordinates;
    }

    public function setCoordinates(string $Coordinates): self
    {
        $this->Coordinates = $Coordinates;

        return $this;
    }

    public function getRemarks(): ?string
    {
        return $this->Remarks;
    }

    public function setRemarks(string $Remarks): self
    {
        $this->Remarks = $Remarks;

        return $this;
    }
}
