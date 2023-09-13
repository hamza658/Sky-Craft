<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Passager
 *
 * @ORM\Table(name="passager")
 * @ORM\Entity
 */
class Passager
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_passager", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPassager;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_mail", type="string", length=255, nullable=false)
     */
    private $adresseMail;

    public function getIdPassager(): ?int
    {
        return $this->idPassager;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->adresseMail;
    }

    public function setAdresseMail(string $adresseMail): self
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }


}
