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

    public static function getByID($personID)
    {
        $em = dbORM::entityManager();
        return $em->find(get_class(), $personID);
    }
    public function getItemID()
    {
        return $this->personID;
    }

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $formName;
    
    public function getFirstname()
    {
        return $this->formName;
    }
    
    public function setFirstname($formName)
    {
        return $this->formName;
    }

    	/**
     * @ORM\Column(type="string", length=150)
     */
    protected $formLastname;

    public function getLastname()
    {
        return $this->formLastname;
    }

    public function setLastname($formLastname)
    {
        return $this->formLastname;
    }
    	/**
     * @ORM\Column(type="string", length=150)
     */
    protected $formEmail;

    public function getEmail()
    {
        return $this->formEmail;
    }

    public function setEmail($formEmail)
    {
        return $this->formEmail;
    }
    	/**
     * @ORM\Column(type="string", length=150)
     */
    protected $formDate;

    public function getDate()
    {
        return $this->formDate;
    }

    public function setDate($formDate)
    {
        return $this->formDate;
    }
}