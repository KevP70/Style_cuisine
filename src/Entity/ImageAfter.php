<?php

namespace App\Entity;

use App\Repository\ImageAfterRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ImageAfterRepository::class)
 * @Vich\Uploadable
 */
class ImageAfter
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity=ImageBefore::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private ImageBefore $ImageBefore;

    /**
     * @Vich\UploadableField(mapping="imageFile", fileNameProperty="imageName")
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $updatedAt = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $imageName = '';

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $imageId = '';

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="imageAfters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return ImageAfter
     */
    public function setId(?int $id): ImageAfter
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return ImageBefore
     */
    public function getImageBefore(): ImageBefore
    {
        return $this->ImageBefore;
    }

    /**
     * @param ImageBefore $imageTest
     * @return ImageAfter
     */
    public function setImageBefore(ImageBefore $ImageBefore): ImageAfter
    {
        $this->ImageBefore = $ImageBefore;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new DateTime('now');
        }
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeInterface|null $updatedAt
     * @return ImageAfter
     */
    public function setUpdatedAt(?DateTimeInterface $updatedAt): ImageAfter
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string|null $imageName
     * @return ImageAfter
     */
    public function setImageName(?string $imageName): ImageAfter
    {
        $this->imageName = $imageName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageId(): ?string
    {
        return $this->imageId;
    }

    /**
     * @param string|null $imageId
     * @return ImageAfter
     */
    public function setImageId(?string $imageId): ImageAfter
    {
        $this->imageId = $imageId;
        return $this;
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

