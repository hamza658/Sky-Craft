<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VolGenerique
 *
 * @ORM\Table(name="vol_generique")
 * @ORM\Entity
 */
class VolGenerique
{
    /**
     * @var int
     *
     * @ORM\Column(name="idVolGenerique", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvolgenerique;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="jour", type="date", nullable=false)
     */
    private $jour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_depart", type="time", nullable=false)
     */
    private $heureDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_arrivee", type="time", nullable=false)
     */
    private $heureArrivee;

    /**
     * @var float
     *
     * @ORM\Column(name="duree", type="float", precision=10, scale=0, nullable=false)
     */
    private $duree;

    public function getIdvolgenerique(): ?int
    {
        return $this->idvolgenerique;
    }

    public function getJour(): ?\DateTimeInterface
    {
        return $this->jour;
    }

    public function setJour(\DateTimeInterface $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(\DateTimeInterface $heureDepart): self
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    public function getHeureArrivee(): ?\DateTimeInterface
    {
        return $this->heureArrivee;
    }

    public function setHeureArrivee(\DateTimeInterface $heureArrivee): self
    {
        $this->heureArrivee = $heureArrivee;

        return $this;
    }

    public function getDuree(): ?float
    {
        return $this->duree;
    }

    public function setDuree(float $duree): self
    {
        $this->duree = $duree;

        return $this;
    }


}
