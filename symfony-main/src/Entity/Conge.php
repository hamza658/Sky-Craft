<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conge
 *
 * @ORM\Table(name="conge", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Conge
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_conge", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idConge;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_jour", type="integer", nullable=false)
     */
    private $nbJour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_conge", type="date", nullable=false)
     */
    private $dateConge;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_conge", type="string", length=255, nullable=false)
     */
    private $etatConge;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;

    public function getIdConge(): ?int
    {
        return $this->idConge;
    }

    public function getNbJour(): ?int
    {
        return $this->nbJour;
    }

    public function setNbJour(int $nbJour): self
    {
        $this->nbJour = $nbJour;

        return $this;
    }

    public function getDateConge(): ?\DateTimeInterface
    {
        return $this->dateConge;
    }

    public function setDateConge(\DateTimeInterface $dateConge): self
    {
        $this->dateConge = $dateConge;

        return $this;
    }

    public function getEtatConge(): ?string
    {
        return $this->etatConge;
    }

    public function setEtatConge(string $etatConge): self
    {
        $this->etatConge = $etatConge;

        return $this;
    }

    public function getId(): ?User
    {
        return $this->id;
    }

    public function setId(?User $id): self
    {
        $this->id = $id;

        return $this;
    }


}
