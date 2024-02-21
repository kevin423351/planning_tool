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

            $buttons = $this->generateTimeSlotButtons($personID, $timeslots);
        
            // $this->set('unavailable', $unavailable); 
            $this->set('buttons', $buttons);
            $this->set('timeslots', $timeslots); 
        }
    }


    public function generateTimeSlotButtons($personID, $timeslots)
    {
        $buttons = [];
    
        foreach ($timeslots as $timeslot) {
            $startTime = new DateTime($timeslot->getStartTime());
            $endTime = new DateTime($timeslot->getEndTime());
            $date = date('Y-m-d', strtotime((string)$timeslot->getday().' this week'));
    
            if (!isset($buttons[$date])) {
                $buttons[$date] = array();
            }

            // Loop through the blocks of 30 minutes
            while ($startTime < $endTime) {
                $blockEndTime = clone $startTime;
                $blockEndTime->add(new DateInterval('PT30M'));

                $isUnavailable = Unavailable::bestaatIeAl($personID, $date, $startTime->format('H:i'));
    
                if (!$isUnavailable) {
                    // Time slot is not within any unavailable range, add to buttons array
                    $buttons[$date][] = [
                        'startTime' => $startTime->format('H:i'),
                        'endTime' => $blockEndTime->format('H:i'),
                    ];
                }
                $startTime = $blockEndTime;
            }
        }
    
        return $buttons;
    }
    

    public function expertiseview()
    {
        
    }
} 
