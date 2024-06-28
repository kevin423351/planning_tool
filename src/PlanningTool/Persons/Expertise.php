<?php
namespace Concrete\Package\PlanningTool\Src\PlanningTool\Persons;

defined('C5_EXECUTE') or die('Access Denied.');

use Doctrine\ORM\Mapping as ORM;
use Concrete\Core\Support\Facade\DatabaseORM as dbORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="expertises", indexes={
 * })
 */

 class Expertise
 {
    /**
      * @ORM\Id
      * @ORM\Column(type="integer")
      * @ORM\GeneratedValue
      */
    protected $expertiseID;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $expertiseName;

    /**
     * @ORM\Column(type="integer", length=150)
     */
    protected $deleted;

    /**
     * @ORM\ManyToMany(targetEntity="Person", mappedBy="expertises")
     */
    protected $persons;


    public static function getByID($expertiseID)
    {
        $em = dbORM::entityManager();
        return $em->find(get_class(), $expertiseID);
    }
    public function getItemID()
    {
        return $this->expertiseID;
    }

    public function setItemID($expertiseID)
    {
        $this->expertiseID = $expertiseID;
    }

    public static function getPersonsByExpertiseID($expertiseID)
    {
        $em = dbORM::entityManager();
        $expertise = $em->find(get_called_class(), $expertiseID);

        if ($expertise) {
            return $expertise->getPersons();
        }

        return [];
    }

    public function getPersons()
    {
        return $this->persons;
    }

    public function getPersonObject()
    {
        return Person::getByID($this->persons);
    }

    public function setPersons($persons)
    {
        $this->persons = $persons;
    }
    
    public function getFirstname()
    {
        return $this->expertiseName;
    }
    
    public function setFirstname($expertiseName)
    {
        $this->expertiseName = $expertiseName;
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
    public static function getPaginated($currentPage = 1, $itemsPerPage = 16)
    {
        $em = dbORM::entityManager();
        
        $offset = ($currentPage - 1) * $itemsPerPage;

        $qb = $em->createQueryBuilder();
        $qb->select('e')
        ->from(get_called_class(), 'e')
        ->where('e.deleted = :deleted')
        ->setParameter('deleted', 0)
        ->setFirstResult($offset)
        ->setMaxResults($itemsPerPage);


        $query = $qb->getQuery();
        $expertises = $query->getResult();

        $qbTotal = $em->createQueryBuilder();
        $qbTotal->select('COUNT(e.expertiseID)') 
                ->from(get_called_class(), 'e')
                ->where('e.deleted = :deleted')
                ->setParameter('deleted', 0);
        
        $totalExpertises = $qbTotal->getQuery()->getSingleScalarResult();
        $totalPages = ceil($totalExpertises / $itemsPerPage);

        return [
            'expertises' => $expertises,
            'totalExpertises' => $totalExpertises,
            'totalPages' => $totalPages,
            'currentPage' => $currentPage
        ];
    }
}
