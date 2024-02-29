<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Timeslot;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Unavailable;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Appointment;
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

        $appointment = Appointment::getAll();
        $this->set('appointment', $appointment);

        $expertise = Expertise::getAll();
        $this->set('expertises', $expertise);


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

            $this->set('buttons', $buttons);
            $this->set('personID', $personID);
            $this->set('timeslots', $timeslots); 
        }
    }

    public function generateTimeSlotButtons($personID, $timeslots)
    {
        $buttons = [];
    
        foreach ($timeslots as $timeslot) {
            $startTime = new DateTime($timeslot->getStartTime());
            $endTime = new DateTime($timeslot->getEndTime());
            $appointmentTime = $timeslot->getAppointmentTime();
            $interval = 'PT' . $appointmentTime . 'M';
            $date = date('Y-m-d', strtotime((string)$timeslot->getday().' this week'));
            
            // if unavaileble it returns a empty day
            if (!isset($buttons[$date])) {
                $buttons[$date] = array();
            }
            // Loop through the blocks of 30 minutes
            while ($startTime < $endTime) {
                $blockEndTime = clone $startTime;
                $blockEndTime->add(new DateInterval($interval));
    
                $isUnavailable = Unavailable::unavailableExist($personID, $date, $startTime->format('H:i'));
                $isChosen = Appointment::appointmentExist($personID, $date, $startTime->format('H:i'));

                if (!$isUnavailable && !$isChosen) {
                    // Voeg tijdslot toe aan beschikbare tijdslots
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

    public function appointment($personID, $date, $start, $end)
    {
        $start = str_replace('-', ':', $start);
        $end = str_replace('-', ':', $end);
        $this->set('expertiseID', $expertiseID);
        $this->set('personID', $personID);
        $this->set('date', $date);
        $this->set('start', $start); 
        $this->set('end', $end); 
    }

    public function saveAppointment() 
    {
        $post = $this->request->request;

        $appointment = new Appointment();
        $appointment->setDeleted(0); 
    
        $appointment->setPerson($post->get('personID'));
        $appointment->setAppointmentDatetime($post->get('appointmentDatetime'));
        $appointment->setAppointmentStartTime($post->get('appointmentStartTime'));
        $appointment->setAppointmentEndTime($post->get('appointmentEndTime'));
        $appointment->setFirstname($post->get('appointmentName'));
        $appointment->setLastname($post->get('appointmentLastname'));
        $appointment->setEmail($post->get('appointmentEmail'));
        $appointment->setDate($post->get('appointmentDate'));
        $appointment->setPhonenumber($post->get('appointmentPhone'));
        $appointment->setComment($post->get('appointmentComment'));

        $appointment->save();
    
        $this->buildRedirect('/dashboard/planning_tool/appointments/')->send();
    }
    
    public function expertiseview($expertiseID = 1)
    {

        $buttons = $this->getAvailableTimeSlotss($expertiseID);
    
        $this->set('buttons', $buttons);

    }

    public function getAvailableTimeSlotss($expertiseID)
    {

    $persons = Expertise::getPersonsByExpertiseID($expertiseID);

    $buttons = [];

    // Loop door alle personen met de expertise
    foreach ($persons as $person) {
        $personID = $person->getItemID();
        $timeslots = $person->getTimeslots();

        // Loop door alle tijdsloten van de persoon
        foreach ($timeslots as $timeslot) {
            $startTime = new DateTime($timeslot->getStartTime());
            $endTime = new DateTime($timeslot->getEndTime());
            $appointmentTime = $timeslot->getAppointmentTime();
            $date = date('Y-m-d', strtotime((string)$timeslot->getday().' this week'));

            // if unavailable it returns an empty day
            if (!isset($buttons[$date])) {
                $buttons[$date] = array();
            }

            // Loop through the blocks of 30 minutes
            while ($startTime < $endTime) {
                $blockEndTime = clone $startTime;
                $blockEndTime->add(new DateInterval('PT' . $appointmentTime . 'M'));

                $isUnavailable = Unavailable::unavailableExist($personID, $date, $startTime->format('H:i'));
                $isChosen = Appointment::appointmentExist($personID, $date, $startTime->format('H:i'));

                if (!$isUnavailable && !$isChosen) {
                    // Voeg tijdslot toe aan beschikbare tijdslots
                    $buttons[$date][] = [
                        'startTime' => $startTime->format('H:i'),
                        'endTime' => $blockEndTime->format('H:i'),
                        'personID' => $personID,
                    ];
                }
                $startTime = $blockEndTime;
            }
        }
    }

    return $buttons;
}
} 
