<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SalleRepository::class)
 */
class Salle
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
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity=Partie::class, inversedBy="salle")
     */
    private $partie;

    /**
     * @ORM\ManyToOne(targetEntity=Avis::class, inversedBy="salles")
     */
    private $Avis;

    /**
     * @ORM\OneToMany(targetEntity=Themes::class, mappedBy="salle")
     */
    private $themes;

    public function __construct()
    {
        $this->themes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPartie(): ?Partie
    {
        return $this->partie;
    }

    public function setPartie(?Partie $partie): self
    {
        $this->partie = $partie;

        return $this;
    }

    public function getAvis(): ?Avis
    {
        return $this->Avis;
    }

    public function setAvis(?Avis $Avis): self
    {
        $this->Avis = $Avis;

        return $this;
    }

    /**
     * @return Collection|Themes[]
     */
    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(Themes $theme): self
    {
        if (!$this->themes->contains($theme)) {
            $this->themes[] = $theme;
            $theme->setSalle($this);
        }

        return $this;
    }

    public function removeTheme(Themes $theme): self
    {
        if ($this->themes->removeElement($theme)) {
            // set the owning side to null (unless already changed)
            if ($theme->getSalle() === $this) {
                $theme->setSalle(null);
            }
        }

        return $this;
    }
}
