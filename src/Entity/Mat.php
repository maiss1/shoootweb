<?php

namespace App\Entity;

use App\Repository\MatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatRepository::class)
 */
class Mat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $equipe1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $equipe2;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_comp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $id_stat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquipe1(): ?string
    {
        return $this->equipe1;
    }

    public function setEquipe1(?string $equipe1): self
    {
        $this->equipe1 = $equipe1;

        return $this;
    }

    public function getEquipe2(): ?string
    {
        return $this->equipe2;
    }

    public function setEquipe2(?string $equipe2): self
    {
        $this->equipe2 = $equipe2;

        return $this;
    }

    public function getIdComp(): ?int
    {
        return $this->id_comp;
    }

    public function setIdComp(int $id_comp): self
    {
        $this->id_comp = $id_comp;

        return $this;
    }

    public function getIdStat(): ?string
    {
        return $this->id_stat;
    }

    public function setIdStat(string $id_stat): self
    {
        $this->id_stat = $id_stat;

        return $this;
    }
}
