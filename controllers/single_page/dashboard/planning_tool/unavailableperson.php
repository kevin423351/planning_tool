<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Unavailable;
use Concrete\Core\Page\Controller\DashboardPageController;
use DateTime;
class Unavailableperson extends DashboardPageController
{   
    public function view()
    {
        $unavailable = Unavailable::getAll(); 
        $this->set('unavailable', $unavailable); 

        $person = Person::getAll(); 
        $this->set('persons', $person); 
    }
    
    public function save()
    {       
        $post = $this->request->request;

        $selectedPersonIDs = $post->get('personID');
        $unavailableOption = $post->get('unavailableOption');

        if (empty($selectedPersonIDs)) {
            return;
        }

        if (in_array('all', $selectedPersonIDs)) {
            $this->saveForAllPersons($post, $unavailableOption);
        } else {
            foreach ($selectedPersonIDs as $selectedPersonID) {
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
                        break;
                }
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
                    break;
            }
        }
    }

    
    private function saveSpecificDate($post, $selectedPersonID)
    {
        $unavailable = new Unavailable(); 
    
        $unavailable->setDate($post->get('unavailableDate'));
        $unavailable->setPerson($selectedPersonID);
        $unavailable->setStartTime($post->get('unavailableStartTime'));
        $unavailable->setEndTime($post->get('unavailableEndTime'));
    
        $unavailable->save();
    }
    
    private function saveWholeDay($post, $selectedPersonID)
    {
        $wholeDayDate = $post->get('wholeDayDate');

        $startTime = '00:00';
        $endTime = '23:59';
    
        $unavailable = new Unavailable();
    
        $unavailable->setDate($wholeDayDate); 
        $unavailable->setPerson($selectedPersonID);
        $unavailable->setStartTime($startTime);
        $unavailable->setEndTime($endTime);
    
        $unavailable->save();
    }
    private function saveDateRange($post, $selectedPersonID)
    {
        $startDate = $post->get('startDate');
        $endDate = $post->get('endDate');
    
        $currentDate = new DateTime($startDate);
        $endDateObj = new DateTime($endDate);
    
        while ($currentDate <= $endDateObj) {
            $unavailable = new Unavailable(); 
    
            $unavailable->setDate($currentDate->format('Y-m-d'));
            $unavailable->setPerson($selectedPersonID);
            $unavailable->setStartTime('00:00');
            $unavailable->setEndTime('23:59');
    
            $unavailable->save();
    
            $currentDate->modify('+1 day');
        }
    }    
} 
