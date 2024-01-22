<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;
use Concrete\Core\Page\Controller\DashboardPageController;
use Database;

class expertises extends DashboardPageController
{

    protected $btTable = 'expertises';

    public function on_before_render() {}

    public function on_start() {}

    public function view()
    {
        $this->set('expertises', $this->getItems());
    }

    protected function getItems()
    {
        $db = Database::connection();
        $expertise = $db->fetchAll("SELECT * FROM {$this->btTable} WHERE deleted = 0");
        return $expertise;  
    }

    public function edit($id) 
    {
        $expertise = Expertise::getByID($id);
        $this->set('expertise', $expertise);
    }

    public function add() 
    {
        
    }

    public function save() 
    {
        $expertise = new Expertise();
        
        $expertise->setFirstname($this->post('expertiseName'));
        $expertise->setDeleted(0);
        
        $expertise->save();

        $this->buildRedirect('/dashboard/planning_tool/expertises/')->send();
    }

    public function delete($id){
        $expertise = Expertise::getByID($id);
        $expertise->setDeleted(1);
        $expertise->save();
        $this->buildRedirect('/dashboard/planning_tool/expertises/')->send();
    }

    public function saveform($id){
        $expertise = Expertise::getByID($id);

        $expertise->setFirstname($this->post('expertiseName'));

        $expertise->save();
        $this->buildRedirect('/dashboard/planning_tool/expertises/')->send();
    }
} 
