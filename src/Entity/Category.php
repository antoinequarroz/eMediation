<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="category")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity=Lives::class, mappedBy="category")
     */
    private $lives;

    /**
     * @ORM\OneToMany(targetEntity=Podcast::class, mappedBy="category")
     */
    private $podcasts;

    /**
     * @ORM\OneToMany(targetEntity=OffreCulturelle::class, mappedBy="category")
     */
    private $offreCulturelles;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->lives = new ArrayCollection();
        $this->podcasts = new ArrayCollection();
        $this->offreCulturelles = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
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
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lives[]
     */
    public function getLives(): Collection
    {
        return $this->lives;
    }

    public function addLife(Lives $life): self
    {
        if (!$this->lives->contains($life)) {
            $this->lives[] = $life;
            $life->setCategory($this);
        }

        return $this;
    }

    public function removeLife(Lives $life): self
    {
        if ($this->lives->removeElement($life)) {
            // set the owning side to null (unless already changed)
            if ($life->getCategory() === $this) {
                $life->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Podcast[]
     */
    public function getPodcasts(): Collection
    {
        return $this->podcasts;
    }

    public function addPodcast(Podcast $podcast): self
    {
        if (!$this->podcasts->contains($podcast)) {
            $this->podcasts[] = $podcast;
            $podcast->setCategory($this);
        }

        return $this;
    }

    public function removePodcast(Podcast $podcast): self
    {
        if ($this->podcasts->removeElement($podcast)) {
            // set the owning side to null (unless already changed)
            if ($podcast->getCategory() === $this) {
                $podcast->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OffreCulturelle[]
     */
    public function getOffreCulturelles(): Collection
    {
        return $this->offreCulturelles;
    }

    public function addOffreCulturelle(OffreCulturelle $offreCulturelle): self
    {
        if (!$this->offreCulturelles->contains($offreCulturelle)) {
            $this->offreCulturelles[] = $offreCulturelle;
            $offreCulturelle->setCategory($this);
        }

        return $this;
    }

    public function removeOffreCulturelle(OffreCulturelle $offreCulturelle): self
    {
        if ($this->offreCulturelles->removeElement($offreCulturelle)) {
            // set the owning side to null (unless already changed)
            if ($offreCulturelle->getCategory() === $this) {
                $offreCulturelle->setCategory(null);
            }
        }

        return $this;
    }
}
