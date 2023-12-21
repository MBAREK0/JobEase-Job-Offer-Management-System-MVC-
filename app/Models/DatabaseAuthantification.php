<?php




namespace App\Models;
echo 'from register model </br>';
use App\Models\conection;
class DatabaseAuthantification  {
    
    public $role;
    private $db;

    public function __construct()
    {      
        // Get an instance of the Database class
        $this->db = conection::getInstance()->getConnection();
    }

    public function insertRegister($username, $email, $password, $role) {
        $sql = "INSERT INTO users (username, useremail, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
    
        // Check if prepared statement creation was successful
        if ($stmt == false) {
            return "Error preparing statement: " . $this->db->error;
        }
    
        $stmt->bind_param("ssss", $username, $email, $password, $role);
    
        // Check if bind_param was successful
        if ($stmt->execute()) {
            return true;
        } else {
            return "Error executing statement: " . $stmt->error;
        }
    }
  

    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE useremail = ?";
        $stmt = $this->db->prepare($sql);
    
        // Check if prepared statement creation was successful
        if ($stmt === false) {
            return "Error preparing statement: " . $this->db->error;
        }
    
        $stmt->bind_param("s", $email);
    
        // Check if bind_param was successful
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
    
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                session_start();
                $this->role =$row['role'];
            
                $_SESSION['email'] = $row['useremail'] ;
                $_SESSION['userid'] = $row['id'] ;
                $_SESSION['role'] = $this->role ;
               

                // Verify the password
                if (password_verify($password, $row['password'])) {
                    return true; // Successful login
                } else {
                    return "Invalid password.";
                }
            } else {
                return "User not foundx.";
            }
        } else {
            return "Error executing statement: " . $stmt->error;
        }
    }
    


}
?>