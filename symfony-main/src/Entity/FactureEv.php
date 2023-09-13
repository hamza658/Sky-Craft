<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactureEv
 *
 * @ORM\Table(name="facture_ev", indexes={@ORM\Index(name="id_eve", columns={"id_even"})})
 * @ORM\Entity
 */
class FactureEv
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_facture_ev", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFactureEv;

    /**
     * @var int
     *
     * @ORM\Column(name="montant", type="integer", nullable=false)
     */
    private $montant;

    /**
     * @var int
     *
     * @ORM\Column(name="date_facture_eve", type="integer", nullable=false)
     */
    private $dateFactureEve;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_even", referencedColumnName="id_even")
     * })
     */
    private $idEven;

    public function getIdFactureEv(): ?int
    {
        return $this->idFactureEv;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateFactureEve(): ?int
    {
        return $this->dateFactureEve;
    }

    public function setDateFactureEve(int $dateFactureEve): self
    {
        $this->dateFactureEve = $dateFactureEve;

        return $this;
    }

    public function getIdEven(): ?Evenement
    {
        return $this->idEven;
    }

    public function setIdEven(?Evenement $idEven): self
    {
        $this->idEven = $idEven;

        return $this;
    }


}
