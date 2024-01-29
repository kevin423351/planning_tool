<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\TimeSlot;
use Concrete\Core\Page\Controller\DashboardPageController;

class persons extends DashboardPageController
{

    public function view()
    {
        $person = Person::getAll();
        $this->set('persons', $person);
    }


    public function edit($id) 
    {
        $person = Person::getByID($id);
        $this->set('person', $person);

        $expertises = Expertise::getAll();
        $this->set('expertises', $expertises);

        $timeSlot = TimeSlot::getAll();
        $this->set('timeSlots', $timeSlot);
        
        $expertises = [];
        foreach($person->getExpertises() as $expertise) { 
            $expertises[] = $expertise->getItemID(); 
        }
        $this->set('selectedExp', $expertises);
       
        $timeSlots = [];
        foreach($person->getTimeslots() as $timeSlot) { 
            $timeSlots[] = $timeSlot->getItemID(); 
        }
        $this->set('selectedtimeslot', $timeSlots);
    }

    public function add() 
    {
        $expertises = Expertise::getAll();
        $this->set('expertises', $expertises);

        $timeSlot = TimeSlot::getAll();
        $this->set('timeSlots', $timeSlot);
    }

    public function save() 
    {
        $person = new Person();
        
        $person->setFirstname($this->post('formName'));
        $person->setLastname($this->post('formLastname'));
        $person->setEmail($this->post('formEmail'));
        $person->setDate($this->post('formDate'));
        $person->setDeleted(0);

        $expertises = [];
        foreach($this->post('expertise') as $expertiseID)
        {
            $expertises[] = Expertise::getByID($expertiseID);
        }
        $person->setExpertises($expertises);

        $timeSlots = [];
        foreach($this->post('timeslot') as $timeslotID)
        {
            $timeSlots[] = TimeSlot::getByID($timeslotID);
        }
        $person->setTimeslots($timeSlots);
        $person->save();

        $this->buildRedirect('/dashboard/planning_tool/persons/')->send();
    }

    public function delete($id){
        $person = Person::getByID($id);
        $person->setDeleted(1);
        $person->save();
        $this->buildRedirect('/dashboard/planning_tool/persons/')->send();
    }

    public function saveform($id){
        $person = Person::getByID($id);

        $person->setFirstname($this->post('formName'));
        $person->setLastname($this->post('formLastname'));
        $person->setEmail($this->post('formEmail'));
        $person->setDate($this->post('formDate'));

        $expertises = [];
        foreach($this->post('expertise') as $expertiseID)
        {
            $expertises[] = Expertise::getByID($expertiseID);
        }
        $person->setExpertises($expertises);

        $timeSlots = [];
        foreach($this->post('timeslot') as $timeslotID)
        {
            $timeSlots[] = TimeSlot::getByID($timeslotID);
        }
        $person->setTimeslots($timeSlots);
        $person->save();
        $this->buildRedirect('/dashboard/planning_tool/persons/')->send();
    }
} 
