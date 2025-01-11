<?php

namespace App\Entity;

use App\Repository\WinehouseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WinehouseRepository::class)]
class Winehouse
{
    // Documents à envoyer
    //Document d'identification de l'entreprise souvent nécessaire
    //Nom, date de naissance, adresse du représentant du compte de Winalist (Vous) Obligatoire
    //Pièce d'identité du représentant du compte Winalist (Vous) Obligatoire
    //Justificatif de domicile du représentant du compte Winalist (Vous) parfois
    //Nom, date de naissance, adresse du propriétaire de l'entreprise parfois
    //Pièce d'identité du propriétaire de l'entreprise parfois
    //Preuve de l'adresse du propriétaire de la société parfois
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $address;

    #[ORM\Column(type: 'string', length: 100)]
    private string $city;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $region;

    #[ORM\Column(type: 'string', length: 20)]
    private string $zipCode;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    private int $averageVisitorsPerMonth;

    #[ORM\Column(type: 'text', nullable: true)]
    private string $description;

    #[ORM\OneToOne(inversedBy: 'winehouse')]
    private ?Winemaker $winemaker = null;

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
     * @param $zipCode
     * @param $description
     * @param $averageVisitorsPerMonth
 */
    public function __construct($name, $address, $city, $region, $zipCode, $description,$winemaker, $averageVisitorsPerMonth) // $winemaker, $experiences
    {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->region = $region;
        $this->zipCode = $zipCode;
        $this->description = $description;
        $this->winemaker = $winemaker;
//        $this->experiences = $experiences;
        $this->averageVisitorsPerMonth = $averageVisitorsPerMonth;
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

    /**
     * @param mixed $averageVisitorsPerMonth
     */
    public function setAverageVisitorsPerMonth($averageVisitorsPerMonth): void
    {
        $this->averageVisitorsPerMonth = $averageVisitorsPerMonth;
    }

    /**
     * @return mixed
     */
    public function getAverageVisitorsPerMonth()
    {
        return $this->averageVisitorsPerMonth;
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
    public function getWinemaker()
    {
        return $this->winemaker;
    }

    /**
     * @param mixed $winemaker
     */
    public function setWinemaker(?Winemaker $winemaker): self
    {
        $this->winemaker = $winemaker;
        if ($winemaker !== null) {
            $winemaker->setWinehouse($this); // Lien inverse
        }
        return $this;
    }
}
