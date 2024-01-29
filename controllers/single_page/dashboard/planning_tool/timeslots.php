<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\TimeSlot;
use Concrete\Core\Page\Controller\DashboardPageController;

class timeslots extends DashboardPageController
{

    public function view()
    {
        $timeSlot = TimeSlot::getAll();
        $this->set('timeSlots', $timeSlot);
        
    }

    public function edit($id) 
    {
        $timeSlot = TimeSlot::getByID($id);
        $this->set('timeSlot', $timeSlot);
    }

    public function add() 
    {
        
    }

    public function save() 
    {
        $timeSlot = new TimeSlot();
        
        $timeSlot->setDay($this->post('timeslotsDays'));
        $timeSlot->setStartTime($this->post('timeSlotsStartTime'));
        $timeSlot->setEndTime($this->post('timeSlotsEndTime'));
        $timeSlot->setDeleted(0);
        
        $timeSlot->save();

        $this->buildRedirect('/dashboard/planning_tool/timeslots/')->send();
    }

    public function delete($id){
        $timeSlot = TimeSlot::getByID($id);
        $timeSlot->setDeleted(1);
        $timeSlot->save();
        $this->buildRedirect('/dashboard/planning_tool/timeslots/')->send();
    }

    public function saveform($id){
        $timeSlot = TimeSlot::getByID($id);

        $timeSlot->setDay($this->post('timeslotsDays'));
        $timeSlot->setStartTime($this->post('timeSlotsStartTime'));
        $timeSlot->setEndTime($this->post('timeSlotsEndTime'));
        $timeSlot->save();
        $this->buildRedirect('/dashboard/planning_tool/timeslots/')->send();
    }
} 
