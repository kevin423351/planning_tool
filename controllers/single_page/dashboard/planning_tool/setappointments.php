<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Timeslot;
use Concrete\Core\Page\Controller\DashboardPageController;

class Setappointments extends DashboardPageController
{   
    public function on_start()
    {      

        parent::on_start(); // Call the parent class's on_start method

        $person = Person::getAll(); // Get all expertises using the Person::getAll() method
        $this->set('persons', $person); // Set the 'persons' variable in the current instance to hold the retrieved person
    }
    
    public function view()
    {
        
    }

    public function personview($personID = 1)
    {
        if ((int)$personID != 0) {
            $person = Person::getByID($personID);
            $timeslots = $person->getTimeslots();
            $this->set('timeslots', $timeslots); 
        }
    }


    public function expertiseview()
    {
        
    }
} 
