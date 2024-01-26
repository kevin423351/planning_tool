<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Appointment;
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
    }

    public function add() 
    {
        
    }

    public function save() 
    {
        $appointment = new Appointment();
        
        $appointment->setFirstname($this->post('appointmentName'));
        $appointment->setLastname($this->post('appointmentLastname'));
        $appointment->setEmail($this->post('appointmentEmail'));
        $appointment->setDate($this->post('appointmentDate'));
        $appointment->setPhonenumber($this->post('appointmentPhone'));
        $appointment->setComment($this->post('appointmentComment'));
        $appointment->setDeleted(0);
        
        
        $appointment->save();

        $this->buildRedirect('/dashboard/planning_tool/appointments/')->send();
    }

    public function delete($id){
        $appointment = Appointment::getByID($id);
        $appointment->setDeleted(1);
        $appointment->save();
        $this->buildRedirect('/dashboard/planning_tool/appointments/')->send();
    }

    public function saveform($id){
        $appointment = Appointment::getByID($id);

        $appointment->setFirstname($this->post('appointmentName'));
        $appointment->setLastname($this->post('appointmentLastname'));
        $appointment->setEmail($this->post('appointmentEmail'));
        $appointment->setDate($this->post('appointmentDate'));
        $appointment->setPhonenumber($this->post('appointmentPhone'));
        $appointment->setComment($this->post('appointmentComment'));

        $appointment->save();
        $this->buildRedirect('/dashboard/planning_tool/appointments/')->send();
    }
} 
