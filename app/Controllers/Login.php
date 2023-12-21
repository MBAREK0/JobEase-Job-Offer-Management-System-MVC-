<?php 

namespace App\Controllers;
use App\Models\conection;
use App\Models\DatabaseAuthantification; 
class Login {


public function login(){
    require_once __DIR__ . '/../../view/login.php';
    if (isset($_POST['Login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $database = new DatabaseAuthantification();
    
        $result = $database->login($email, $password);
    
        if ($result == true) {
            if ($database->role == 'admin') {
                
                header("Location:index.php?route=Dashboard");
                exit();

            } elseif ($database->role == 'candidate') {
               
                header("Location:index.php?route=Home");
                exit();

            }
        } else {
            echo $result; // Output error message
        }
       
    }
    
}

}