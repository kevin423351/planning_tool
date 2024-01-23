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

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $formName;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $formLastname;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $formEmail;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $formDate;

    /**
     * @ORM\Column(type="integer", length=150)
     */
    protected $deleted;
    
    public static function getByID($personID)
    {
        $em = dbORM::entityManager();
        return $em->find(get_class(), $personID);
    }
    public function getItemID()
    {
        return $this->personID;
    }

    public function setItemID($personID)
    {
        $this->personID = $personID;
    }

    public function getFirstname()
    {
        return $this->formName;
    }
    
    public function setFirstname($formName)
    {
        $this->formName = $formName;
    }

    public function getLastname()
    {
        return $this->formLastname;
    }

    public function setLastname($formLastname)
    {
        $this->formLastname = $formLastname;
    }

    public function getEmail()
    {
        return $this->formEmail;
    }

    public function setEmail($formEmail)
    {
        $this->formEmail = $formEmail;
    }

    public function getDate()
    {
        return $this->formDate;
    }

    public function setDate($formDate)
    {
        $this->formDate = $formDate;
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
}