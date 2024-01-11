<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\Persons;

use Concrete\Core\Page\Controller\DashboardPageController;
use Database;

class Overview extends DashboardPageController
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
} 
