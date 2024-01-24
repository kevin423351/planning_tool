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
     * @ORM\Column(type="string", length=150)
     */
    protected $appointmentDate;
  
    /**
     * @ORM\Column(type="string", length=25)
     */
    protected $appointmentPhone;

    /**
     * @ORM\Column(type="text", length=150)
     */
    protected $appointmentComment;

    /**
     * @ORM\Column(type="integer", length=150)
     */
    protected $deleted;


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

    public function getDate()
    {
        return $this->appointmentDate;
    }

    public function setDate($appointmentDate)
    {
        $this->appointmentDate = $appointmentDate;
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