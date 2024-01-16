<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;

use Concrete\Core\Page\Controller\DashboardPageController;
use Database;

class Add extends DashboardPageController
{
    public function add()
    {
        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Perform necessary validation and sanitization here

            // Retrieve data from the form
            $id = $_POST['personID'];
            $name = $_POST['formName'];
            $lastname = $_POST['formLastname'];
            $email = $_POST['formEmail'];
            $date = $_POST['formDate'];

            $db = Database::connection();

            // Insert data into the database
            $sql = "INSERT INTO persons VALUES ('$id', '$name', '$lastname', '$email', '$date')";
            
            if ($db->query($sql) === TRUE) {
                echo "Item added successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $db->error;
            }

            // Close the database connection
            $db->close();
        }

    }
} 
?>
