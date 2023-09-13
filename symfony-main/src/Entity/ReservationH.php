<?php

namespace App\Entity;


use App\Repository\ReservationHRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationHRepository::class)
 */
class ReservationH
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_rh;

    /**
     * @ORM\Column(type="date")
     */
    private $date_rh;

    /**
     * @ORM\Column(type="time")
     */
    private $heure_rh;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    public function getId_rh(): ?int
    {
        return $this->id_rh;

    }

    public function getDateRh(): ?\DateTimeInterface
    {

        return $this->date_rh;
    }

    public function setDateRh(\DateTimeInterface $date_rh): self
    {
        $this->date_rh = $date_rh;


        return $this;
    }

    public function getHeureRh(): ?\DateTimeInterface
    {

        return $this->heure_rh;
    }

    public function setHeureRh(\DateTimeInterface $heure_rh): self
    {
        $this->heure_rh = $heure_rh;


        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }
}
