<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;

use Concrete\Core\Page\Controller\DashboardPageController;
use Database;

class Edit extends DashboardPageController
{
    protected function save()
    {

        // $firstname = $this->post('firstname');

        // $persoon = new Person();
        // $persoon->setFirstname($firstname);
        // $persoon->save();


        $db = Database::connection();

        // Get the ID from the URL
        $id = $_GET['personsID'];
        
        // Fetch data from the database
        $sql = "SELECT * FROM persons WHERE id = $id";
        $result = $db->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $date = $row['date'];
        
        } else {
            echo "Record not found";
            exit();
        }
        
        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $newemail = $_POST['email'];
            $newdate = $_POST['date'];
        
            // Update data in the database
            $updateSql = "UPDATE persons SET firstname='".$newname."', lastname='".$newlastname."' email='".$newmail."', date='".$newdate."' WHERE id = ".$id;
        
            if ($db->query($updateSql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $db->error;
            }
        }
    }
} 
?>