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


    // public function edit($id) 
    // {
    //     $expertise = Expertise::getByID($id);
    //     $this->set('expertise', $expertise);
    // }

    public function add() 
    {
        
    }

    public function save() 
    {
        $timeSlot = new TimeSlot();
        
        $timeSlot->setDate($this->post('timeSlotsDate'));
        $timeSlot->setStartTime($this->post('timeSlotsStartTime'));
        $timeSlot->setEndTime($this->post('timeSlotsEndTime'));
        $timeSlot->setDeleted(0);
        
        $timeSlot->save();

        $this->buildRedirect('/dashboard/planning_tool/timeslot/')->send();
    }

    public function delete($id){
        $timeSlot = Expertise::getByID($id);
        $timeSlot->setDeleted(1);
        $timeSlot->save();
        $this->buildRedirect('/dashboard/planning_tool/timeslot/')->send();
    }

    // public function saveform($id){
    //     $expertise = Expertise::getByID($id);

    //     $expertise->setFirstname($this->post('expertiseName'));

    //     $expertise->save();
    //     $this->buildRedirect('/dashboard/planning_tool/expertises/')->send();
    // }
} 
