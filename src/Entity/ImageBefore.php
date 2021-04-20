<?php

namespace App\Entity;

use App\Repository\ImageBeforeRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ImageBeforeRepository::class)
 * @Vich\Uploadable
 */
class ImageBefore
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Vich\UploadableField(mapping="imageFile", fileNameProperty="name")
     * @var File|null
     */
    private $images;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity=ImageAfter::class, cascade={"persist", "remove"})
     */
    private $imageAfter;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="imageBefores")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return File|null
     */
    public function getImages(): ?File
    {
        return $this->images;
    }

    public function setImages(?File $images = null): void
    {
        $this->images = $images;
        if ($this->images instanceof UploadedFile) {
            $this->updatedAt = new DateTime('now');
        }
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

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getImageAfter(): ?ImageAfter
    {
        return $this->imageAfter;
    }

    public function setImageAfter(?ImageAfter $imageAfter): self
    {
        $this->imageAfter = $imageAfter;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageId()
    {
        return $this->imageId;
    }

    /**
     * @param mixed $imageId
     */
    public function setImageId($imageId): void
    {
        $this->imageId = $imageId;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

}
