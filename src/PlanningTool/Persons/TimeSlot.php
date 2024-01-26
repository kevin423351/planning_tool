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
    protected $timeSlotID;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $timeSlotsDate;

     /**
     * @ORM\Column(type="string", length=150)
     */
    protected $timeSlotsStartTime;

     /**
     * @ORM\Column(type="string", length=150)
     */
    protected $timeSlotsEndTime;

    /**
     * @ORM\Column(type="integer", length=150)
     */
    protected $deleted;


    public static function getByID($timeSlotID)
    {
        $em = dbORM::entityManager();
        return $em->find(get_class(), $timeSlotID);
    }
    public function getItemID()
    {
        return $this->timeSlotID;
    }

    public function setItemID($timeSlotID)
    {
        $this->timeSlotID = $timeSlotID;
    }

    public function getDate()
    {
        return $this->timeSlotsDate;
    }

    public function setDate($timeSlotsDate)
    {
        $this->timeSlotsDate = $timeSlotsDate;
    }

    public function getStartTime()
    {
        return $this->timeSlotsStartTime;
    }

    public function setStartTime($timeSlotsStartTime)
    {
        $this->timeSlotsStartTime = $timeSlotsStartTime;
    }

    public function getEndTime()
    {
        return $this->timeSlotsEndTime;
    }

    public function setEndTime($timeSlotsEndTime)
    {
        $this->timeSlotsEndTime = $timeSlotsEndTime;
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