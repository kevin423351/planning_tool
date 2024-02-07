<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\TimeSlot;
use Concrete\Core\Page\Controller\DashboardPageController;

class Persons extends DashboardPageController
{   
    public function on_start()
    {
        parent::on_start();
        
        $expertises = Expertise::getAll();
        $this->set('expertises', $expertises);

        $timeSlot = TimeSlot::getAll();
        $this->set('timeSlots', $timeSlot);
    }

    public function view()
    {
        $person = Person::getAll();
        $this->set('persons', $person);
    }

    public function edit($id) 
    {
        $person = Person::getByID($id);
        $this->set('person', $person);
        
        $expertises = [];
        foreach($person->getExpertises() as $expertise) { 
            $expertises[] = $expertise->getItemID(); 
        }
        $this->set('selectedExp', $expertises);
    }

    public function add() 
    {
        // do nothing
    }

    public function save($id = null) 
    {   
        $post = $this->request->request;
        $orig = null;

        if ($id !== null) {
            $person = Person::getByID($id);
        } else {
            $person = new Person();
            $person->setDeleted(0);
        }

        $person->setFirstname($post->get('formName'));
        $person->setLastname($post->get('formLastname'));
        $person->setEmail($post->get('formEmail'));
        $person->setDate($post->get('formDate'));

        $expertises = [];
        foreach ((array)$post->get('expertise') as $expertiseID) {
            $expertises[] = Expertise::getByID($expertiseID);
        }
        $person->setExpertises($expertises);
        
        $person->save();

        foreach (array_keys($post->get('timeslotsDays')) as $key)
        {
        	$ts = new TimeSlot();
        	$ts->setPerson($person);

        	// Check if already there!
        	if ($orig && $key > 0) {
        	    $ts = $person->getTimeslotsByID($key);
        	}
	
	        $timeslotsDays = $post->get('timeslotsDays');
	        if (isset($timeslotsDays[$key])) {
	            $ts->setDay($timeslotsDays[$key]);
	        }
	
	        $timeSlotsStartTime = $post->get('timeSlotsStartTime');
	        if (isset($timeSlotsStartTime[$key])) {
	            $ts->setStartTime($timeSlotsStartTime[$key]);
	        }
	
	        $timeSlotsEndTime = $post->get('timeSlotsEndTime');
	        if (isset($timeSlotsEndTime[$key])) {
	            $ts->setEndTime($timeSlotsEndTime[$key]);
	        }
	
	        $appointmentTime = $post->get('appointmentTime');
	        if (isset($appointmentTime[$key])) {
	            $ts->setAppointmentTime($appointmentTime[$key]);
        	}

	        if (!$orig || (int)$ts->getItemID() == 0) {
	            $person->addTimeslots($ts);
         	}


            $ts->save();
	    }
	    $this->buildRedirect('/dashboard/planning_tool/persons/')->send();  
    }


    public function delete($id){
        $person = Person::getByID($id);
        $person->setDeleted(1);
        $person->save();
        $this->buildRedirect('/dashboard/planning_tool/persons/')->send();
    }

} 
