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
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
use Concrete\Core\Routing\Redirect;
use DateTime;
use DateInterval;

class Controller extends BlockController {

    protected $choice = '';
    protected $personTS = 0;
    protected $expertiseTS = 0;
    protected $weekOffset = 0;
    protected $personID;
    protected $expertiseID;
    protected $date;
    protected $startTime;
    protected $endTime;
    
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
        if ($this->choice == 'null') {
            $this->choice = '';
        }
        if ($this->choice == 'person') {
            $this->set('persons', Person::getAll());
        }
        if ($this->choice == 'expertise') {
            $this->set('expertises', Expertise::getAll());
        }

        if ((int)$this->personTS != 0) {
            $currentDate = new DateTime();
            $currentDate->modify("+".$this->weekOffset." week");
    
            $this->set('buttons', Timeslot::getAvailableTimeSlots($this->personTS, null, $currentDate));
        }
        if ((int)$this->expertiseTS != 0) {
            $currentDate = new DateTime();
            $currentDate->modify("+".$this->weekOffset." week");
    
            $this->set('buttons', Timeslot::getAvailableTimeSlots(null, $this->expertiseTS, $currentDate));
        }   

        $this->set('personID', $personID);
        $this->set('expertiseID', $this->expertiseID); 
        $this->set('weekOffset', $this->weekOffset);
        
        $this->set('choice', $this->choice);
        $this->set('personTS', $this->personTS);
        $this->set('personID', $this->personID);
        $this->set('expertiseTS', $this->expertiseTS);
  
        $this->set('date', $this->date);
        $this->set('startTime', $this->startTime); 
        $this->set('endTime', $this->endTime);
    }
    
    public function action_saveAppointment($token = false, $bID = false) 
    {
        if ($this->bID != $bID) {
            return false;
        }
        if (\Core::make('token')->validate('saveAppointment', $token)) {
            $page = Page::getCurrentPage();
            $u = new User();

            $post = $this->request->request;

            $choice = $post->get('choice');
        
            $appointment = new Appointment();
            $appointment->setDeleted(0); 
        
            $appointment->setPerson($post->get('personID'));
            $appointment->setExpertise($post->get('expertiseID'));
            $appointment->setAppointmentDatetime($post->get('appointmentDatetime'));
            $appointment->setAppointmentStartTime($post->get('appointmentStartTime'));
            $appointment->setAppointmentEndTime($post->get('appointmentEndTime'));
            $appointment->setFirstname($post->get('appointmentName'));
            $appointment->setLastname($post->get('appointmentLastname'));
            $appointment->setEmail($post->get('appointmentEmail'));
            $appointment->setPhonenumber($post->get('appointmentPhone'));    
            $appointment->setComment($post->get('appointmentComment'));

            $appointment->save();
            
            
            $mailService  = \Core::make('mail');
            $mailService ->from('no-reply@planning-tool.com');
            $mailService ->replyto('no-reply@planning-tool.com');
            $mailService ->to('kevin@dewebmakers.nl');
            
            $mailContent = '<p>test mail<br>';

            $mailService ->addParameter('mailContent', $mailContent);

            $mailService ->load('appointment_mail', 'planning_tool');
         
            $mailService ->sendMail();
            

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

    public function action_weeks($token = false, $bID = false) 
    {
        if ($this->bID != $bID) {
            return false;
        }
        if (\Core::make('token')->validate('weeks', $token)) {
            $page = Page::getCurrentPage();
            $u = new User();

            $this->choice = $_POST['choice'];

            if ($this->choice == 'person') {
                $this->personTS = $_POST['personTS'];
                $this->weekOffset = $_POST['weekOffset'];
                $this->expertiseTS = null;
            } elseif ($this->choice == 'expertise') {
                $this->personTS = null;
                $this->expertiseTS = $_POST['expertiseTS'];
                $this->weekOffset = $_POST['weekOffset'];
            }

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


    public function action_personTS($token = false, $bID = false) 
    {
        if ($this->bID != $bID) {
            return false;
        }
        if (\Core::make('token')->validate('personTS', $token)) {
            $page = Page::getCurrentPage();
            $u = new User();
            $this->choice = $_POST['choice'];
            
            if ($this->choice == 'person') {
                $this->personTS = $_POST['personTS'];
                $this->expertiseTS = null;
            } elseif ($this->choice == 'expertise') {
                $this->personTS = null; 
                $this->expertiseTS = $_POST['expertiseTS'];
            }
            
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
    
    public function action_appointment($token = false, $bID = false) 
    {
        if ($this->bID != $bID) {
            return false;
        }
        if (\Core::make('token')->validate('appointment', $token)) {
            $page = Page::getCurrentPage();
            $u = new User();
            
            $this->personTS = $_POST['personTS'];
            $this->expertiseTS = $_POST['expertiseTS'];
            $this->choice = $_POST['choice'];
            $this->personID = $_POST['personID'];
            $this->expertiseID = $_POST['expertiseID'];
            $this->date = $_POST['date'];
            $this->startTime = $_POST['startTime'];
            $this->endTime = $_POST['endTime'];

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
    public function action_appointmentt($token = false, $bID = false) 
    {
        if ($this->bID != $bID) {
            return false;
        }
        if (\Core::make('token')->validate('appointmentt', $token)) {
            $page = Page::getCurrentPage();
            $u = new User();
            
            $this->personTS = $_POST['personTS'];
            $this->expertiseTS = $_POST['expertiseTS'];
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
}
?>