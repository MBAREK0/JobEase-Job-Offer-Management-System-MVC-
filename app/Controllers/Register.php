<?php

namespace App\Controllers;
use App\Models\DatabaseAuthantification; 


class Register {

    
 public function register(){
    require_once __DIR__ . '/../../view/register.php';
    if (isset($_POST['Register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password_1 = $_POST['password-1'];
        $password_2 = $_POST['password-2'];
        $role ='candidate';
    
        // Check if passwords match
        if ($password_1 === $password_2) {
            // Use prepared statement to prevent SQL injection
            
            $password = password_hash($password_1, PASSWORD_DEFAULT);
    
            $database = new DatabaseAuthantification();
    
            $result = $database->insertRegister($username, $email, $password, $role);
    
            if ($result === true ) {
                header("Location:index.php?route=Login");
                exit();
                } else {
                 echo "Error inserting user: " . $result;
                    }
        } else {
            echo "Error: Passwords do not match.";
        }
    }
    
    
 }


}
    