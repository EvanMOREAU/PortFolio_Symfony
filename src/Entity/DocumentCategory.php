<?php

namespace App\Entity;

use App\Repository\DocumentCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentCategoryRepository::class)]
class DocumentCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Documentations::class)]
    private Collection $documentations;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    public function __construct()
    {
        $this->documentations = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Documentations>
     */
    public function getDocumentations(): Collection
    {
        return $this->documentations;
    }

    public function addDocumentation(Documentations $documentation): static
    {
        if (!$this->documentations->contains($documentation)) {
            $this->documentations->add($documentation);
            $documentation->setCategory($this);
        }

        return $this;
    }

    public function removeDocumentation(Documentations $documentation): static
    {
        if ($this->documentations->removeElement($documentation)) {
            // set the owning side to null (unless already changed)
            if ($documentation->getCategory() === $this) {
                $documentation->setCategory(null);
            }
        }

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }
}
