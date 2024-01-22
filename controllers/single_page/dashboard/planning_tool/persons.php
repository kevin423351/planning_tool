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
        $persons = $db->fetchAll("SELECT * FROM {$this->btTable} WHERE deleted = 0");
        return $persons;  
    }

    public function edit($id) 
    {
        $person = Person::getByID($id);
        $this->set('person', $person);
    }

    public function add() 
    {
        
    }

    public function save() 
    {
        $person = new Person();
        
        $person->setFirstname($this->post('formName'));
        $person->setLastname($this->post('formLastname'));
        $person->setEmail($this->post('formEmail'));
        $person->setDate($this->post('formDate'));
        $person->setDeleted(0);
        
        
        $person->save();

        $this->buildRedirect('/dashboard/planning_tool/persons/')->send();
    }

    public function delete($id){
        $person = Person::getByID($id);
        $person->setDeleted(1);
        $person->save();
        $this->buildRedirect('/dashboard/planning_tool/persons/')->send();
    }

    public function saveform($id){
        $person = Person::getByID($id);

        $person->setFirstname($this->post('formName'));
        $person->setLastname($this->post('formLastname'));
        $person->setEmail($this->post('formEmail'));
        $person->setDate($this->post('formDate'));

        $person->save();
        $this->buildRedirect('/dashboard/planning_tool/persons/')->send();
    }
} 
