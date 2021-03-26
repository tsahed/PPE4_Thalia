<?php

namespace App\Entity;

use App\Repository\PartieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PartieRepository::class)
 */
class Partie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $jour;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbJoueurs;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbObstacles;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $reussite;

    /**
     * @ORM\OneToMany(targetEntity=Client::class, mappedBy="partie")
     */
    private $client;

    /**
     * @ORM\ManyToMany(targetEntity=PositionObstacle::class, inversedBy="parties")
     */
    private $positionObstacle;

    /**
     * @ORM\OneToMany(targetEntity=Salle::class, mappedBy="partie")
     */
    private $salle;

    /**
     * @ORM\ManyToOne(targetEntity=PhotoClient::class, inversedBy="parties")
     */
    private $photoClient;

    public function __construct()
    {
        $this->client = new ArrayCollection();
        $this->positionObstacle = new ArrayCollection();
        $this->salle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?\DateTimeInterface
    {
        return $this->jour;
    }

    public function setJour(\DateTimeInterface $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getNbJoueurs(): ?int
    {
        return $this->nbJoueurs;
    }

    public function setNbJoueurs(int $nbJoueurs): self
    {
        $this->nbJoueurs = $nbJoueurs;

        return $this;
    }

    public function getNbObstacles(): ?int
    {
        return $this->nbObstacles;
    }

    public function setNbObstacles(int $nbObstacles): self
    {
        $this->nbObstacles = $nbObstacles;

        return $this;
    }

    public function getReussite(): ?bool
    {
        return $this->reussite;
    }

    public function setReussite(?bool $reussite): self
    {
        $this->reussite = $reussite;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(Client $client): self
    {
        if (!$this->client->contains($client)) {
            $this->client[] = $client;
            $client->setPartie($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getPartie() === $this) {
                $client->setPartie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PositionObstacle[]
     */
    public function getPositionObstacle(): Collection
    {
        return $this->positionObstacle;
    }

    public function addPositionObstacle(PositionObstacle $positionObstacle): self
    {
        if (!$this->positionObstacle->contains($positionObstacle)) {
            $this->positionObstacle[] = $positionObstacle;
        }

        return $this;
    }

    public function removePositionObstacle(PositionObstacle $positionObstacle): self
    {
        $this->positionObstacle->removeElement($positionObstacle);

        return $this;
    }

    /**
     * @return Collection|Salle[]
     */
    public function getSalle(): Collection
    {
        return $this->salle;
    }

    public function addSalle(Salle $salle): self
    {
        if (!$this->salle->contains($salle)) {
            $this->salle[] = $salle;
            $salle->setPartie($this);
        }

        return $this;
    }

    public function removeSalle(Salle $salle): self
    {
        if ($this->salle->removeElement($salle)) {
            // set the owning side to null (unless already changed)
            if ($salle->getPartie() === $this) {
                $salle->setPartie(null);
            }
        }

        return $this;
    }

    public function getPhotoClient(): ?PhotoClient
    {
        return $this->photoClient;
    }

    public function setPhotoClient(?PhotoClient $photoClient): self
    {
        $this->photoClient = $photoClient;

        return $this;
    }
}
