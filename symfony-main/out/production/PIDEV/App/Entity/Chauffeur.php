<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chauffeur
 *
 * @ORM\Table(name="chauffeur")
 * @ORM\Entity
 */
class Chauffeur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_chauffeur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idChauffeur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_chauffeur", type="string", length=255, nullable=false)
     */
    private $nomChauffeur;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_chauffeur", type="string", length=255, nullable=false)
     */
    private $prenomChauffeur;

    /**
     * @var string
     *
     * @ORM\Column(name="cin_chauffeur", type="string", length=255, nullable=false)
     */
    private $cinChauffeur;

    /**
     * @var int
     *
     * @ORM\Column(name="num_tel_chauffeur", type="integer", nullable=false)
     */
    private $numTelChauffeur;

    /**
     * @var string
     *
     * @ORM\Column(name="email_chauffeur", type="string", length=255, nullable=false)
     */
    private $emailChauffeur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance_chauffeur", type="date", nullable=false)
     */
    private $dateNaissanceChauffeur;

    /**
     * @var string
     *
     * @ORM\Column(name="num_compte_bancaire", type="string", length=255, nullable=false)
     */
    private $numCompteBancaire;

    public function getIdChauffeur(): ?int
    {
        return $this->idChauffeur;
    }

    public function getNomChauffeur(): ?string
    {
        return $this->nomChauffeur;
    }

    public function setNomChauffeur(string $nomChauffeur): self
    {
        $this->nomChauffeur = $nomChauffeur;

        return $this;
    }

    public function getPrenomChauffeur(): ?string
    {
        return $this->prenomChauffeur;
    }

    public function setPrenomChauffeur(string $prenomChauffeur): self
    {
        $this->prenomChauffeur = $prenomChauffeur;

        return $this;
    }

    public function getCinChauffeur(): ?string
    {
        return $this->cinChauffeur;
    }

    public function setCinChauffeur(string $cinChauffeur): self
    {
        $this->cinChauffeur = $cinChauffeur;

        return $this;
    }

    public function getNumTelChauffeur(): ?int
    {
        return $this->numTelChauffeur;
    }

    public function setNumTelChauffeur(int $numTelChauffeur): self
    {
        $this->numTelChauffeur = $numTelChauffeur;

        return $this;
    }

    public function getEmailChauffeur(): ?string
    {
        return $this->emailChauffeur;
    }

    public function setEmailChauffeur(string $emailChauffeur): self
    {
        $this->emailChauffeur = $emailChauffeur;

        return $this;
    }

    public function getDateNaissanceChauffeur(): ?\DateTimeInterface
    {
        return $this->dateNaissanceChauffeur;
    }

    public function setDateNaissanceChauffeur(\DateTimeInterface $dateNaissanceChauffeur): self
    {
        $this->dateNaissanceChauffeur = $dateNaissanceChauffeur;

        return $this;
    }

    public function getNumCompteBancaire(): ?string
    {
        return $this->numCompteBancaire;
    }

    public function setNumCompteBancaire(string $numCompteBancaire): self
    {
        $this->numCompteBancaire = $numCompteBancaire;

        return $this;
    }


}
