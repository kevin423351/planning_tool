<?php
namespace Concrete\Package\PlanningTool\Src\PlanningTool\Persons;

defined('C5_EXECUTE') or die('Access Denied.');

use Doctrine\ORM\Mapping as ORM;
use Concrete\Core\Support\Facade\DatabaseORM as dbORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="expertises", indexes={
 * })
 */

 class Expertise
 {
    /**
      * @ORM\Id
      * @ORM\Column(type="integer")
      * @ORM\GeneratedValue
      */
    protected $expertiseID;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $expertiseName;

    /**
     * @ORM\Column(type="integer", length=150)
     */
    protected $deleted;

    /**
     * @ORM\ManyToMany(targetEntity="Person", mappedBy="expertises")
     */
    private $persons;


    public static function getByID($expertiseID)
    {
        $em = dbORM::entityManager();
        return $em->find(get_class(), $expertiseID);
    }
    public function getItemID()
    {
        return $this->expertiseID;
    }

    public function setItemID($expertiseID)
    {
        $this->expertiseID = $expertiseID;
    }
    
    public function getFirstname()
    {
        return $this->expertiseName;
    }
    
    public function setFirstname($expertiseName)
    {
        $this->expertiseName = $expertiseName;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    public function save()
    {
        $em = dbORM::entityManager();
        $em->persist($this);
        $em->flush();
    }

    public function delete()
    {
        $em = dbORM::entityManager();
        $em->remove($this);
        $em->flush();
    }

    public static function getAll()
    {
        $em = dbORM::entityManager();
        $results = $em->getRepository(get_called_class())->findBy(['deleted' => 0]);
        return $results;
    }
}