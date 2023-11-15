<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EntityTrackingTrait;
use App\Entity\Trait\SlugTrait;
use App\Repository\ParentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParentsRepository::class)]
class Parents
{
    use CreatedAtTrait;
    use SlugTrait;
    //use EntityTrackingTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'parents', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Peres $pere = null;

    #[ORM\ManyToOne(inversedBy: 'parents', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Meres $mere = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPere(): ?Peres
    {
        return $this->pere;
    }

    public function setPere(?Peres $pere): static
    {
        $this->pere = $pere;

        return $this;
    }

    public function getMere(): ?Meres
    {
        return $this->mere;
    }

    public function setMere(?Meres $mere): static
    {
        $this->mere = $mere;

        return $this;
    }
}
