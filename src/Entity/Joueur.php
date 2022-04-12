<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Joueur
 *
 * @ORM\Table(name="joueur", indexes={@ORM\Index(name="nom_joueur", columns={"nom_joueur"}), @ORM\Index(name="fk_equipe", columns={"nom_equipe"})})
 * @ORM\Entity
 */
class Joueur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_joueur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idJoueur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_joueur", type="string", length=255, nullable=false)
     * @Assert\NotNull(message = "Ce champ ne peut pas etre vide! Veuillez le remplir.")
     * @Assert\NotBlank(message = "Il parait que vous-avez oubliée de remplir le champ du nom joueur !")
     */
    private $nomJoueur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaiss", type="date", nullable=false)
     */
    private $datenaiss;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer", nullable=false)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255, nullable=false)
     * @Assert\NotNull(message = "Ce champ ne peut pas etre vide! Veuillez le remplir.")
     * @Assert\NotBlank(message = "Il parait que vous-avez oubliée de remplir le champ du pays !")
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="drapeau", type="string", length=255, nullable=false)
     * @Assert\NotNull(message = "Ce champ ne peut pas etre vide! Veuillez le remplir.")
     * @Assert\NotBlank(message = "Il parait que vous-avez oubliée de remplir le champ du drapeau !")
     */
    private $drapeau;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=1255, nullable=false)
     * @Assert\NotNull(message = "Ce champ ne peut pas etre vide! Veuillez le remplir.")
     * @Assert\NotBlank(message = "Il parait que vous-avez oubliée de remplir le champ du image !")
     */
    private $image;

    /**
     * @var \Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe" , fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nom_equipe", referencedColumnName="nom_equipe")
     * })
     */
    private $nomEquipe;

    public function getIdJoueur(): ?int
    {
        return $this->idJoueur;
    }

    public function getNomJoueur(): ?string
    {
        return $this->nomJoueur;
    }

    public function setNomJoueur(string $nomJoueur): self
    {
        $this->nomJoueur = $nomJoueur;

        return $this;
    }

    public function getDatenaiss(): ?\DateTimeInterface
    {
        return $this->datenaiss;
    }

    public function setDatenaiss(\DateTimeInterface $datenaiss): self
    {
        $this->datenaiss = $datenaiss;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getDrapeau(): ?string
    {
        return $this->drapeau;
    }

    public function setDrapeau(string $drapeau): self
    {
        $this->drapeau = $drapeau;

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

    public function getNomEquipe(): ?Equipe
    {
        return $this->nomEquipe;
    }

    public function setNomEquipe(?Equipe $nomEquipe): self
    {
        $this->nomEquipe = $nomEquipe;

        return $this;
    }

    public function __toString()
    {
        return $this->nomJoueur;
    }

    

}
