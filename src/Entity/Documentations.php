<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\DocumentationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentationsRepository::class)]
class Documentations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

/**
 * @Assert\File(
 *     maxSize = "20M",
 *     mimeTypes = {"application/pdf"},
 *     mimeTypesMessage = "Please upload a valid PDF"
 * )
 */
    #[ORM\Column(length: 255)]
    private ?string $pdf = null;

    #[ORM\ManyToOne(inversedBy: 'documentations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DocumentCategory $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(string $pdf): static
    {
        $this->pdf = $pdf;

        return $this;
    }

    public function getCategory(): ?DocumentCategory
    {
        return $this->category;
    }

    public function setCategory(?DocumentCategory $category): static
    {
        $this->category = $category;

        return $this;
    }
}
