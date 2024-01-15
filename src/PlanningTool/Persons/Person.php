<?php
namespace Concrete\Package\PlanningTool\Src\PlanningTool\Persons;

defined('C5_EXECUTE') or die('Access Denied.');

use Doctrine\ORM\Mapping as ORM;
use Concrete\Core\Support\Facade\DatabaseORM as dbORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="persons", indexes={
 * })
 */

 class Person
 {
    /**
      * @ORM\Id
      * @ORM\Column(type="integer")
      * @ORM\GeneratedValue
      */
    protected $personID;

    public function getID()
    {
        return $this->ID;
    }

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $formName;
    
    public function getFirstname()
    {
        return $this->firstname;
    }
    
    public function setFirstname($firstname)
    {
        return $this->firstname;
    }

    	/**
     * @ORM\Column(type="string", length=150)
     */
    protected $formLastname;

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        return $this->lastname;
    }
    	/**
     * @ORM\Column(type="string", length=150)
     */
    protected $formEmail;

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        return $this->email;
    }
    	/**
     * @ORM\Column(type="string", length=150)
     */
    protected $formDate;

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        return $this->date;
    }
}