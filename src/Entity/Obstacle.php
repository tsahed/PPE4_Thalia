<?php

namespace App\Entity;

use App\Repository\ObstacleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObstacleRepository::class)
 */
class Obstacle
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
    private $nom;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeObstacle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $echec;

    /**
     * @ORM\Column(type="time")
     */
    private $tempsPassage;

    /**
     * @ORM\ManyToMany(targetEntity=Obstacle::class, inversedBy="obstacles")
     */
    private $positionObstacle;

    /**
     * @ORM\ManyToMany(targetEntity=Obstacle::class, mappedBy="positionObstacle")
     */
    private $obstacles;

    public function __construct()
    {
        $this->positionObstacle = new ArrayCollection();
        $this->obstacles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getTypeObstacle(): ?string
    {
        return $this->typeObstacle;
    }

    public function setTypeObstacle(string $typeObstacle): self
    {
        $this->typeObstacle = $typeObstacle;

        return $this;
    }

    public function getEchec(): ?int
    {
        return $this->echec;
    }

    public function setEchec(?int $echec): self
    {
        $this->echec = $echec;

        return $this;
    }

    public function getTempsPassage(): ?\DateTimeInterface
    {
        return $this->tempsPassage;
    }

    public function setTempsPassage(\DateTimeInterface $tempsPassage): self
    {
        $this->tempsPassage = $tempsPassage;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getPositionObstacle(): Collection
    {
        return $this->positionObstacle;
    }

    public function addPositionObstacle(self $positionObstacle): self
    {
        if (!$this->positionObstacle->contains($positionObstacle)) {
            $this->positionObstacle[] = $positionObstacle;
        }

        return $this;
    }

    public function removePositionObstacle(self $positionObstacle): self
    {
        $this->positionObstacle->removeElement($positionObstacle);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getObstacles(): Collection
    {
        return $this->obstacles;
    }

    public function addObstacle(self $obstacle): self
    {
        if (!$this->obstacles->contains($obstacle)) {
            $this->obstacles[] = $obstacle;
            $obstacle->addPositionObstacle($this);
        }

        return $this;
    }

    public function removeObstacle(self $obstacle): self
    {
        if ($this->obstacles->removeElement($obstacle)) {
            $obstacle->removePositionObstacle($this);
        }

        return $this;
    }
}
