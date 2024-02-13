<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Timeslot;
use Concrete\Core\Page\Controller\DashboardPageController;

class Persons extends DashboardPageController
{   
    public function on_start()
    {      

        parent::on_start(); // Call the parent class's on_start method
        
        $expertises = Expertise::getAll(); // Get all expertises using the Expertise::getAll() method
        $this->set('expertises', $expertises); // Set the 'expertises' variable in the current instance to hold the retrieved expertises
    }

    public function view()
    {
        $person = Person::getAll(); // Get all expertises using the Person::getAll() method
        $this->set('persons', $person); // Set the 'persons' variable in the current instance to hold the retrieved person
    }

    public function edit($id) 
    {
        $person = Person::getByID($id); // Retrieve a Person object by ID
        $this->set('person', $person); // Set the 'person' variable in the current instance to hold the retrieved person

        $timeslots = $person->getTimeslots(); // Retrieve timeslots associated with the person
        $this->set('timeslots', $timeslots); // Set the 'timeslots' variable to be used in the view
    }

    public function add() 
    {
        // $this->set('timeslots', $timeslots);  
    }

    public function save($id = null) 
    {   
        $post = $this->request->request;
        // Check if $id is provided
        if ($id !== null) {
            $person = Person::getByID($id);
        } else {
             // If $id is not provided, create a new Person object
            $person = new Person();
            $person->setDeleted(0);
        }
        // Set person attributes based on form data
        $person->setFirstname($post->get('formName'));
        $person->setLastname($post->get('formLastname'));
        $person->setEmail($post->get('formEmail'));
        $person->setDate($post->get('formDate'));

        // Process and set expertises associated with the person
        $expertises = [];
        foreach ((array)$post->get('expertise') as $expertiseID) {
            $expertises[] = Expertise::getByID($expertiseID);
        }
        $person->setExpertises($expertises);
        // Save the person object
        $person->save();

        // Process and save time slots associated with the person
        foreach (array_keys($post->get('timeslotsDays')) as $key)
        {
            // get the timeslot ID
            $ts = null;
            if ((int)$key > 0) {
                $ts = TimeSlot::getByID($key);
            } 

            if (!is_object($ts)) {
                // If $id is not provided, create a new Timeslot object
                $ts = new Timeslot();
                $ts->setPerson($person);
            }

            // Set time slot attributes based on form data
	        $timeslotsDays = $post->get('timeslotsDays');
	        if (isset($timeslotsDays[$key])) {
	            $ts->setDay($timeslotsDays[$key]);
	        }
	
	        $timeslotsStartTime = $post->get('timeslotsStartTime');
	        if (isset($timeslotsStartTime[$key])) {
	            $ts->setStartTime($timeslotsStartTime[$key]);
	        }
	
	        $timeslotsEndTime = $post->get('timeslotsEndTime');
	        if (isset($timeslotsEndTime[$key])) {
	            $ts->setEndTime($timeslotsEndTime[$key]);
	        }
	
	        $appointmentTime = $post->get('appointmentTime');
	        if (isset($appointmentTime[$key])) {
	            $ts->setAppointmentTime($appointmentTime[$key]);
        	}
    
            // If a new time slot or not existing, add it to the person's time slots
	        $person->addTimeslots($ts);

            $ts->save();
	    }

        // Redirect after processing the form
	    $this->buildRedirect('/dashboard/planning_tool/persons/')->send();  
    }


    public function delete($id){
        $person = Person::getByID($id);
        $person->setDeleted(1);
        $person->save();
        $this->buildRedirect('/dashboard/planning_tool/persons/')->send();
    }

} 
