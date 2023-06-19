<?php

namespace App\Entity;

use App\Repository\BuildRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuildRepository::class)]
class Build
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $featuredText = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updateAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'builds')]
    private Collection $categories;

    #[ORM\OneToMany(mappedBy: 'build', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\ManyToMany(targetEntity: Killer::class, mappedBy: 'builds')]
    private Collection $killers;

    #[ORM\ManyToMany(targetEntity: Perk::class, mappedBy: 'builds')]
    private Collection $perks;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->killers = new ArrayCollection();
        $this->perks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getFeaturedText(): ?string
    {
        return $this->featuredText;
    }

    public function setFeaturedText(?string $featuredText): self
    {
        $this->featuredText = $featuredText;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addBuild($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeBuild($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setBuild($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getBuild() === $this) {
                $comment->setBuild(null);
            }
        }

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
            $killer->addBuild($this);
        }

        return $this;
    }

    public function removeKiller(Killer $killer): self
    {
        if ($this->killers->removeElement($killer)) {
            $killer->removeBuild($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Perk>
     */
    public function getPerks(): Collection
    {
        return $this->perks;
    }

    public function addPerk(Perk $perk): self
    {
        if (!$this->perks->contains($perk)) {
            $this->perks->add($perk);
            $perk->addBuild($this);
        }

        return $this;
    }

    public function removePerk(Perk $perk): self
    {
        if ($this->perks->removeElement($perk)) {
            $perk->removeBuild($this);
        }

        return $this;
    }
}
