<?php

namespace App\Controllers;
use App\Models\Offers; 


class Logout{

    public function logout(){
         
         $_SESSION = array();
        session_destroy();
        header("Location:index.php?route=Login");
    }

}

?>