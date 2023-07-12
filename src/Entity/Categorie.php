<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Blague::class)]
    private Collection $blagues;

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
    #[ORM\ManyToOne(inversedBy: 'categories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createdBy = null;

    /**
     * @var User|null
     *
     * @Gedmo\Blameable(on="update")
     */
    #[ORM\ManyToOne(inversedBy: 'categories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $updatedBy = null;

    public function __construct()
    {
        $this->blagues = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->nom;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Blague>
     */
    public function getBlagues(): Collection
    {
        return $this->blagues;
    }

    public function addBlague(Blague $blague): static
    {
        if (!$this->blagues->contains($blague)) {
            $this->blagues->add($blague);
            $blague->setCategorie($this);
        }

        return $this;
    }

    public function removeBlague(Blague $blague): static
    {
        if ($this->blagues->removeElement($blague)) {
            // set the owning side to null (unless already changed)
            if ($blague->getCategorie() === $this) {
                $blague->setCategorie(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    // public function setCreatedAt(\DateTimeInterface $createdAt): static
    // {
    //     $this->createdAt = $createdAt;

    //     return $this;
    // }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    // public function setUpdatedAt(\DateTimeInterface $updatedAt): static
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
