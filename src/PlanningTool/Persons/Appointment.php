<?php
namespace Concrete\Package\PlanningTool\Src\PlanningTool\Persons;

defined('C5_EXECUTE') or die('Access Denied.');

use Doctrine\ORM\Mapping as ORM;
use Concrete\Core\Support\Facade\DatabaseORM as dbORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="appointments", indexes={
 * })
 */

 class Appointment
 {
    /**
      * @ORM\Id
      * @ORM\Column(type="integer")
      * @ORM\GeneratedValue
      */
    protected $appointmentID;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $appointmentName;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $appointmentLastname;
    
    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $appointmentEmail;
  
    /**
     * @ORM\Column(type="string", length=25)
     */
    protected $appointmentPhone;

    /**
     * @ORM\Column(type="text", length=150)
     */
    protected $appointmentComment;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $appointmentDatetime;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $appointmentStartTime;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $appointmentEndTime;
    /**
     * @ORM\Column(type="integer", length=11)
     */
    protected $expertiseID;
    /**
     * @ORM\Column(type="integer", length=11)
     */
    protected $personID;

    /**
     * @ORM\Column(type="integer", length=150)
     */
    protected $deleted;

    public static function getAllByDate($date)
    {
        $em = dbORM::entityManager();

        $qb = $em->createQueryBuilder();

        $qb->select('a')
           ->from('Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Appointment', 'a')
           ->where('a.appointmentDatetime = :date')
           ->setParameter('date', $date);

        return $qb->getQuery()->getResult();
    }

     public static function countAppointmentsByDate($date)
    {
        $qb = dbORM::entityManager()->createQueryBuilder();

        $qb->select('COUNT(a)')
           ->from('Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Appointment', 'a')
           ->where('a.appointmentDatetime = :date')
           ->setParameter('date', $date);

        return $qb->getQuery()->getSingleScalarResult();
    }
  
    public static function getByID($appointmentID)
    {
        $em = dbORM::entityManager();
        return $em->find(get_class(), $appointmentID);
    }
    public function getItemID()
    {
        return $this->appointmentID;
    }

    public function setItemID($appointmentID)
    {
        $this->appointmentID = $appointmentID;
    }
    
    public function getFirstname()
    {
        return $this->appointmentName;
    }
    
    public function setFirstname($appointmentName)
    {
        $this->appointmentName = $appointmentName;
    }
    
    public function getLastname()
    {
        return $this->appointmentLastname;
    }
    
    public function setLastname($appointmentLastname)
    {
        $this->appointmentLastname = $appointmentLastname;
    }

    public function getEmail()
    {
        return $this->appointmentEmail;
    }

    public function setEmail($appointmentEmail)
    {
        $this->appointmentEmail = $appointmentEmail;
    }

    public function getPhonenumber()
    {
        return $this->appointmentPhone;
    }

    public function setPhonenumber($appointmentPhone)
    {
        $this->appointmentPhone = $appointmentPhone;
    }

    public function getComment()
    {
        return $this->appointmentComment;
    }

    public function setComment($appointmentComment)
    {
        $this->appointmentComment = $appointmentComment;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
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
    
    public function getExpertise()
    {
        return $this->expertiseID;
    }


    public function setExpertise($expertiseID)
    {
        $this->expertiseID = $expertiseID;
    }

    public function getExpertiseObject()
    {
        return Expertise::getByID($this->expertiseID);
    }

    public function getAppointmentDatetime()
    {
        return $this->appointmentDatetime;
    }


    public function setAppointmentDatetime($appointmentDatetime)
    {
        $this->appointmentDatetime = $appointmentDatetime;
    }

    public function getAppointmentStartTime()
    {
        return $this->appointmentStartTime;
    }

    public function setAppointmentStartTime($appointmentStartTime)
    {
        $this->appointmentStartTime = $appointmentStartTime;
    }

    public function getAppointmentEndTime()
    {
        return $this->appointmentEndTime;
    }

    public function setAppointmentEndTime($appointmentEndTime)
    {
        $this->appointmentEndTime = $appointmentEndTime;
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
    public function appointmentExist($personID, $date, $time) 
    {
        $db = \Database::get()->createQueryBuilder();
 
        $query = $db->select('appointmentID')
        ->from('appointments')
        ->where('appointmentDatetime = :appointmentDatetime')
        ->andWhere(':time BETWEEN appointmentStartTime AND appointmentEndTime')
        ->andWhere(':time != appointmentEndTime')
        ->andWhere('PersonID = :personID')
        ->setParameter('personID', $personID)
        ->setParameter('appointmentDatetime', $date)
        ->setParameter('time', $time)
        ->execute();

        if (count($query->fetchAll()) >= 1) {
            return true;
        }
        return false;
    }
}