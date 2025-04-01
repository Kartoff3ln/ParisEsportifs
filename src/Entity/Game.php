<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $game_name = null;

    #[ORM\Column(length: 50)]
    private ?string $game_type = null;

    #[ORM\OneToMany(mappedBy: 'gameid', targetEntity: Versus::class, orphanRemoval: true)]
    private Collection $versuses;

    public function __construct()
    {
        $this->versuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameName(): ?string
    {
        return $this->game_name;
    }

    public function setGameName(string $game_name): static
    {
        $this->game_name = $game_name;

        return $this;
    }

    public function getGameType(): ?string
    {
        return $this->game_type;
    }

    public function setGameType(string $game_type): static
    {
        $this->game_type = $game_type;

        return $this;
    }

    /**
     * @return Collection<int, Versus>
     */
    public function getVersuses(): Collection
    {
        return $this->versuses;
    }

    public function addVersus(Versus $versus): static
    {
        if (!$this->versuses->contains($versus)) {
            $this->versuses->add($versus);
            $versus->setGameid($this);
        }

        return $this;
    }

    public function removeVersus(Versus $versus): static
    {
        if ($this->versuses->removeElement($versus)) {
            // set the owning side to null (unless already changed)
            if ($versus->getGameid() === $this) {
                $versus->setGameid(null);
            }
        }

        return $this;
    }
}
