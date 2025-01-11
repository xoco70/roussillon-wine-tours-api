<?php

namespace App\Entity;

use App\Repository\WinemakerRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: WinemakerRepository::class)]
class Winemaker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @param $genre
     * @param $firstName
     * @param $lastName
     * @param $cellPhone
     * @param $source
     * @param $winehouse
     */
    public function __construct($genre, $firstName, $lastName, $cellPhone, $source, $winehouse)
    {
        $this->genre = $genre;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->cellPhone = $cellPhone;
        $this->source = $source;
        $this->winehouse = $winehouse;

    }

    public function getId(): ?int
    {
        return $this->id;
    }


    #[ORM\Column(type: 'boolean', nullable: false, options: ['default' => true])]
    private $genre; // Monsieur = true, Madame = False
    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private $firstName;
    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private $lastName;
    #[ORM\Column(type: 'string', length: 20, nullable: false)]
    private $cellPhone;
    #[ORM\Column(type: 'integer', nullable: true)]
    private $source;
    #[ORM\OneToOne(targetEntity: Winehouse::class, mappedBy: 'winemaker', cascade: ['persist'], orphanRemoval: true)]
    #[Ignore]
    private ?Winehouse $winehouse;

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getCellPhone()
    {
        return $this->cellPhone;
    }

    /**
     * @param mixed $cellPhone
     */
    public function setCellPhone($cellPhone): void
    {
        $this->cellPhone = $cellPhone;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source): void
    {
        $this->source = $source;
    }

    public function getWinehouse(): Winehouse
    {
        return $this->winehouse;
    }

    public function setWinehouse(?Winehouse $winehouse): self
    {
        $this->winehouse = $winehouse;
        if ($winehouse !== null) {
            $winehouse->setWinemaker($this); // Lien inverse
        }
        return $this;
    }
}
