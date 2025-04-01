<?php

namespace App\Entity;

use App\Repository\VersusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VersusRepository::class)]
class Versus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'versuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $gameid = null;

    #[ORM\ManyToOne(inversedBy: 'versuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team1 = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team2 = null;

    #[ORM\Column]
    private ?float $rate_team1 = null;

    #[ORM\Column]
    private ?float $rate_team2 = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne]
    private ?Team $winner = null;

    #[ORM\OneToMany(mappedBy: 'versusid', targetEntity: Bet::class, orphanRemoval: true)]
    private Collection $bets;

    public function __construct()
    {
        $this->bets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameid(): ?Game
    {
        return $this->gameid;
    }

    public function setGameid(?Game $gameid): static
    {
        $this->gameid = $gameid;

        return $this;
    }

    public function getTeam1(): ?Team
    {
        return $this->team1;
    }

    public function setTeam1(?Team $team1): static
    {
        $this->team1 = $team1;

        return $this;
    }

    public function getTeam2(): ?Team
    {
        return $this->team2;
    }

    public function setTeam2(?Team $team2): static
    {
        $this->team2 = $team2;

        return $this;
    }

    public function getRateTeam1(): ?float
    {
        return $this->rate_team1;
    }

    public function setRateTeam1(float $rate_team1): static
    {
        $this->rate_team1 = $rate_team1;

        return $this;
    }

    public function getRateTeam2(): ?float
    {
        return $this->rate_team2;
    }

    public function setRateTeam2(float $rate_team2): static
    {
        $this->rate_team2 = $rate_team2;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getWinner(): ?Team
    {
        return $this->winner;
    }

    public function setWinner(?Team $winner): static
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * @return Collection<int, Bet>
     */
    public function getBets(): Collection
    {
        return $this->bets;
    }

    public function addBet(Bet $bet): static
    {
        if (!$this->bets->contains($bet)) {
            $this->bets->add($bet);
            $bet->setVersusid($this);
        }

        return $this;
    }

    public function removeBet(Bet $bet): static
    {
        if ($this->bets->removeElement($bet)) {
            // set the owning side to null (unless already changed)
            if ($bet->getVersusid() === $this) {
                $bet->setVersusid(null);
            }
        }

        return $this;
    }
}
