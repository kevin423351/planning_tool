<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Appointment;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Expertise;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Core\Page\Controller\DashboardPageController;
use Doctrine\ORM\EntityManagerInterface;
use Database;
use DateTime;

class appointments extends DashboardPageController
{
    protected $expertiseID;

    public function view($year='', $month='')
    {
        if ($year == '') { $year = date('Y'); }
        if ($month == '') { $month = date('m'); }
        
        $return = array();

        // Get the number of days in the selected month
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        // Get the first day of the month
        $firstDayOfMonth = date("N", mktime(0, 0, 0, $month, 1, $year));
        // Calculate the number of weeks needed to display all days
        $weeks = ceil(($daysInMonth + $firstDayOfMonth - 1) / 7);
        // Initialize the day counter
        $dayCount = 1;
        // Loop through the weeks
        $this->set('month', $month);
        $row = 0;
        for ($week = 0; $week < $weeks; $week++) {
            for ($dayOfWeek = 1; $dayOfWeek <= 7; $dayOfWeek++) {
                $dayNumber = $dayCount - $firstDayOfMonth + 1;
              
                if ($dayNumber < 1 || $dayNumber > $daysInMonth) {
                    $return[$row][$dayOfWeek] = array(
                        'empty' => true,
                    );
                } else {
                    $dateString = date('Y-m-d', mktime(0, 0, 0, $month, $dayNumber, $year));
                    
                    $return[$row][$dayOfWeek] = array(
                        'empty' => false,
                        'date' => $dateString,
                        'daynumber' => $dayNumber,
                        'count' => Appointment::countAppointmentsByDate($dateString),
                    );
                }
                $dayCount++;
            }
            $row++;
        } 
        $this->set('calendar', $return);
    }
    
    public function agendaAppointments($dateString='')
    {    
        $date = new DateTime($dateString);
        
        $formattedDate = $date->format('Y-m-d');

        $appointments = Appointment::getAllByDate($formattedDate);

        $this->set('date', $formattedDate);
        $this->set('appointments', $appointments);
    }

    public function downloadICS()
    {
        $icsContent = Appointment::generateICS();

        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="appointments.ics"');
        echo $icsContent;
    }
    
    function csvDate() {
     
    }

    function getdataformfield()
    {
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
    
        $this->csvDateToDate($startDate, $endDate);
    }

    function csvDateToDate($startDate, $endDate) {
        $appointments = Appointment::getAllBetweenDates($startDate, $endDate);
    
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="appointments_' . $startDate . '_to_' . $endDate . '.csv"');
    
        $output = fopen('php://output', 'w');
    
        fputcsv($output, array('Naam', 'Datum', 'Starttijd', 'Eindtijd', 'Expertise', 'Voornaam', 'Achternaam', 'E-mail', 'Telefoonnummer', 'Opmerking'));
    
        foreach ($appointments as $appointment) {
            fputcsv($output, array(
                $appointment->getPersonObject() ? $appointment->getPersonObject()->getFirstname() : 'N/A',
                $appointment->getAppointmentDatetime(),
                $appointment->getAppointmentStartTime(),
                $appointment->getAppointmentEndTime(),
                $appointment->getExpertiseObject() ? $appointment->getExpertiseObject()->getFirstname() : 'N/A',
                $appointment->getFirstname(),
                $appointment->getLastname(),
                $appointment->getEmail(),
                $appointment->getPhonenumber(),
                $appointment->getComment()
            ));
        }
    
        fclose($output);
        exit;
    }
    
    function csv($date) {
        $appointments = Appointment::getAllByDate($date);
    
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="appointments_' . $date . '.csv"');
    
        $output = fopen('php://output', 'w');

        fputcsv($output, array('Naam', 'Datum', 'Starttijd', 'Eindtijd', 'Expertise', 'Voornaam', 'Achternaam', 'E-mail', 'Telefoonnummer', 'Opmerking'));

        foreach ($appointments as $appointment) {
            fputcsv($output, array(
                $appointment->getPersonObject() ? $appointment->getPersonObject()->getFirstname() : 'N/A',
                $appointment->getAppointmentDatetime(),
                $appointment->getAppointmentStartTime(),
                $appointment->getAppointmentEndTime(),
                $appointment->getExpertiseObject() ? $appointment->getExpertiseObject()->getFirstname() : 'N/A',
                $appointment->getFirstname(),
                $appointment->getLastname(),
                $appointment->getEmail(),
                $appointment->getPhonenumber(),
                $appointment->getComment()
            ));
        }

        fclose($output);
        exit;
    }
    
    public function edit($id) 
    {
        $appointment = Appointment::getByID($id);
        $this->set('appointment', $appointment);
    
        $expertiseID = $appointment->getExpertise();
        $expertises = Expertise::getAll();
    
        if ($expertiseID == 0) {
            $getPersons = Person::getAll(); 
        } else {
            $getPersons = Expertise::getPersonsByExpertiseID($expertiseID);
        }
    
        $this->set('expertises', $expertises);
        $this->set('persons', $getPersons);
    }

    public function changepersons() 
    {
        $expertiseID = isset($_POST['expertiseID']) ? $_POST['expertiseID'] : null;
        
        if ($expertiseID == 0) {
            $persons = Person::getAll();
        } else { 
            $persons = Expertise::getPersonsByExpertiseID($expertiseID);
        }

        $personOptions = [];
        foreach ($persons as $person) {
            $personOptions[$person->getItemID()] = $person->getFirstname(); 
        }
        
        echo json_encode($personOptions);
        exit;
    }
    
    public function saveAppointment($id = null) 
    {
        $post = $this->request->request;

        if ($id !== null) {
            $appointment = Appointment::getByID($id);
        } else {
            $appointment = new Appointment();
            $appointment->setDeleted(0); 
        }
    
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
    
        $this->buildRedirect('/dashboard/planning_tool/appointments/')->send();
    }
    
    public function delete($id){
        $appointment = Appointment::getByID($id);
        $appointment->setDeleted(1);
        $appointment->save();
        $this->buildRedirect('/dashboard/planning_tool/appointments/')->send();
    }
} 
