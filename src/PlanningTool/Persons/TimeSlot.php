<?php
namespace Concrete\Package\PlanningTool\Src\PlanningTool\Persons;

defined('C5_EXECUTE') or die('Access Denied.');

use Doctrine\ORM\Mapping as ORM;
use Concrete\Core\Support\Facade\DatabaseORM as dbORM;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Unavailable;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;

use DateTime;
use DateInterval;
/**
 * @ORM\Entity
 * @ORM\Table(name="timeslots", indexes={
 * })
 */

 class Timeslot
 {
    /**
      * @ORM\Id
      * @ORM\Column(type="integer")
      * @ORM\GeneratedValue
      */
    protected $timeslotID;
    
    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="timeslots")
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

    public function getAvailableTimeSlots($personID = null, $expertiseID = null, $currentDate)
    {
        $persons = [];

        if ($personID !== null) {
            $persons[] = Person::getByID($personID);
        } elseif ($expertiseID !== null) {
            $persons = Expertise::getPersonsByExpertiseID($expertiseID);
        }

        $buttons = [];

        foreach ($persons as $person) {
            $personID = $person->getItemID();
            $timeslots = $person->getTimeslots();

            foreach ($timeslots as $timeslot) {
                $startTime = new DateTime($timeslot->getStartTime());
                $endTime = new DateTime($timeslot->getEndTime());
                $appointmentTime = $timeslot->getAppointmentTime();
                $date = date('Y-m-d', strtotime((string)$timeslot->getday() . ' this week', $currentDate->getTimestamp()));

                if (date('Y-m-d') > $date) {
                    $buttons[$date] = [];
                    continue;
                }
            
                if (!isset($buttons[$date])) {
                    $buttons[$date] = [];
                }

                while ($startTime < $endTime) {
                    $blockEndTime = clone $startTime;
                    $blockEndTime->add(new DateInterval('PT' . $appointmentTime . 'M'));

                    $isUnavailable = Unavailable::unavailableExist($personID, $date, $startTime->format('H:i'));
                    $isChosen = Appointment::appointmentExist($personID, $date, $startTime->format('H:i'));

                    if (!$isUnavailable && !$isChosen) {
                        if (!array_key_exists($startTime->format('H:i'), $buttons[$date])) {
                            $buttons[$date][$startTime->format('H:i')] = [
                                'startTime' => $startTime->format('H:i'),
                                'endTime' => $blockEndTime->format('H:i'),
                                'personID' => $personID,
                            ];
                        }
                    }
                    $startTime = $blockEndTime;
                }
            }
        }

        ksort($buttons);

        foreach ($buttons as $key => $data) {
            ksort($data);
            $buttons[$key] = $data;
        }

        return $buttons;
    }
}
