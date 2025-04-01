<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $team_name = null;

    #[ORM\OneToMany(mappedBy: 'team1', targetEntity: Versus::class, orphanRemoval: true)]
    private Collection $versuses;

    public function __construct()
    {
        $this->versuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamName(): ?string
    {
        return $this->team_name;
    }

    public function setTeamName(string $team_name): static
    {
        $this->team_name = $team_name;

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
            $versus->setTeam1($this);
        }

        return $this;
    }

    public function removeVersus(Versus $versus): static
    {
        if ($this->versuses->removeElement($versus)) {
            // set the owning side to null (unless already changed)
            if ($versus->getTeam1() === $this) {
                $versus->setTeam1(null);
            }
        }

        return $this;
    }
}
