<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\TimeSlot;
use Concrete\Core\Page\Controller\DashboardPageController;

class Persons extends DashboardPageController
{   
    public function on_start()
    {
        parent::on_start();
        
        $expertises = Expertise::getAll();
        $this->set('expertises', $expertises);

        $timeSlot = TimeSlot::getAll();
        $this->set('timeSlots', $timeSlot);
    }

    public function view()
    {
        $person = Person::getAll();
        $this->set('persons', $person);
    }

    public function edit($id) 
    {
        $person = Person::getByID($id);
        $this->set('person', $person);
        
        $expertises = [];
        foreach($person->getExpertises() as $expertise) { 
            $expertises[] = $expertise->getItemID(); 
        }
        $this->set('selectedExp', $expertises);
    }

    public function add() 
    {
        // do nothing
    }

    public function save($id = null) 
    {   
        $orig = null;

        if ($id !== null) {
            $person = Person::getByID($id);
        } else {
            $person = new Person();
            $person->setDeleted(0);
        }

        $person->setFirstname($this->post('formName'));
        $person->setLastname($this->post('formLastname'));
        $person->setEmail($this->post('formEmail'));
        $person->setDate($this->post('formDate'));

        $expertises = [];
        foreach ($this->post('expertise') as $expertiseID) {
            $expertises[] = Expertise::getByID($expertiseID);
        }
        $person->setExpertises($expertises);
        $person->save();

        $this->buildRedirect('/dashboard/planning_tool/persons/')->send();


        foreach (array_keys($post->get('companyAddressZipcode')) as $key)
        {
            $ca = new TimeSlot();
            $ca->setPerson($person);

            // Check if already there!
            if ($orig && $key > 0) {
                $ca = $person->getTimeslotsByID($key);
            }

            $timeslotsDays = $post->get('timeslotsDays');
            if (isset($timeslotsDays[$key])) {
                $ca->setDay($timeslotsDays[$key]);
            }

            $timeSlotsStartTime = $post->get('timeSlotsStartTime');
            if (isset($timeSlotsStartTime[$key])) {
                $ca->setStartTime($timeSlotsStartTime[$key]);
            }

            $timeSlotsEndTime = $post->get('timeSlotsEndTime');
            if (isset($timeSlotsEndTime[$key])) {
                $ca->setEndTime($timeSlotsEndTime[$key]);
            }

            $appointmentTime = $post->get('appointmentTime');
            if (isset($appointmentTime[$key])) {
                $ca->setAppointmentTime($appointmentTime[$key]);
            }

            if (!$orig || (int)$ca->getItemID() == 0) {
                $person->addTimeslots($ca);
            }
        }
    }


    public function delete($id){
        $person = Person::getByID($id);
        $person->setDeleted(1);
        $person->save();
        $this->buildRedirect('/dashboard/planning_tool/persons/')->send();
    }

} 
