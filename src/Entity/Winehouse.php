<?php

namespace App\Entity;

use App\Repository\WinehouseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WinehouseRepository::class)]
class Winehouse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $address;

    #[ORM\Column(type: 'string', length: 100)]
    private $city;

    #[ORM\Column(type: 'string', length: 100)]
    private $region;

    #[ORM\Column(type: 'string', length: 100)]
    private $country;

    #[ORM\Column(type: 'string', length: 20)]
    private $zipCode;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

//    #[ORM\ManyToOne(targetEntity: Winemaker::class, inversedBy: 'winehouses')]
//    #[ORM\JoinColumn(nullable: false)]
//    private $winemaker;

//    #[ORM\OneToMany(mappedBy: 'winehouse', targetEntity: Experience::class)]
//    private $experiences;

//    public function __construct()
//    {
//        $this->experiences = new ArrayCollection();
//    }
    /**
     * @param $name
     * @param $address
     * @param $city
     * @param $region
     * @param $country
     * @param $zipCode
     * @param $description
//     * @param $winemaker
//     * @param $experiences
     */
    public function __construct($name, $address, $city, $region, $country, $zipCode, $description) // $winemaker, $experiences
    {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->region = $region;
        $this->country = $country;
        $this->zipCode = $zipCode;
        $this->description = $description;
//        $this->winemaker = $winemaker;
//        $this->experiences = $experiences;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region): void
    {
        $this->region = $region;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $zipCode
     */
    public function setZipCode($zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    // Getters et setters
    public function setPublishedAt(\DateTime $param)
    {
    }
}
