<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Timeslot;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Unavailable;
use Concrete\Core\Page\Controller\DashboardPageController;
use DateTime;
use DateInterval;

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

            // $unavailable = Unavailable::getAll();
            // $unavailableDate = $_POST['unavailableDate'];
            // $unavailableStartTime = $_POST['unavailableStarttime'];
            // $unavailableEndTime = $_POST['unavailableEndtime'];
            
            $buttons = $this->generateTimeSlotButtons($timeslots, $unavailable, $unavailableDate, $unavailableStartTime, $unavailableEndTime);
        
            // $this->set('unavailable', $unavailable); 
            $this->set('buttons', $buttons);
            $this->set('timeslots', $timeslots); 

            $currentDates = [];
            foreach ($timeslots as $timeslot) {
                $currentDates[$timeslot->getday()] = $this->getCurrentDateForDay($timeslot->getday())->format('Y-m-d');
            }
            $this->set('currentDates', $currentDates);
        }
    }
    function getCurrentDateForDay($day)
    {
        // Get the current date
        $currentDate = new DateTime();
        // Find the current day of the week
        $currentDay = strtolower($currentDate->format('l'));
        // Calculate the difference in days between the current day and the desired day
        $dayDiff = array_search(strtolower($day), ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']) - array_search($currentDay, ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
        // Add the difference to the current date to get the desired date
        $currentDate->modify("+$dayDiff days");
        return $currentDate;
    }

    public function generateTimeSlotButtons($timeslots, $unavailable, $unavailableDate, $unavailableStartTime, $unavailableEndTime)
    {
    $buttons = [];
    foreach ($timeslots as $timeslot) {
        $startTime = new DateTime($timeslot->getStartTime());
        $endTime = new DateTime($timeslot->getEndTime());

        // Loop through the blocks of 30 minutes
        while ($startTime < $endTime) {
            $blockEndTime = clone $startTime;
            $blockEndTime->add(new DateInterval('PT30M'));

            // Check if the current time slot falls within the unavailable range
            // $unavailableStart = new DateTime($unavailable->getDate() . ' ' . $unavailable->getStartTime());
            // $unavailableEnd = new DateTime($unavailable->getDate() . ' ' . $unavailable->getEndTime());

            // if (!($blockEndTime <= $unavailableStart || $startTime >= $unavailableEnd)) {
                // Time slot is not within the unavailable range, add to buttons array
                $buttons[$timeslot->getday()][] = [
                    'startTime' => $startTime->format('H:i'),
                    'endTime' => $blockEndTime->format('H:i'),
                ];
            // }
            $startTime = $blockEndTime;
        } 
    }
    return $buttons;
    }

    public function expertiseview()
    {
        
    }
} 
