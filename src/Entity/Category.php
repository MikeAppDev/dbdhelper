<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\ManyToMany(targetEntity: Build::class, inversedBy: 'categories')]
    private Collection $builds;

    #[ORM\ManyToMany(targetEntity: Killer::class, mappedBy: 'categories')]
    private Collection $killers;

    public function __construct()
    {
        $this->builds = new ArrayCollection();
        $this->killers = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, Build>
     */
    public function getBuilds(): Collection
    {
        return $this->builds;
    }

    public function addBuild(Build $build): self
    {
        if (!$this->builds->contains($build)) {
            $this->builds->add($build);
        }

        return $this;
    }

    public function removeBuild(Build $build): self
    {
        $this->builds->removeElement($build);

        return $this;
    }

    /**
     * @return Collection<int, Killer>
     */
    public function getKillers(): Collection
    {
        return $this->killers;
    }

    public function addKiller(Killer $killer): self
    {
        if (!$this->killers->contains($killer)) {
            $this->killers->add($killer);
        }

        return $this;
    }

    public function removeKiller(Killer $killer): self
    {
        $this->killers->removeElement($killer);

        return $this;
    }
}
