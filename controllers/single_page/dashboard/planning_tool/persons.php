<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Core\Page\Controller\DashboardPageController;
use Database;

class persons extends DashboardPageController
{

    protected $btTable = 'persons';

    public function on_before_render() {}

    public function on_start() {}

    public function view()
    {
        $this->set('persons', $this->getItems());
    }

    protected function getItems()
    {
        $db = Database::connection();
        $persons = $db->fetchAll("SELECT * FROM {$this->btTable}");
        return $persons;  
    }

    public function details($personID) 
    {
        // haal hier persoon op
    }

    public function save()
    {
        // hier sla je op
    }
    public function delete($id){
        $person = Person::getByID($id);
        wtfd($person);
        $this->set('person', $person);
    }
} 
