<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
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
     * @ORM\OneToMany(targetEntity=ImagesRandom::class, mappedBy="categories")
     */
    private $images_random;

    /**
     * @ORM\OneToMany(targetEntity=ImageBefore::class, mappedBy="categories", orphanRemoval=true)
     */
    private $imageBefores;

    /**
     * @ORM\OneToMany(targetEntity=ImageAfter::class, mappedBy="categories", orphanRemoval=true)
     */
    private $imageAfters;


    public function __construct()
    {
        $this->images_random = new ArrayCollection();
        $this->imageBefores = new ArrayCollection();
        $this->imageAfters = new ArrayCollection();
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
     * @return Collection|ImagesRandom[]
     */
    public function getImagesRandom(): Collection
    {
        return $this->images_random;
    }

    public function addImagesRandom(ImagesRandom $imagesRandom): self
    {
        if (!$this->images_random->contains($imagesRandom)) {
            $this->images_random[] = $imagesRandom;
            $imagesRandom->setCategories($this);
        }

        return $this;
    }

    public function removeImagesRandom(ImagesRandom $imagesRandom): self
    {
        if ($this->images_random->removeElement($imagesRandom)) {
            // set the owning side to null (unless already changed)
            if ($imagesRandom->getCategories() === $this) {
                $imagesRandom->setCategories(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ImageBefore[]
     */
    public function getImageBefores(): Collection
    {
        return $this->imageBefores;
    }

    public function addImageBefore(ImageBefore $imageBefore): self
    {
        if (!$this->imageBefores->contains($imageBefore)) {
            $this->imageBefores[] = $imageBefore;
            $imageBefore->setCategories($this);
        }

        return $this;
    }

    public function removeImageBefore(ImageBefore $imageBefore): self
    {
        if ($this->imageBefores->removeElement($imageBefore)) {
            // set the owning side to null (unless already changed)
            if ($imageBefore->getCategories() === $this) {
                $imageBefore->setCategories(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ImageAfter[]
     */
    public function getImageAfters(): Collection
    {
        return $this->imageAfters;
    }

    public function addImageAfter(ImageAfter $imageAfter): self
    {
        if (!$this->imageAfters->contains($imageAfter)) {
            $this->imageAfters[] = $imageAfter;
            $imageAfter->setCategories($this);
        }

        return $this;
    }

    public function removeImageAfter(ImageAfter $imageAfter): self
    {
        if ($this->imageAfters->removeElement($imageAfter)) {
            // set the owning side to null (unless already changed)
            if ($imageAfter->getCategories() === $this) {
                $imageAfter->setCategories(null);
            }
        }

        return $this;
    }
}

