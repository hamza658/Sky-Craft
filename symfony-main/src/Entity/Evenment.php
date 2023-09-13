<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evenment
 *
 * @ORM\Table(name="evenment")
 *@ORM\Entity(repositoryClass="App\Repository\EvenmentRepository")
 */
class Evenment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_even", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEven;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="string", length=255, nullable=false)
     */
    private $detail;

    /**
     * @var \DateTime|null
     * *@Assert\Date()
     * @Assert\Expression(
     *     "this.getDateDebut() < this.getDateFin()",
     *     message="La date de debut absence ne doit pas être postérieure à la date fin absence"
     * )
     * @ORM\Column(name="date_debut", type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @var int
     *
     * @ORM\Column(name="duree_ev", type="integer", nullable=true)
     */
    private $dureeEv;

    /**
     * @var string
     *   * * @Assert\NotBlank(message="commentaire doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer une chaine au minimum de 5 caracteres"
     *
     *     )
     * @ORM\Column(name="commentaire", type="string", length=255, nullable=false)
     */
    private $commentaire;
    /**
     * @var \DateTime|null
     **@Assert\Date()
     * @Assert\Expression(
     *     "this.getDateDebut() < this.getDatefin()",
     *     message="La date de fin absence ne doit pas être antérieure à la date debut absence"
     * )
     * @ORM\Column(name="date_fin", type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @ORM\Column(type="string", length=255,)
     *
     */
    private $image;
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    /**
     * @return int
     */
    public function getIdEven()
    {
        return $this->idEven;
    }

    /**
     * @param int $idEven
     */
    public function setIdEven(int $idEven): void
    {
        $this->idEven = $idEven;
    }

    /**
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param string $detail
     */
    public function setDetail(string $detail)
    {
        $this->detail = $detail;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime|null $dateDebut
     */
    public function setDateDebut(?\DateTime $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return int
     */
    public function getDureeEv()
    {
        return $this->dureeEv;
    }

    /**
     * @param int $dureeEv
     */
    public function setDureeEv(int $dureeEv): void
    {
        $this->dureeEv = $dureeEv;
    }


    /**
     * @return \DateTime|null
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param \DateTime|null $dateFin
     */
    public function setDateFin(?\DateTime $dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param string $commentaire
     */
    public function setCommentaire(string $commentaire): void
    {
        $this->commentaire = $commentaire;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    } public function getPublicFolder() {
    $webPath = $this->get('kernel')->getProjectDir() . '/public/uploads/hotel_image';

    return $webPath;


}

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }





    //prend image et l ajouter dans le dossier  hotel_image
    public function upload()
    {
        if(null === $this->getFile()) {
            return;
        }

        $this->getFile()->move(
            $this->getPublicFolder(),//destination
            $this->getFile()->getClientOriginalName()//nom fichier (image)
        );

        $this->image = $this->getFile()->getClientOriginalName();//

        $this->file = null; // liberation memoire
    }

}
