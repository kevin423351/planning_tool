<?php
namespace Concrete\Package\PlanningTool\Src\PlanningTool\Persons;

defined('C5_EXECUTE') or die('Access Denied.');

use Doctrine\ORM\Mapping as ORM;
use Concrete\Core\Support\Facade\DatabaseORM as dbORM;
use Doctrine\Common\Collections\ArrayCollection;

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


    /**
     * @ORM\ManyToMany(targetEntity="Expertise", inversedBy="persons")
     * @ORM\JoinTable(
     *     name="person_expertise",
     *     joinColumns={@ORM\JoinColumn(name="personID", referencedColumnName="personID")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="expertiseID", referencedColumnName="expertiseID")}
     * )
     */
    protected $expertises;

     /**
     * @ORM\OneToMany(targetEntity="Timeslot", mappedBy="person", indexBy="timeslotID", cascade={"persist"}, orphanRemoval=true)
     */
    protected $timeslots;
    
    public function __construct() 
    {
        $this->expertises = new ArrayCollection();
        $this->timeslots = new ArrayCollection();
    }

    public static function getByID($personID)
    {
        $em = dbORM::entityManager();
        return $em->find(get_class(), $personID);
    }
    public function ()
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

    public function setExpertises($expertises)
    {
        $this->expertises = $expertises;
    }
    public function addExperise($expertise)
    {
        $this->expertises->add($expertise);
    }
    public function getExpertises()
    {
        return $this->expertises;
    }
    public function hasExpertise($expertiseToCheck) {
        foreach ($this->getExpertises() as $expertise) {
            if ($expertise->getItemID() === $expertiseToCheck->getItemID()) {
                return true;
            }
        }
        return false;
    }

    public function getTimeslotsByID($timeslotID)
    {
        return $this->timeslots[$timeslotID];
    }
    public function getTimeslotsCount()
    {
        return count($this->getTimeslots());
    }
    public function removeTimeslots($timeslots)
    {
        if (is_object($timeslots)) {
            $this->timeslots->removeElement($timeslots);
        }
        $this->timeslots->remove($timeslots);
    }
    public function clearTimeslots()
    {
        $this->timeslots->clear();
    }
    public function setTimeslots($timeslots)
    {
        $this->timeslots = $timeslots;
    }
    public function addTimeslots($timeslots)
    {
        $this->timeslots->add($timeslots);
    }
    public function getTimeslots()
    {
        return $this->timeslots;
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
    public static function getAll()
    {
        $em = dbORM::entityManager();
        $results = $em->getRepository(get_called_class())->findBy(['deleted' => 0]);
        return $results;
    }
}