<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;

use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Core\Page\Controller\DashboardPageController;
use Database;

class Edit extends DashboardPageController
{
    
    public function view($id)
    {
        $person = Person::getByID($id);
        // wtfd($person);


        $this->set('person', $person);

        // $person->setFirstname('TEST SET NAME');
        // $person->setLastname('TEST SET LASTNAME');
        // $person->setEmail('TEST SET EMAIL');
        // $person->setDate('TEST SET DATE');
        // $person->save();
    }


    public function save($id) 
    {
        $person = new Person();
        // wtf($person, $this->post());
        $person->setItemID($id);
        $person->setFirstname($this->post('formName'));
        $person->setLastname($this->post('formLastname'));
        $person->setEmail($this->post('formEmail'));
        $person->setDate($this->post('formDate'));

        // wtfd($person, $this->post());
        
        $person->save();

        $this->buildRedirect('/dashboard/planning_tool/persons/')->send();
    }
    //     // $persoon = new Person();
    //     // $persoon->setFirstname($firstname);
    //     // $persoon->save();


    //     $db = Database::connection();
    //     // Get the ID from the URL
        
    //     $id = $_GET['personID'];

    //     // Fetch data from the database
    //     $sql = "SELECT * FROM persons WHERE id = $id";
    //     $result = $db->query($sql);
        
    //     if ($result->num_rows > 0) {
    //         $row = $result->fetch_assoc();
    //         $name = $row['formName'];
    //         $lastname = $row['formLastname'];
    //         $email = $row['formEmail'];
    //         $date = $row['formDate'];
        
    //     } else {
    //         echo "Record not found";
    //         exit();
    //     }
        
    //     // Handle form submission
    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //         $newname = $_POST['formName'];
    //         $newlastname = $_POST['formLastname'];
    //         $newemail = $_POST['formEmail'];
    //         $newdate = $_POST['formDate'];
        
    //         // Update data in the database
    //         $updateSql = "UPDATE persons SET formName='".$newname."', formLastname='".$newlastname."' formEmail='".$newmail."', formDate='".$newdate."' WHERE id = ".$id;
        
    //         if ($db->query($updateSql) === TRUE) {
    //             echo "Record updated successfully";
    //         } else {
    //             echo "Error updating record: " . $db->error;
    //         }
    //     }
    // }
} 
?>