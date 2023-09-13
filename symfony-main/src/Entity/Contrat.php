<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contrat
 *
 * @ORM\Table(name="contrat", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Contrat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_contrat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContrat;

    /**
     * @var int
     *
     * @ORM\Column(name="duree_contrat", type="integer", nullable=false)
     */
    private $dureeContrat;

    /**
     * @var string
     *
     * @ORM\Column(name="type_contrat", type="string", length=255, nullable=false)
     */
    private $typeContrat;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;

    public function getIdContrat(): ?int
    {
        return $this->idContrat;
    }

    public function getDureeContrat(): ?int
    {
        return $this->dureeContrat;
    }

    public function setDureeContrat(int $dureeContrat): self
    {
        $this->dureeContrat = $dureeContrat;

        return $this;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

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


}
