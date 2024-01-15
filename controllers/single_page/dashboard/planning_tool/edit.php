<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;

use Concrete\Core\Page\Controller\DashboardPageController;
use Database;

class Edit extends DashboardPageController
{
    public function save()
    {

        

        // $persoon = new Person();
        // $persoon->setFirstname($firstname);
        // $persoon->save();


        $db = Database::connection();
        // Get the ID from the URL
        $id = $_GET['personID'];

        // Fetch data from the database
        $sql = "SELECT * FROM persons WHERE id = $id";
        $result = $db->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['formName'];
            $lastname = $row['formLastname'];
            $email = $row['formEmail'];
            $date = $row['formDate'];
        
        } else {
            echo "Record not found";
            exit();
        }
        
        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newname = $_POST['formName'];
            $newlastname = $_POST['formLastname'];
            $newemail = $_POST['formEmail'];
            $newdate = $_POST['formDate'];
        
            // Update data in the database
            $updateSql = "UPDATE persons SET formName='".$newname."', formLastname='".$newlastname."' formEmail='".$newmail."', formDate='".$newdate."' WHERE id = ".$id;
        
            if ($db->query($updateSql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $db->error;
            }
        }
    }
} 
?>