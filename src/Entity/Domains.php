<?php

namespace App\Entity;

use App\Repository\DomainsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DomainsRepository::class)
 */
class Domains
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
     * @ORM\OneToMany(targetEntity=Podcast::class, mappedBy="domaine")
     */
    private $podcast;

    /**
     * @ORM\OneToMany(targetEntity=Podcast::class, mappedBy="domains")
     */
    private $podcasts;

    /**
     * @ORM\OneToMany(targetEntity=Podcast::class, mappedBy="domaine")
     */
    private $types;

    /**
     * @ORM\OneToMany(targetEntity=Lives::class, mappedBy="domaine")
     */
    private $lives;

    /**
     * @ORM\OneToMany(targetEntity=OffreCulturelle::class, mappedBy="domaine")
     */
    private $offreCulturelles;

    /**
     * @ORM\OneToMany(targetEntity=OffreCulturelle::class, mappedBy="domaine")
     */
    private $offre;

    /**
     * @ORM\OneToMany(targetEntity=OffreCulturelle::class, mappedBy="domains")
     */
    private $domianes;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="domaine")
     */
    private $products;

    public function __construct()
    {
        $this->podcast = new ArrayCollection();
        $this->podcasts = new ArrayCollection();
        $this->types = new ArrayCollection();
        $this->lives = new ArrayCollection();
        $this->offreCulturelles = new ArrayCollection();
        $this->offre = new ArrayCollection();
        $this->domianes = new ArrayCollection();
        $this->products = new ArrayCollection();
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
    public function getPodcast(): Collection
    {
        return $this->podcast;
    }

    public function addPodcast(Podcast $podcast): self
    {
        if (!$this->podcast->contains($podcast)) {
            $this->podcast[] = $podcast;
            $podcast->setDomaine($this);
        }

        return $this;
    }

    public function removePodcast(Podcast $podcast): self
    {
        if ($this->podcast->removeElement($podcast)) {
            // set the owning side to null (unless already changed)
            if ($podcast->getDomaine() === $this) {
                $podcast->setDomaine(null);
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

    /**
     * @return Collection|Podcast[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Podcast $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
            $type->setDomaine($this);
        }

        return $this;
    }

    public function removeType(Podcast $type): self
    {
        if ($this->types->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getDomaine() === $this) {
                $type->setDomaine(null);
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
            $life->setDomaine($this);
        }

        return $this;
    }

    public function removeLife(Lives $life): self
    {
        if ($this->lives->removeElement($life)) {
            // set the owning side to null (unless already changed)
            if ($life->getDomaine() === $this) {
                $life->setDomaine(null);
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
            $offreCulturelle->setDomaine($this);
        }

        return $this;
    }

    public function removeOffreCulturelle(OffreCulturelle $offreCulturelle): self
    {
        if ($this->offreCulturelles->removeElement($offreCulturelle)) {
            // set the owning side to null (unless already changed)
            if ($offreCulturelle->getDomaine() === $this) {
                $offreCulturelle->setDomaine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OffreCulturelle[]
     */
    public function getOffre(): Collection
    {
        return $this->offre;
    }

    public function addOffre(OffreCulturelle $offre): self
    {
        if (!$this->offre->contains($offre)) {
            $this->offre[] = $offre;
            $offre->setDomaine($this);
        }

        return $this;
    }

    public function removeOffre(OffreCulturelle $offre): self
    {
        if ($this->offre->removeElement($offre)) {
            // set the owning side to null (unless already changed)
            if ($offre->getDomaine() === $this) {
                $offre->setDomaine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OffreCulturelle[]
     */
    public function getDomianes(): Collection
    {
        return $this->domianes;
    }

    public function addDomiane(OffreCulturelle $domiane): self
    {
        if (!$this->domianes->contains($domiane)) {
            $this->domianes[] = $domiane;
            $domiane->setDomains($this);
        }

        return $this;
    }

    public function removeDomiane(OffreCulturelle $domiane): self
    {
        if ($this->domianes->removeElement($domiane)) {
            // set the owning side to null (unless already changed)
            if ($domiane->getDomains() === $this) {
                $domiane->setDomains(null);
            }
        }

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
            $product->setDomaine($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getDomaine() === $this) {
                $product->setDomaine(null);
            }
        }

        return $this;
    }
}
