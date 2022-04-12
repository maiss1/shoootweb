<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competition
 *
 * @ORM\Table(name="competition", indexes={@ORM\Index(name="nom_comp", columns={"nom_comp"}), @ORM\Index(name="type", columns={"type"})})
 * @ORM\Entity
 */
class Competition
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_comp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idComp;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_comp", type="string", length=255, nullable=false)
     */
    private $nomComp;

    /**
     * @var string
     *
     * @ORM\Column(name="pays_comp", type="string", length=255, nullable=false)
     */
    private $paysComp;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_comp", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixComp;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var \Type
     *
     * @ORM\ManyToOne(targetEntity="Type" , fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type", referencedColumnName="nom_type")
     * })
     */
    private $type;

    public function getIdComp(): ?int
    {
        return $this->idComp;
    }

    public function getNomComp(): ?string
    {
        return $this->nomComp;
    }

    public function setNomComp(string $nomComp): self
    {
        $this->nomComp = $nomComp;

        return $this;
    }

    public function getPaysComp(): ?string
    {
        return $this->paysComp;
    }

    public function setPaysComp(string $paysComp): self
    {
        $this->paysComp = $paysComp;

        return $this;
    }

    public function getPrixComp(): ?float
    {
        return $this->prixComp;
    }

    public function setPrixComp(float $prixComp): self
    {
        $this->prixComp = $prixComp;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function __toString()
    {
        return $this->nomComp;
    }


}
