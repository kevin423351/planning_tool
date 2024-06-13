<?php
namespace Concrete\Package\PlanningTool\Src\PlanningTool\Persons;

defined('C5_EXECUTE') or die('Access Denied.');

use Doctrine\ORM\Mapping as ORM;
use Concrete\Core\Support\Facade\DatabaseORM as dbORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="unavailable", indexes={
 * })
 */

 class Unavailable
 {
    /**
      * @ORM\Id
      * @ORM\Column(type="integer")
      * @ORM\GeneratedValue
      */
    protected $unavailableID;
    
    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $unavailableDate;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $unavailableStarttime;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $unavailableEndtime;

    /**
     * @ORM\Column(type="integer", length=11 )
     */
    protected $personID;
    /**
     * @ORM\Column(type="integer", length=1, options={"default" : 30})
     */
    protected $deleted = 0;


    public static function getByID($unavailableID)
    {
        $em = dbORM::entityManager();
        return $em->find(get_class(), $unavailableID);
    }
    public function getItemID()
    {
        return $this->unavailableID;
    }

    public function setItemID($unavailableID)
    {
        $this->unavailableID = $unavailableID;
    }

    public function getPerson()
    {
        return $this->personID;
    }

    public function getPersonObject()
    {
        return Person::getByID($this->personID);
    }

    public function setPerson($personID)
    {
        // Store only the personID
        $this->personID = $personID;
    }

    public function getDate()
    {
        return $this->unavailableDate;
    }

    public function setDate($unavailableDate)
    {
        $this->unavailableDate = $unavailableDate;
    }

    public function getStartTime()
    {
        return $this->unavailableStarttime;
    }

    public function setStartTime($unavailableStarttime)
    {
        $this->unavailableStarttime = $unavailableStarttime;
    }

    public function getEndTime()
    {
        return $this->unavailableEndtime;
    }

    public function setEndTime($unavailableEndtime)
    {
        $this->unavailableEndtime = $unavailableEndtime;
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

    public function unavailableExist($personID, $date, $time) 
    {
        $db = \Database::get()->createQueryBuilder();
 
        $query = $db->select('unavailableID')
        ->from('unavailable')
        ->where('unavailableDate = :unavailableDate')
        ->andWhere(':time BETWEEN unavailableStarttime AND unavailableEndtime')
        ->andWhere('PersonID = :personID')
        ->setParameter('personID', $personID)
        ->setParameter('unavailableDate', $date)
        ->setParameter('time', $time)
        ->execute();
        
        if (count($query->fetchAll()) >= 1) {
            return true;
        }
        return false;
    }
}