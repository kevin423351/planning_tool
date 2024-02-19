<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Timeslot;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Unavailable;
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
            // $unavailableObjects = Unavailable::getAll();
            // $this->set('unavailableObjects', $unavailableObjects); 
            
        }
    }

    public function someControllerMethod()
    {
    // Assuming these values come from somewhere, replace them with your actual logic
    $unavailableDate = $_POST['unavailableDate'];
    $unavailableStartTime = $_POST['unavailableStarttime'];
    $unavailableEndTime = $_POST['unavailableEndtime'];
    $timeslots = $person->getTimeslots();
    
    $buttons = $this->generateTimeSlotButtons($unavailableDate, $unavailableStartTime, $unavailableEndTime);

    // Pass the data to the view
    $this->set('timeslots', $timeslots);
    $this->set('buttons', $buttons);
    }

    public function generateTimeSlotButtons($unavailableDate, $unavailableStartTime, $unavailableEndTime)
    {
    $buttons = [];

    $startTime = new DateTime($this->getStartTime());
    $endTime = new DateTime($this->getEndTime());

    // Loop through the blocks of 30 minutes
    while ($startTime < $endTime) {
        $blockEndTime = clone $startTime;
        $blockEndTime->add(new DateInterval('PT30M'));

        // Check if the current time slot falls within the unavailable range
        $unavailableStart = new DateTime($unavailableDate . ' ' . $unavailableStartTime);
        $unavailableEnd = new DateTime($unavailableDate . ' ' . $unavailableEndTime);

        if (!($blockEndTime <= $unavailableStart || $startTime >= $unavailableEnd)) {
            // Time slot is not within the unavailable range, add to buttons array
            $buttons[] = [
                'startTime' => $startTime->format('H:i'),
                'endTime' => $blockEndTime->format('H:i'),
            ];
        }
        $startTime = $blockEndTime;
    }
    return $buttons;
    }
    public function expertiseview()
    {
        
    }
} 
