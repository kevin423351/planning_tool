<?php
namespace Concrete\Package\PlanningTool\Src\PlanningTool\Persons;

defined('C5_EXECUTE') or die('Access Denied.');

use Doctrine\ORM\Mapping as ORM;
use Concrete\Core\Support\Facade\DatabaseORM as dbORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="timeSlots", indexes={
 * })
 */

 class TimeSlot
 {
    /**
      * @ORM\Id
      * @ORM\Column(type="integer")
      * @ORM\GeneratedValue
      */
    protected $timeslotID;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $timeslotsDate;

     /**
     * @ORM\Column(type="string", length=150)
     */
    protected $timeslotsStarttime;

     /**
     * @ORM\Column(type="string", length=150)
     */
    protected $timeslotsEndtime;

    /**
     * @ORM\Column(type="integer", length=150)
     */
    protected $deleted;

    /**
     * @ORM\ManyToMany(targetEntity="Person", mappedBy="timeslots")
     */
    protected $per_timeslot;

    public static function getByID($timeslotID)
    {
        $em = dbORM::entityManager();
        return $em->find(get_class(), $timeslotID);
    }
    public function getItemID()
    {
        return $this->timeslotID;
    }

    public function setItemID($timeslotID)
    {
        $this->timeslotID = $timeslotID;
    }

    public function getDate()
    {
        return $this->timeslotsDate;
    }

    public function setDate($timeslotsDate)
    {
        $this->timeslotsDate = $timeslotsDate;
    }

    public function getStartTime()
    {
        return $this->timeslotsStarttime;
    }

    public function setStartTime($timeslotsStarttime)
    {
        $this->timeslotsStarttime = $timeslotsStarttime;
    }

    public function getEndTime()
    {
        return $this->timeslotsEndtime;
    }

    public function setEndTime($timeslotsEndtime)
    {
        $this->timeslotsEndtime = $timeslotsEndtime;
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