<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Appointment;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;
use Concrete\Core\Page\Controller\DashboardPageController;
use Database;

class appointments extends DashboardPageController
{
    public function view()
    {
        $appointment = Appointment::getAll();
        $this->set('appointments', $appointment);
    }

    public function edit($id) 
    {
        $appointment = Appointment::getByID($id);
        $this->set('appointment', $appointment);

        $expertiseID = $appointment->getExpertise();
        
        $persons = Expertise::getPersonsByExpertiseID($expertiseID);
        $this->set('persons', $persons);
    }
    
    public function saveAppointment($id = null) 
    {
        $post = $this->request->request;

        if ($id !== null) {
            $appointment = Appointment::getByID($id);
        } else {
            $appointment = new Appointment();
            $appointment->setDeleted(0); 
        }
    
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
    
    public function delete($id){
        $appointment = Appointment::getByID($id);
        $appointment->setDeleted(1);
        $appointment->save();
        $this->buildRedirect('/dashboard/planning_tool/appointments/')->send();
    }
} 
