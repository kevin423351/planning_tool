<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Core\Page\Controller\DashboardPageController;
use Database;

class Add extends DashboardPageController
{
    public function view()
    {
        // $person = new Person();

        // $this->set('person', $person);

        // $person->setFirstname('TEST SET NAME');
        // $person->setLastname('TEST SET LASTNAME');
        // $person->setEmail('TEST SET EMAIL');
        // $person->setDate('TEST SET DATE');
        // $person->save();
    }


    public function save() 
    {
        $person = new Person();
        
        $person->setFirstname($this->post('formName'));
        $person->setLastname($this->post('formLastname'));
        $person->setEmail($this->post('formEmail'));
        $person->setDate($this->post('formDate'));
        
        $person->save();

        $this->buildRedirect('/dashboard/planning_tool/persons/')->send();
    }
} 
?>
