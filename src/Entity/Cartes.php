<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cartes
 *
 * @ORM\Table(name="cartes")
 * @ORM\Entity
 */
class Cartes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $nom = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire minimum 8 caractères")
     */
    private $prenom = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="level", type="integer", nullable=true, options={"default"="NULL"})
     * @Assert\Positive(message=" niveau doit etre positive")
     */
    private $level = NULL;

    /**
     * @var float|null
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true, options={"default"="NULL"})
     */
    private $prix = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_premuim", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $idPremuim = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="imgcarte", type="string", length=255, nullable=false)
    
     */
    private $imgcarte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdPremuim(): ?int
    {
        return $this->idPremuim;
    }

    public function setIdPremuim(?int $idPremuim): self
    {
        $this->idPremuim = $idPremuim;

        return $this;
    }

    public function getImgcarte(): ?string
    {
        return $this->imgcarte;
    }

    public function setImgcarte(string $imgcarte): self
    {
        $this->imgcarte = $imgcarte;

        return $this;
    }


}
