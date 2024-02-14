<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Unavailable;
use Concrete\Core\Page\Controller\DashboardPageController;

class Unavailablee extends DashboardPageController
{   
    public function on_start()
    {      

        parent::on_start(); // Call the parent class's on_start method

        $unavailable = Unavailable::getAll(); // Get all expertises using the Person::getAll() method
        $this->set('unavailable', $unavailable); // Set the 'persons' variable in the current instance to hold the retrieved person
    }
    
    public function view()
    {
        $person = Person::getAll(); // Get all expertises using the Person::getAll() method
        $this->set('persons', $person); // Set the 'persons' variable in the current instance to hold the retrieved person
        wtfd($persons);
    }
    public function save()
    {
        // $unavailable = Person::getByID($PersonID);
        // $unavailable->setItemID($post->get('unavailableID'));
        // $unavailable->setDate($post->get('unavailableDate'));
        // $unavailable->setStartTime($post->get('unavailableStarttime'));
        // $unavailable->setEndTime($post->get('unavailableEndtime'));
        // $unavailable->save();
    }

} 
