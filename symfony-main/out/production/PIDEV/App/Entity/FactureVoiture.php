<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactureVoiture
 *
 * @ORM\Table(name="facture_voiture", indexes={@ORM\Index(name="id_chauffeur", columns={"id_chauffeur"}), @ORM\Index(name="id_voiture", columns={"id_voiture"})})
 * @ORM\Entity
 */
class FactureVoiture
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_facture_voiture", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFactureVoiture;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_facture_voit", type="date", nullable=false)
     */
    private $dateFactureVoit;

    /**
     * @var \Chauffeur
     *
     * @ORM\ManyToOne(targetEntity="Chauffeur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_chauffeur", referencedColumnName="id_chauffeur")
     * })
     */
    private $idChauffeur;

    /**
     * @var \Voiture
     *
     * @ORM\ManyToOne(targetEntity="Voiture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_voiture", referencedColumnName="id_voiture")
     * })
     */
    private $idVoiture;

    public function getIdFactureVoiture(): ?int
    {
        return $this->idFactureVoiture;
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

    public function getDateFactureVoit(): ?\DateTimeInterface
    {
        return $this->dateFactureVoit;
    }

    public function setDateFactureVoit(\DateTimeInterface $dateFactureVoit): self
    {
        $this->dateFactureVoit = $dateFactureVoit;

        return $this;
    }

    public function getIdChauffeur(): ?Chauffeur
    {
        return $this->idChauffeur;
    }

    public function setIdChauffeur(?Chauffeur $idChauffeur): self
    {
        $this->idChauffeur = $idChauffeur;

        return $this;
    }

    public function getIdVoiture(): ?Voiture
    {
        return $this->idVoiture;
    }

    public function setIdVoiture(?Voiture $idVoiture): self
    {
        $this->idVoiture = $idVoiture;

        return $this;
    }


}
