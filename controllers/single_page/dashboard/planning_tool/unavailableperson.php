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

        $selectedPersonID = $post->get('personID');
        $unavailableOption = $post->get('unavailableOption');

        if ($selectedPersonID === 'all') {
            $this->saveForAllPersons($post, $unavailableOption);
        } else {
            switch ($unavailableOption) {
                case 'specific_date':
                    $this->saveSpecificDate($post, $selectedPersonID);
                    break;
                case 'whole_day':
                    $this->saveWholeDay($post, $selectedPersonID);
                    break;
                case 'date_range':
                    $this->saveDateRange($post, $selectedPersonID);
                    break;
                default:
                    // Handle default case or show error message
                    break;
            }
        }
    }

    private function saveForAllPersons($post, $unavailableOption)
    {
        $persons = Person::getAll(); 
        foreach ($persons as $person) {
            switch ($unavailableOption) {
                case 'specific_date':
                    $this->saveSpecificDate($post, $person->getItemID());
                    break;
                case 'whole_day':
                    $this->saveWholeDay($post, $person->getItemID());
                    break;
                case 'date_range':
                    $this->saveDateRange($post, $person->getItemID());
                    break;
                default:
                    // Handle default case or show error message
                    break;
            }
        }
    }

    
    private function saveSpecificDate($post, $selectedPersonID)
    {
        $unavailable = new Unavailable(); // Create a new Unavailable object
    
        $unavailable->setDate($post->get('unavailableDate'));
        $unavailable->setPerson($selectedPersonID);
        $unavailable->setStartTime($post->get('unavailableStartTime'));
        $unavailable->setEndTime($post->get('unavailableEndTime'));
    
        $unavailable->save();
    }
    
    private function saveWholeDay($post, $selectedPersonID)
    {
        // Get the date from the wholeDayDate field
        $wholeDayDate = $post->get('wholeDayDate');
    
        // Set the same start and end time to cover the whole day
        $startTime = '00:00';
        $endTime = '23:59';
    
        $unavailable = new Unavailable(); // Create a new Unavailable object
    
        $unavailable->setDate($wholeDayDate); // Use the wholeDayDate field
        $unavailable->setPerson($selectedPersonID);
        $unavailable->setStartTime($startTime);
        $unavailable->setEndTime($endTime);
    
        $unavailable->save();
    }
    private function saveDateRange($post, $selectedPersonID)
    {
        $startDate = $post->get('startDate');
        $endDate = $post->get('endDate');
    
        // Loop through each day in the date range and save as unavailable
        $currentDate = new DateTime($startDate);
        $endDateObj = new DateTime($endDate);
    
        while ($currentDate <= $endDateObj) {
            $unavailable = new Unavailable(); // Create a new Unavailable object
    
            $unavailable->setDate($currentDate->format('Y-m-d'));
            $unavailable->setPerson($selectedPersonID);
            $unavailable->setStartTime('00:00');
            $unavailable->setEndTime('23:59');
    
            $unavailable->save();
    
            $currentDate->modify('+1 day');
        }
    }    
} 
