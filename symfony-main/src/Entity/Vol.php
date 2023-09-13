<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vol
 *
 * @ORM\Table(name="vol", indexes={@ORM\Index(name="idVolGenerique", columns={"idVolGenerique"})})
 * @ORM\Entity
 */
class Vol
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_vol", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_depart", type="date", nullable=false)
     */
    private $dateDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_arrivee", type="date", nullable=false)
     */
    private $dateArrivee;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var \VolGenerique
     *
     * @ORM\ManyToOne(targetEntity="VolGenerique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idVolGenerique", referencedColumnName="idVolGenerique")
     * })
     */
    private $idvolgenerique;

    public function getIdVol(): ?int
    {
        return $this->idVol;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateArrivee(): ?\DateTimeInterface
    {
        return $this->dateArrivee;
    }

    public function setDateArrivee(\DateTimeInterface $dateArrivee): self
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getIdvolgenerique(): ?VolGenerique
    {
        return $this->idvolgenerique;
    }

    public function setIdvolgenerique(?VolGenerique $idvolgenerique): self
    {
        $this->idvolgenerique = $idvolgenerique;

        return $this;
    }


}
