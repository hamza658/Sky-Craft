<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationVoiture
 *
 * @ORM\Table(name="reservation_voiture", indexes={@ORM\Index(name="id_chauffeur", columns={"id_chauffeur"}), @ORM\Index(name="id_voiture", columns={"id_voiture"}), @ORM\Index(name="id_client", columns={"id"})})
 * @ORM\Entity
 */
class ReservationVoiture
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRv;

    /**
     * @var \Voiture
     *
     * @ORM\ManyToOne(targetEntity="Voiture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_voiture", referencedColumnName="id_voiture")
     * })
     */
    private $idVoiture;

  

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
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */
    private $dateDebut;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     */
    private $dateFin;


    public function getIdRv(): ?int
    {
        return $this->idRv;
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
  
    public function getIdChauffeur():?int
    {
        return $this->idChauffeur;
    }


    public function setIdChauffeur(?Chauffeur $idChauffeur): self
    {
        $this->idChauffeur = $idChauffeur;

        return $this;
    }
    

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    
    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }
}
