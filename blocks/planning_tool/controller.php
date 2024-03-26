<?php
namespace Concrete\Package\PlanningTool\Block\PlanningTool;

use Concrete\Core\Block\Block;
use Concrete\Core\Block\BlockController;

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
    public function firstStep()
    {

    }
    public function secondStep()
    {

    }

}
?>