<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationVol
 *
 * @ORM\Table(name="reservation_vol", indexes={@ORM\Index(name="id_facture_vol", columns={"id_facture_vol"}), @ORM\Index(name="id_vol", columns={"id_vol"}), @ORM\Index(name="id_client", columns={"id"}), @ORM\Index(name="id_passager", columns={"id_passager"})})
 * @ORM\Entity
 */
class ReservationVol
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reservation_vol", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReservationVol;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_reservation", type="date", nullable=true)
     */
    private $dateReservation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_reservation", type="time", nullable=true)
     */
    private $heureReservation;

    /**
     * @var \Vol
     *
     * @ORM\ManyToOne(targetEntity="Vol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_vol", referencedColumnName="id_vol")
     * })
     */
    private $idVol;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;

    /**
     * @var \Passager
     *
     * @ORM\ManyToOne(targetEntity="Passager")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_passager", referencedColumnName="id_passager")
     * })
     */
    private $idPassager;

    /**
     * @var \FactureVol
     *
     * @ORM\ManyToOne(targetEntity="FactureVol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_facture_vol", referencedColumnName="id_facture_vol")
     * })
     */
    private $idFactureVol;

    public function getIdReservationVol(): ?int
    {
        return $this->idReservationVol;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(?\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getHeureReservation(): ?\DateTimeInterface
    {
        return $this->heureReservation;
    }

    public function setHeureReservation(?\DateTimeInterface $heureReservation): self
    {
        $this->heureReservation = $heureReservation;

        return $this;
    }

    public function getIdVol(): ?Vol
    {
        return $this->idVol;
    }

    public function setIdVol(?Vol $idVol): self
    {
        $this->idVol = $idVol;

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

    public function getIdPassager(): ?Passager
    {
        return $this->idPassager;
    }

    public function setIdPassager(?Passager $idPassager): self
    {
        $this->idPassager = $idPassager;

        return $this;
    }

    public function getIdFactureVol(): ?FactureVol
    {
        return $this->idFactureVol;
    }

    public function setIdFactureVol(?FactureVol $idFactureVol): self
    {
        $this->idFactureVol = $idFactureVol;

        return $this;
    }


}
