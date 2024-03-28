<?php
namespace Concrete\Package\PlanningTool\Block\PlanningTool;

use Concrete\Core\Block\Block;
use Concrete\Core\Block\BlockController;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Timeslot;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Unavailable;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Appointment;
use Concrete\Core\Page\Controller\DashboardPageController;
use DateTime;
use DateInterval;

class Controller extends BlockController {

    // protected $btInterfaceWidth = 1050;
	// protected $btInterfaceHeight = 550;
	// protected $btTable = 'planning_tool';

    public function getBlockTypeName()
    {
        return t('planning tool');
    }

    public function getBlockTypeDescription()
    {
        return t('Add a planning tool to your website!');
    }

    public function view() {
    }

    public function action_xhr()
    {
        echo json_encode(['message' => 'Success']); 
        exit; 
    }

  
}
?>