<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistique
 *
 * @ORM\Table(name="statistique", indexes={@ORM\Index(name="Id_match", columns={"Id_match"})})
 * @ORM\Entity
 */
class Statistique
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
     * @var string
     *
     * @ORM\Column(name="TitreMatch", type="string", length=255, nullable=false)
     */
    private $titrematch;

    /**
     * @var int
     *
     * @ORM\Column(name="But", type="integer", nullable=false)
     */
    private $but;

    /**
     * @var string
     *
     * @ORM\Column(name="N_Buteur", type="string", length=255, nullable=false)
     */
    private $nButeur;

    /**
     * @var string
     *
     * @ORM\Column(name="N_Passeur", type="string", length=255, nullable=false)
     */
    private $nPasseur;

    /**
     * @var int
     *
     * @ORM\Column(name="Nb_Corner", type="integer", nullable=false)
     */
    private $nbCorner;

    /**
     * @var int
     *
     * @ORM\Column(name="Nb_faute", type="integer", nullable=false)
     */
    private $nbFaute;

    /**
     * @var int
     *
     * @ORM\Column(name="Nb_Carton", type="integer", nullable=false)
     */
    private $nbCarton;

    /**
     * @var \Matchh
     *
    
     *   @ORM\Column(name="Id_match", type="integer", nullable=false )
     * })
     */
    private $idMatch;

    public function getIdd(): ?int
    {
        return $this->idd;
    }

    public function getTitrematch(): ?string
    {
        return $this->titrematch;
    }

    public function setTitrematch(string $titrematch): self
    {
        $this->titrematch = $titrematch;

        return $this;
    }

    public function getBut(): ?int
    {
        return $this->but;
    }

    public function setBut(int $but): self
    {
        $this->but = $but;

        return $this;
    }

    public function getNButeur(): ?string
    {
        return $this->nButeur;
    }

    public function setNButeur(string $nButeur): self
    {
        $this->nButeur = $nButeur;

        return $this;
    }

    public function getNPasseur(): ?string
    {
        return $this->nPasseur;
    }

    public function setNPasseur(string $nPasseur): self
    {
        $this->nPasseur = $nPasseur;

        return $this;
    }

    public function getNbCorner(): ?int
    {
        return $this->nbCorner;
    }

    public function setNbCorner(int $nbCorner): self
    {
        $this->nbCorner = $nbCorner;

        return $this;
    }

    public function getNbFaute(): ?int
    {
        return $this->nbFaute;
    }

    public function setNbFaute(int $nbFaute): self
    {
        $this->nbFaute = $nbFaute;

        return $this;
    }

    public function getNbCarton(): ?int
    {
        return $this->nbCarton;
    }

    public function setNbCarton(int $nbCarton): self
    {
        $this->nbCarton = $nbCarton;

        return $this;
    }

    public function getIdMatch(): ?int
    {
        return $this->idMatch;
    }

    public function setIdMatch(?int $idMatch): self
    {
        $this->idMatch = $idMatch;

        return $this;
    }


}
