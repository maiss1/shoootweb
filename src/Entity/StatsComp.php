<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatsComp
 *
 * @ORM\Table(name="stats_comp", indexes={@ORM\Index(name="competition", columns={"competition"}), @ORM\Index(name="equipe", columns={"equipe"})})
 * @ORM\Entity
 */
class StatsComp
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_stats", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStats;

    /**
     * @var string
     *
     * @ORM\Column(name="buteur", type="string", length=255, nullable=false)
     */
    private $buteur;

    /**
     * @var string
     *
     * @ORM\Column(name="asisst_man", type="string", length=255, nullable=false)
     */
    private $asisstMan;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_deb", type="date", nullable=false)
     */
    private $dateDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     */
    private $dateFin;

    /**
     * @var \Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipe", referencedColumnName="nom_equipe")
     * })
     */
    private $equipe;

    /**
     * @var \Competition
     *
     * @ORM\ManyToOne(targetEntity="Competition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="competition", referencedColumnName="nom_comp")
     * })
     */
    private $competition;

    public function getIdStats(): ?int
    {
        return $this->idStats;
    }

    public function getButeur(): ?string
    {
        return $this->buteur;
    }

    public function setButeur(string $buteur): self
    {
        $this->buteur = $buteur;

        return $this;
    }

    public function getAsisstMan(): ?string
    {
        return $this->asisstMan;
    }

    public function setAsisstMan(string $asisstMan): self
    {
        $this->asisstMan = $asisstMan;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(\DateTimeInterface $dateDeb): self
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getEquipe(): ?Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(?Equipe $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): self
    {
        $this->competition = $competition;

        return $this;
    }


}
