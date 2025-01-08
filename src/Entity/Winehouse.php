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

    #[ORM\ManyToOne(targetEntity: Winemaker::class, inversedBy: 'winehouses')]
    #[ORM\JoinColumn(nullable: false)]
    private $winemaker;

    #[ORM\OneToMany(mappedBy: 'winehouse', targetEntity: Experience::class)]
    private $experiences;

    public function __construct()
    {
        $this->experiences = new ArrayCollection();
    }

    // Getters et setters
}
