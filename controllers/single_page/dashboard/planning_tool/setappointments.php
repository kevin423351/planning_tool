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

    public function personview($personID = 1, $weekOffset = 0)
    {
        if ((int)$personID != 0) {
            $currentDate = new DateTime();
            $currentDate->modify("+$weekOffset week");

            $buttons = Timeslot::getAvailableTimeSlots($personID, null, $currentDate);

            $this->set('buttons', $buttons);
            $this->set('personID', $personID);
            $this->set('weekOffset', $weekOffset);
        }
    }
    
    public function expertiseview($expertiseID = 1, $weekOffset = 0)
    {
        $currentDate = new DateTime();
        $currentDate->modify("+$weekOffset week");

        $buttons = Timeslot::getAvailableTimeSlots(null, $expertiseID, $currentDate);

        $this->set('buttons', $buttons);
        $this->set('expertiseID', $expertiseID);
        $this->set('weekOffset', $weekOffset);
    }

    public function appointment($personID, $expertiseID, $date='', $start='', $end='')
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
        $appointment->setExpertise($post->get('expertiseID'));
        $appointment->setAppointmentDatetime($post->get('appointmentDatetime'));
        $appointment->setAppointmentStartTime($post->get('appointmentStartTime'));
        $appointment->setAppointmentEndTime($post->get('appointmentEndTime'));
        $appointment->setFirstname($post->get('appointmentName'));
        $appointment->setLastname($post->get('appointmentLastname'));
        $appointment->setEmail($post->get('appointmentEmail'));
        $appointment->setPhonenumber($post->get('appointmentPhone'));
        $appointment->setComment($post->get('appointmentComment'));

        $appointment->save();
    
        $this->buildRedirect('/dashboard/planning_tool/appointments/')->send();
    } 
} 
