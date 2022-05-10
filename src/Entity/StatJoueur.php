<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatJoueur
 *
 * @ORM\Table(name="stat_joueur", indexes={@ORM\Index(name="fk_comp", columns={"nom_comp"}), @ORM\Index(name="fk_joueur", columns={"nom_joueur"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\StatJoueurRepository")
 */
class StatJoueur
{
    /**
     * @var int
     *
     * @ORM\Column(name="idd", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idd;

    /**
     * @var int|null
     *
     * @ORM\Column(name="but_comp", type="integer", nullable=true)
     */
    private $butComp = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="assist_comp", type="integer", nullable=true)
     */
    private $assistComp = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="but_total", type="integer", nullable=false)
     */
    private $butTotal = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="assist_total", type="integer", nullable=false)
     */
    private $assistTotal = '0';

    /**
     * @var \Joueur
     *
     * @ORM\ManyToOne(targetEntity="Joueur" , fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nom_joueur", referencedColumnName="nom_joueur")
     * })
     */
    private $nomJoueur;

    /**
     * @var \Competition
     *
     * @ORM\ManyToOne(targetEntity="Competition" , fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nom_comp", referencedColumnName="nom_comp")
     * })
     */
    private $nomComp;

    public function getIdd(): ?int
    {
        return $this->idd;
    }

    public function getButComp(): ?int
    {
        return $this->butComp;
    }

    public function setButComp(?int $butComp): self
    {
        $this->butComp = $butComp;

        return $this;
    }

    public function getAssistComp(): ?int
    {
        return $this->assistComp;
    }

    public function setAssistComp(?int $assistComp): self
    {
        $this->assistComp = $assistComp;

        return $this;
    }

    public function getButTotal(): ?int
    {
        return $this->butTotal;
    }

    public function setButTotal(int $butTotal): self
    {
        $this->butTotal = $butTotal;

        return $this;
    }

    public function getAssistTotal(): ?int
    {
        return $this->assistTotal;
    }

    public function setAssistTotal(int $assistTotal): self
    {
        $this->assistTotal = $assistTotal;

        return $this;
    }

    public function getNomJoueur(): ?Joueur
    {
        return $this->nomJoueur;
    }

    public function setNomJoueur(?Joueur $nomJoueur): self
    {
        $this->nomJoueur = $nomJoueur;

        return $this;
    }

    public function getNomComp(): ?Competition
    {
        return $this->nomComp;
    }

    public function setNomComp(?Competition $nomComp): self
    {
        $this->nomComp = $nomComp;

        return $this;
    }


}
