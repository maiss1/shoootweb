<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Matchh
 *
 * @ORM\Table(name="matchh")
 * @ORM\Entity
 */
class Matchh
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_match", type="integer", nullable=false)
     * @ORM\Id 
     * @ORM\GeneratedValue()
     * @Assert\Positive(message=" idMatch doit etre positive")

     */
    private $idMatch;

    /**
     * @var int
     *
     * @ORM\Column(name="id_equipe1", type="integer", nullable=false)
     * @Assert\Positive(message=" idEquipe1 doit etre positive")

     */
    private $idEquipe1;

    /**
     * @var int
     *
     * @ORM\Column(name="id_equipe2", type="integer", nullable=false)
     * @Assert\Positive(message=" idEquipe2 doit etre positive")

     */
    private $idEquipe2;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255, nullable=false)
     * @Assert\DateTime(message="doit etre Date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="id_comp", type="integer", nullable=false)
     * @Assert\Positive(message=" idComp doit etre de type positive")
     */
    private $idComp;

    /**
     * @var int
     *
     * @ORM\Column(name="id_stat", type="integer", nullable=false)
     * @Assert\Positive(message=" idStat doit etre positive")
     */
    private $idStat;

    /**
     * @var int
     *
     * @ORM\Column(name="id_prono", type="integer", nullable=false)
     * @Assert\Positive(message=" idProno doit etre positive")

     */
    private $idProno;

    public function getIdMatch(): ?int
    {
        return $this->idMatch;
    }

    public function getIdEquipe1(): ?int
    {
        return $this->idEquipe1;
    }

    public function setIdEquipe1(int $idEquipe1): self
    {
        $this->idEquipe1 = $idEquipe1;

        return $this;
    }

    public function getIdEquipe2(): ?int
    {
        return $this->idEquipe2;
    }

    public function setIdEquipe2(int $idEquipe2): self
    {
        $this->idEquipe2 = $idEquipe2;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdComp(): ?int
    {
        return $this->idComp;
    }

    public function setIdComp(int $idComp): self
    {
        $this->idComp = $idComp;

        return $this;
    }

    public function getIdStat(): ?int
    {
        return $this->idStat;
    }

    public function setIdStat(int $idStat): self
    {
        $this->idStat = $idStat;

        return $this;
    }

    public function getIdProno(): ?int
    {
        return $this->idProno;
    }

    public function setIdProno(int $idProno): self
    {
        $this->idProno = $idProno;

        return $this;
    }


}
