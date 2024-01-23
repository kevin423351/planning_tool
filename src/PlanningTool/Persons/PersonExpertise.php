<?php
namespace Concrete\Package\PlanningTool\Src\PlanningTool\Persons;

defined('C5_EXECUTE') or die('Access Denied.');

use Doctrine\ORM\Mapping as ORM;
use Concrete\Core\Support\Facade\DatabaseORM as dbORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="PersonExpertise", indexes={
 * })
 */

 class PersonExpertise
 {
    /**
      * @ORM\Id
      * @ORM\Column(type="integer")
      * @ORM\GeneratedValue
      */

    protected $PersonExpertiseID;

    /**
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(name="Person_id", referencedColumnName="personID")
     */
    protected $Person_id;

    /**
     * @ORM\ManyToOne(targetEntity="Expertise")
     * @ORM\JoinColumn(name="Expertise_id", referencedColumnName="expertiseID")
     */
    protected $Expertise_id;

    // protected $personset;

    // public function setPerson($personset) {
    //     $this->personset = $personset;
    // }
    // protected $Expertiseset;

    // public function setExpertise($Expertiseset) {
    //     $this->Expertiseset = $Expertiseset;
    // }
}