<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Absence
 *
 * @ORM\Table(name="absence", indexes={@ORM\Index(name="id", columns={"id"})})
 *@ORM\Entity(repositoryClass="App\Repository\AbsenceRepository")
 */
class Absence
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_ab", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAb;

    /**
     * @var string
     * * @Assert\NotBlank(message="etat d'absence doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer une chaine au minimum de 5 caracteres"
     *
     *     )
     * @ORM\Column(name="etat_absence", type="string", length=255, nullable=true)
     */
    private $etatAbsence;

    /**
     * @var \DateTime|null
     *@Assert\Date()
     * @Assert\Expression(
     *     "this.getDateAb() < this.getFinAb()",
     *     message="La date de debut absence ne doit pas être postérieure à la date fin absence"
     * )
     * @ORM\Column(name="date_ab", type="datetime", nullable=true)
     */
    private $dateAb;

    /**
     * @var \DateTime|null
     **@Assert\Date()
     * @Assert\Expression(
     *     "this.getDateAb() < this.getFinAb()",
     *     message="La date de fin absence ne doit pas être antérieure à la date debut absence"
     * )
     * @ORM\Column(name="fin_ab", type="datetime", nullable=true)
     */
    private $finAb;

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
     * @return int
     */
    public function getIdAb(): int
    {
        return $this->idAb;
    }

    /**
     * @param int $idAb
     */
    public function setIdAb(int $idAb): void
    {
        $this->idAb = $idAb;
    }

    /**
     * @return string
     */
    public function getEtatAbsence()
    {
        return $this->etatAbsence;
    }

    /**
     * @param string $etatAbsence
     */
    public function setEtatAbsence(string $etatAbsence): void
    {
        $this->etatAbsence = $etatAbsence;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateAb(): ?\DateTime
    {
        return $this->dateAb;
    }

    /**
     * @param \DateTime|null $dateAb
     */
    public function setDateAb(?\DateTime $dateAb): void
    {
        $this->dateAb = $dateAb;
    }

    /**
     * @return \DateTime|null
     */
    public function getFinAb(): ?\DateTime
    {
        return $this->finAb;
    }

    /**
     * @param \DateTime|null $finAb
     */
    public function setFinAb(?\DateTime $finAb): void
    {
        $this->finAb = $finAb;
    }


    public function getId():?User
    {
        return $this->id;
    }


    public function setId(?User $id)
    {
        $this->id = $id;
        return $this;
    }

}
