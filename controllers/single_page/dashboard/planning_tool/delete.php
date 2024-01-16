<?php
namespace Concrete\Package\PlanningTool\Controller\SinglePage\Dashboard\PlanningTool;
use Concrete\Package\PlanningTool\Src\PlanningTool\Persons\Person;
use Concrete\Core\Page\Controller\DashboardPageController;
use Database;

class Delete extends DashboardPageController
{
    // public function view($id)
    // {
    //     var_dump($id);

    // }


    public function delete()
    {
   // Check if item ID is provided
        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
            $db = Database::connection();
            // Prepare a delete statement
            $sql = "DELETE FROM persons WHERE id = ?";

            if($stmt = $db->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("i", $param_id);

                // Set parameters
                $param_id = trim($_GET["id"]);

                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    echo "Item deleted successfully!";
                } else{
                    echo "Error: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            }

            // Close the database connection
            $db->close();
        } else {
            echo "Invalid request. Please provide an item ID.";
        }
    }
} 
?>

