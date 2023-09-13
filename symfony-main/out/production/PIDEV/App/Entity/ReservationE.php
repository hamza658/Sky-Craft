<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationE
 *
 * @ORM\Table(name="reservation_e", indexes={@ORM\Index(name="id_facture_ev", columns={"id_facture_ev"}), @ORM\Index(name="id_offre", columns={"id_offre"}), @ORM\Index(name="id_client", columns={"id"}), @ORM\Index(name="id_even", columns={"id_even"})})
 * @ORM\Entity
 */
class ReservationE
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_re", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure", type="time", nullable=false)
     */
    private $heure;

    /**
     * @var \Offre
     *
     * @ORM\ManyToOne(targetEntity="Offre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_offre", referencedColumnName="id_offre")
     * })
     */
    private $idOffre;

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
     * @var \FactureEv
     *
     * @ORM\ManyToOne(targetEntity="FactureEv")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_facture_ev", referencedColumnName="id_facture_ev")
     * })
     */
    private $idFactureEv;

    /**
     * @var \Evenment
     *
     * @ORM\ManyToOne(targetEntity="Evenment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_even", referencedColumnName="id_even")
     * })
     */
    private $idEven;

    public function getIdRe(): ?int
    {
        return $this->idRe;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getIdOffre(): ?Offre
    {
        return $this->idOffre;
    }

    public function setIdOffre(?Offre $idOffre): self
    {
        $this->idOffre = $idOffre;

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

    public function getIdFactureEv(): ?FactureEv
    {
        return $this->idFactureEv;
    }

    public function setIdFactureEv(?FactureEv $idFactureEv): self
    {
        $this->idFactureEv = $idFactureEv;

        return $this;
    }

    public function getIdEven(): ?Evenment
    {
        return $this->idEven;
    }

    public function setIdEven(?Evenment $idEven): self
    {
        $this->idEven = $idEven;

        return $this;
    }


}
