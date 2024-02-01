<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;
use Concrete\Core\Page\Controller\DashboardPageController;

class expertises extends DashboardPageController
{

    public function view()
    {
        $expertises = Expertise::getAll();
        $this->set('expertises', $expertises);
    }


    public function edit($id) 
    {
        $expertise = Expertise::getByID($id);
        $this->set('expertise', $expertise);
    }

    public function add() 
    {
        
    }

    public function saveExpertise($id = null) 
{
    if ($id !== null) {
        $expertise = Expertise::getByID($id);
    } else {
        $expertise = new Expertise();
        $expertise->setDeleted(0); 
    }
    $expertise->setFirstname($this->post('expertiseName'));

    $expertise->save();

    $this->buildRedirect('/dashboard/planning_tool/expertises/')->send();
}


    public function delete($id){
        $expertise = Expertise::getByID($id);
        $expertise->setDeleted(1);
        $expertise->save();
        $this->buildRedirect('/dashboard/planning_tool/expertises/')->send();
    }


} 
