<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactureHot
 *
 * @ORM\Table(name="facture_hot")
 * @ORM\Entity
 */
class FactureHot
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_facture_hot", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFactureHot;

    public function getIdFactureHot(): ?int
    {
        return $this->idFactureHot;
    }


}
