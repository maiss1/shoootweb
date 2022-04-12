<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture")
 * @ORM\Entity
 */
class Facture
{
    /**
     * @var string
     *
     * @ORM\Column(name="DateCreation", type="string", length=255, nullable=false)
     */
    private $datecreation;

    /**
     * @var float
     *
     * @ORM\Column(name="Total", type="float", precision=10, scale=0, nullable=false)
     */
    private $total;

    /**
     * @var int
     *
     * @ORM\Column(name="id_panier", type="integer", nullable=false)
     */
    private $idPanier;

    /**
     * @var \Pan
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Pan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idFacture", referencedColumnName="id_panier")
     * })
     */
    private $idfacture;

    public function getDatecreation(): ?string
    {
        return $this->datecreation;
    }

    public function setDatecreation(string $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getIdPanier(): ?int
    {
        return $this->idPanier;
    }

    public function setIdPanier(int $idPanier): self
    {
        $this->idPanier = $idPanier;

        return $this;
    }

    public function getIdfacture(): ?Pan
    {
        return $this->idfacture;
    }

    public function setIdfacture(?Pan $idfacture): self
    {
        $this->idfacture = $idfacture;

        return $this;
    }


}
