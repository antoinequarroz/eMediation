<?php

namespace App\Entity;

use App\Repository\CycleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CycleRepository::class)
 */
class Cycle
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
     * @ORM\OneToMany(targetEntity=Podcast::class, mappedBy="cycle")
     */
    private $podcasts;

    /**
     * @ORM\OneToMany(targetEntity=Podcast::class, mappedBy="cycles")
     */
    private $cycles;

    /**
     * @ORM\OneToMany(targetEntity=Podcast::class, mappedBy="cycle")
     */
    private $cycle;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="cycle")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity=OffreCulturelle::class, mappedBy="cycle")
     */
    private $offreCulturelles;

    /**
     * @ORM\OneToMany(targetEntity=Lives::class, mappedBy="cycle")
     */
    private $lives;

    public function __construct()
    {
        $this->podcasts = new ArrayCollection();
        $this->cycles = new ArrayCollection();
        $this->cycle = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->offreCulturelles = new ArrayCollection();
        $this->lives = new ArrayCollection();
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
            $podcast->setCycle($this);
        }

        return $this;
    }

    public function removePodcast(Podcast $podcast): self
    {
        if ($this->podcasts->removeElement($podcast)) {
            // set the owning side to null (unless already changed)
            if ($podcast->getCycle() === $this) {
                $podcast->setCycle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Podcast[]
     */
    public function getCycles(): Collection
    {
        return $this->cycles;
    }

    public function addCycle(Podcast $cycle): self
    {
        if (!$this->cycles->contains($cycle)) {
            $this->cycles[] = $cycle;
            $cycle->setCycles($this);
        }

        return $this;
    }

    public function removeCycle(Podcast $cycle): self
    {
        if ($this->cycles->removeElement($cycle)) {
            // set the owning side to null (unless already changed)
            if ($cycle->getCycles() === $this) {
                $cycle->setCycles(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Podcast[]
     */
    public function getCycle(): Collection
    {
        return $this->cycle;
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
            $product->setCycle($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCycle() === $this) {
                $product->setCycle(null);
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
            $offreCulturelle->setCycle($this);
        }

        return $this;
    }

    public function removeOffreCulturelle(OffreCulturelle $offreCulturelle): self
    {
        if ($this->offreCulturelles->removeElement($offreCulturelle)) {
            // set the owning side to null (unless already changed)
            if ($offreCulturelle->getCycle() === $this) {
                $offreCulturelle->setCycle(null);
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
            $life->setCycle($this);
        }

        return $this;
    }

    public function removeLife(Lives $life): self
    {
        if ($this->lives->removeElement($life)) {
            // set the owning side to null (unless already changed)
            if ($life->getCycle() === $this) {
                $life->setCycle(null);
            }
        }

        return $this;
    }
}
