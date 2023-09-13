<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactureVol
 *
 * @ORM\Table(name="facture_vol")
 * @ORM\Entity
 */
class FactureVol
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_facture_vol", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFactureVol;

    /**
     * @var int
     *
     * @ORM\Column(name="designation", type="integer", nullable=false)
     */
    private $designation;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_unitaire", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixUnitaire;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_total", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixTotal;

    public function getIdFactureVol(): ?int
    {
        return $this->idFactureVol;
    }

    public function getDesignation(): ?int
    {
        return $this->designation;
    }

    public function setDesignation(int $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(float $prixTotal): self
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }


}
