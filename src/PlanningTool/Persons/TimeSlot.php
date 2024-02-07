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
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="timeSlots")
     * @ORM\JoinColumn(name="personID", referencedColumnName="personID")
     */
    protected $person;
    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $timeslotsDays;

     /**
     * @ORM\Column(type="string", length=150)
     */
    protected $timeslotsStarttime;

     /**
     * @ORM\Column(type="string", length=150)
     */
    protected $timeslotsEndtime;

    /**
     * @ORM\Column(type="integer", options={"default" : 30})
     */
    protected $appointmentTime = 30;

    /**
     * @ORM\Column(type="integer", length=1, options={"default" : 30})
     */
    protected $deleted = 0;

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

    public function getPerson()
    {
        return $this->person;
    }
    public function getPersonObject()
    {
        return $this->getPerson();
    }
    public function setPerson($person)
    {
        if (!is_object($person) && (float)$person != 0) {
            $person = Person::getByID($person);
        }
        if (is_object($person)) {
            $this->person = $person;
        }
    }

    public function getDay()
    {
        return $this->timeslotsDays;
    }

    public function setDay($timeslotsDays)
    {
        $this->timeslotsDays = $timeslotsDays;
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

    public function getAppointmentTime()
    {
        return $this->appointmentTime;
    }

    public function setAppointmentTime($appointmentTime)
    {
        $this->appointmentTime = $appointmentTime;
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

// public function getDateAdded($display = false, $format = 'Y-m-d H:i:s')
// {
//     if (!$display) {
//         return $this->rowAdded;
//     }
//     return app()->make('helper/date')->formatDateTime(strtotime($this->rowAdded->format($format)));
// }
// public function setDateAdded($rowAdded)
// {
//     $this->rowAdded = $rowAdded;
// }
