<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Timeslot;
use Concrete\Core\File\File;
use Concrete\Core\File\Image\Thumbnail\Type\Type;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Image\Palette\RGB;
use Imagine\Gd\Imagine;
use Concrete\Core\File\Import\ImportException;
use Concrete\Core\Page\Controller\DashboardPageController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class Persons extends DashboardPageController
{   
    public function on_start()
    {      
        parent::on_start();
        
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        $daysAssoc = array_combine($daysOfWeek, $daysOfWeek);
        $this->set('daysAssoc', $daysAssoc);
        
        $expertises = Expertise::getAll();
        $this->set('expertises', $expertises);
    }

    public function view($page = 1)
    {
        $page = max(1, (int)$page);
        $itemsPerPage = 16;
    
        $paginationData = Person::getPaginated($page, $itemsPerPage);
    
        $this->set('persons', $paginationData['persons']);
        $this->set('currentPage', $paginationData['currentPage']);
        $this->set('totalPages', $paginationData['totalPages']);
    }


    public function edit($id) 
    {
        $person = Person::getByID($id);
        $this->set('person', $person); 

        $timeslots = $person->getTimeslots(); 
        $this->set('timeslots', $timeslots); 

        $profilePicture = $person->getProfilePicture(); 
        $profilePictureURL = '';
        
        if ($profilePicture) {
            $file = File::getByID($profilePicture); 
            
            if ($file) {
                $profilePictureURL = $file->getURL();
            }
        }
        $this->set('profilePictureURL', $profilePictureURL);
    }
    

    public function add() 
    {

    }

    public function save($id = null) 
    {   
        $post = $this->request->request;
        if ($id !== null) {
            $person = Person::getByID($id);
        } else {
            $person = new Person();
            $person->setDeleted(0);
        }
        $person->setFirstname($post->get('formName'));
        $person->setLastname($post->get('formLastname'));
        $person->setEmail($post->get('formEmail'));
        $person->setDate($post->get('formDate')); 
        
        $expertises = [];
        foreach ((array)$post->get('expertise') as $expertiseID) { 
            $expertises[] = Expertise::getByID($expertiseID);
        }
        $person->setExpertises($expertises);

        $file = $this->request->files->get('profilePicture');

        if ($file && $file->isValid()) {
            $filename = $file->getClientOriginalName();
            $importer = $this->app->make('\Concrete\Core\File\Import\FileImporter');
            $result = $importer->importUploadedFile($file, $filename);
            if ($result) {
                $person->setProfilePicture($result->getFileID());
            } else {
            }
        } else {
        }
        
        $person->save();

        foreach (array_keys($post->get('timeslotsDays')) as $key)
        {
            $ts = null;
            if ((int)$key > 0) {
                $ts = TimeSlot::getByID($key);
            } 

            if (!is_object($ts)) {
                $ts = new Timeslot();
                $ts->setPerson($person);
            } 

	        $timeslotsDays = $post->get('timeslotsDays');
	        if (isset($timeslotsDays[$key])) {
	            $ts->setDay($timeslotsDays[$key]);
	        }
	
	        $timeslotsStartTime = $post->get('timeslotsStartTime');
	        if (isset($timeslotsStartTime[$key])) {
	            $ts->setStartTime($timeslotsStartTime[$key]);
	        }
	
	        $timeslotsEndTime = $post->get('timeslotsEndTime');
	        if (isset($timeslotsEndTime[$key])) {
	            $ts->setEndTime($timeslotsEndTime[$key]);
	        }
	
	        $appointmentTime = $post->get('appointmentTime');
	        if (isset($appointmentTime[$key])) {
	            $ts->setAppointmentTime($appointmentTime[$key]);
        	}
    
	        $person->addTimeslots($ts);

            $ts->save();
	    }
	    $this->buildRedirect('/dashboard/planning_tool/persons/')->send();  
    }

    public function deletetimeslot()
    {       
        $post = $this->request->request;
        $timeslotId = $post->get('timeslot_id');
        $timeslot = Timeslot::getByID($timeslotId);
        $timeslot->delete();
        return new JsonResponse(['status' => 'success']);

    }

    public function delete($id){
        $person = Person::getByID($id);
        $person->setDeleted(1);
        $person->save();
        $this->buildRedirect('/dashboard/planning_tool/persons/')->send();
    }

} 