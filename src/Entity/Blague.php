<?php

namespace App\Entity;

use App\Repository\BlagueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: BlagueRepository::class)]
class Blague
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $blague = null;

    #[ORM\ManyToOne(inversedBy: 'blagues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;
    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;
    /**
     * @var \DateTime $updatedAt
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    /**
     * @var User|null
     *
     * @Gedmo\Blameable(on="create")
     */
    #[ORM\ManyToOne(inversedBy: 'blagues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createdBy = null;

    /**
     * @var User|null
     *
     * @Gedmo\Blameable(on="update")
     */
    #[ORM\ManyToOne(inversedBy: 'blagues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $updatedBy = null;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBlague(): ?string
    {
        return $this->blague;
    }

    public function setBlague(string $blague): static
    {
        $this->blague = $blague;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    // public function setCreatedAt($createdAt)
    // {
    //     $this->createdAt = $createdAt;

    //     return $this;
    // }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    // public function setUpdatedAt($updatedAt)
    // {
    //     $this->updatedAt = $updatedAt;

    //     return $this;
    // }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    // public function setCreatedBy(?User $createdBy): static
    // {
    //     $this->createdBy = $createdBy;

    //     return $this;
    // }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    // public function setUpdatedBy(?User $updatedBy): static
    // {
    //     $this->updatedBy = $updatedBy;

    //     return $this;
    // }
}
