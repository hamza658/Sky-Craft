<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chambre
 *
 * @ORM\Table(name="chambre", indexes={@ORM\Index(name="id_hotel", columns={"id_hotel"})})
 * @ORM\Entity
 */
class Chambre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cham", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCham;

    /**
     * @var int
     *
     * @ORM\Column(name="num_cham", type="integer", nullable=false)
     */
    private $numCham;

    /**
     * @var \Hotel
     *
     * @ORM\ManyToOne(targetEntity="Hotel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_hotel", referencedColumnName="id_hotel")
     * })
     */
    private $idHotel;

    public function getIdCham(): ?int
    {
        return $this->idCham;
    }

    public function getNumCham(): ?int
    {
        return $this->numCham;
    }

    public function setNumCham(int $numCham): self
    {
        $this->numCham = $numCham;

        return $this;
    }

    public function getIdHotel(): ?Hotel
    {
        return $this->idHotel;
    }

    public function setIdHotel(?Hotel $idHotel): self
    {
        $this->idHotel = $idHotel;

        return $this;
    }


}
