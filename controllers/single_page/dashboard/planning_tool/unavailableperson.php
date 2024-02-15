<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Unavailable;
use Concrete\Core\Page\Controller\DashboardPageController;

class Unavailableperson extends DashboardPageController
{   
    public function view()
    {
        $unavailable = Unavailable::getAll(); // Get all expertises using the Person::getAll() method
        $this->set('unavailable', $unavailable); // Set the 'persons' variable in the current instance to hold the retrieved person

        $person = Person::getAll(); // Get all expertises using the Person::getAll() method
        $this->set('persons', $person); // Set the 'persons' variable in the current instance to hold the retrieved person
    }
    public function save()
    {       
        $post = $this->request->request;
        $unavailable = new Unavailable();

        $unavailable->setDate($post->get('unavailableDate'));
        $unavailable->setPerson($post->get('personID'));
        $unavailable->setStartTime($post->get('unavailableStarttime'));
        $unavailable->setEndTime($post->get('unavailableEndtime'));

        $unavailable->save();
    }
} 
