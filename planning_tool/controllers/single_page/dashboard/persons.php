<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard;

use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Routing\Redirect;

class Donations extends DashboardPageController
{
    public function on_start() {
        Redirect::to('/dashboard/planning_tool/persons')->send();
    }
}