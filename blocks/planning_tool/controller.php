<?php
namespace Concrete\Package\PlanningTool\Block\PlanningTool;

use Concrete\Core\Validation\CSRF\Token;
use Concrete\Core\Page\Page;
use Concrete\Core\User\User;
use Concrete\Core\Block\View\BlockView;

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
    protected $choice = '';
    protected $PersonTS = 0;
    protected $weekOffset = 0;
    
    public function getBlockTypeName()
    {
        return t('planning tool');
    } 

    public function getBlockTypeDescription()
    {
        return t('Add a planning tool to your website!');
    }

    public function view() 
    {
        if ((int)$this->PersonTS != 0) {
            $currentDate = new DateTime();
            $currentDate->modify("+$this->weekOffset week");
    
            $buttons = Timeslot::getAvailableTimeSlots($this->PersonTS, null, $currentDate);
    
            $this->set('buttons', $buttons);
            $this->set('personID', $personID);
            $this->set('weekOffset', $weekOffset);
        }

        $this->set('choice', $this->choice);
        $this->set('PersonTS', $this->PersonTS);

        if ($this->choice == 'person') {
            $this->set('persons', Person::getAll());
        }
        if ($this->choice == 'expertise') {
            $this->set('expertises', Expertise::getAll());
        }
    }
    

    public function action_choice($token = false, $bID = false) 
    {
        if ($this->bID != $bID) {
            return false;
        }
        if (\Core::make('token')->validate('choice', $token)) {
            $page = Page::getCurrentPage();
            $u = new User();
            $this->choice = $_POST['choice'];
            if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
                $b = $this->getBlockObject();
                $bv = new BlockView($b);
                $bv->render('view');
            } else {
                Redirect::page($page)->send();
            }
        }
        exit;
    }
    public function action_PersonTS($token = false, $bID = false) 
    {
        if ($this->bID != $bID) {
            return false;
        }
        if (\Core::make('token')->validate('PersonTS', $token)) {
            $page = Page::getCurrentPage();
            $u = new User();
            $this->choice = $_POST['choice'];
            $this->PersonTS = $_POST['PersonTS'];
            if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
                $b = $this->getBlockObject();
                $bv = new BlockView($b);
                $bv->render('view');
            } else {
                Redirect::page($page)->send();
            }
        }
        exit;
    }
}
?>