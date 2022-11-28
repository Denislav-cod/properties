<?php

namespace App\Entity;

use App\Repository\TownRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TownRepository::class)]
class Town
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Neighborhood::class, inversedBy: 'towns')]
    private Collection $neighborhood;

    public function __construct()
    {
        $this->neighborhood = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Neighborhood>
     */
    public function getNeighborhood(): Collection
    {
        return $this->neighborhood;
    }

    public function addNeighborhood(Neighborhood $neighborhood): self
    {
        if (!$this->neighborhood->contains($neighborhood)) {
            $this->neighborhood->add($neighborhood);
        }

        return $this;
    }

    public function removeNeighborhood(Neighborhood $neighborhood): self
    {
        $this->neighborhood->removeElement($neighborhood);

        return $this;
    }
}
