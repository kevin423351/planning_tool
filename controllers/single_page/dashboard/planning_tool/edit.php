<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;

use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Core\Page\Controller\DashboardPageController;
use Database;

class Edit extends DashboardPageController
{
    
    public function view($id)
    {
        $person = Person::getByID($id);
        $this->set('person', $person);
    }


    public function save($id) 
    {
        $person = Person::getByID($id);
        // wtf($person, $this->post());
        $person->setFirstname($this->post('formName'));
        $person->setLastname($this->post('formLastname'));
        $person->setEmail($this->post('formEmail'));
        $person->setDate($this->post('formDate'));
        // wtfd($person, $this->post());  
        $person->save();
        $this->buildRedirect('/dashboard/planning_tool/persons/')->send();
    }
} 
?>