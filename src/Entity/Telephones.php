<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use App\Entity\Trait\SlugTrait;
use App\Repository\TelephonesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TelephonesRepository::class)]
class Telephones
{
    use CreatedAtTrait;
    use SlugTrait;
    //use EntityTrackingTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 12)]
    private ?string $numero = null;

    #[ORM\OneToOne(mappedBy: 'telephone1', cascade: ['persist', 'remove'])]
    private ?Meres $mere1 = null;

    #[ORM\OneToOne(mappedBy: 'telephone2', cascade: ['persist', 'remove'])]
    private ?Meres $mere2 = null;

    #[ORM\OneToOne(mappedBy: 'telephone1', cascade: ['persist', 'remove'])]
    private ?Peres $pere1 = null;

    #[ORM\OneToOne(mappedBy: 'telephone2', cascade: ['persist', 'remove'])]
    private ?Peres $pere2 = null;

    public function __toString()
    {
        return $this->numero;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getMere1(): ?Meres
    {
        return $this->mere1;
    }

    public function setMere1(?Meres $mere1): static
    {
        // unset the owning side of the relation if necessary
        if ($mere1 === null && $this->mere1 !== null) {
            $this->mere1->setTelephone1(null);
        }

        // set the owning side of the relation if necessary
        if ($mere1 !== null && $mere1->getTelephone1() !== $this) {
            $mere1->setTelephone1($this);
        }

        $this->mere1 = $mere1;

        return $this;
    }

    public function getMere2(): ?Meres
    {
        return $this->mere2;
    }

    public function setMere2(?Meres $mere2): static
    {
        // unset the owning side of the relation if necessary
        if ($mere2 === null && $this->mere2 !== null) {
            $this->mere2->setTelephone2(null);
        }

        // set the owning side of the relation if necessary
        if ($mere2 !== null && $mere2->getTelephone2() !== $this) {
            $mere2->setTelephone2($this);
        }

        $this->mere2 = $mere2;

        return $this;
    }

    public function getPere1(): ?Peres
    {
        return $this->pere1;
    }

    public function setPere1(Peres $pere1): static
    {
        // set the owning side of the relation if necessary
        if ($pere1->getTelephone1() !== $this) {
            $pere1->setTelephone1($this);
        }

        $this->pere1 = $pere1;

        return $this;
    }

    public function getPere2(): ?Peres
    {
        return $this->pere2;
    }

    public function setPere2(?Peres $pere2): static
    {
        // unset the owning side of the relation if necessary
        if ($pere2 === null && $this->pere2 !== null) {
            $this->pere2->setTelephone2(null);
        }

        // set the owning side of the relation if necessary
        if ($pere2 !== null && $pere2->getTelephone2() !== $this) {
            $pere2->setTelephone2($this);
        }

        $this->pere2 = $pere2;

        return $this;
    }
}
