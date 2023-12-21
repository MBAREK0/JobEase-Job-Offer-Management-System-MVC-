<?php
namespace App\Controllers;
use App\Models\Offers; 

class ControllerOffers {

    function getJobOffers(){
        
        $Offers = new Offers();
         $Offers->getJobOffer();
            
    }


   
            
     // :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::> APLLY NOW <::::::::::: 
     public function applyOffer(){
        if(isset($_GET['applyid'])){
            session_start();
            $user_id = $_SESSION['userid'];
            $job_id  =$_GET['applyid'];
            $app_offer = new DatabaseOffer();
        
            if ($app_offer->applyOffer( $user_id, $job_id)) {
                echo "apply successfully.";
            } else {
                echo "Error applay";
            }

            $database->closeConnection();
                    
        }

     }        

 // :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::> MODIFY STATUS <:::::::::::  
     public function updateStatus(){
        if(isset($_GET['upUsId']) && isset($_GET['upJbId'])){
            $user=$_GET['upUsId'];
            $job=$_GET['upJbId'];
            echo'hahaha hahaha'. $user. $job.'</br>';
            $updateStatus = new DatabaseOffer();
    
        if ($updateStatus->updateStatus($user,$job)) {
            echo "Job offer updated successfully.";
        } else {
            echo "Error updating job offer.";
        }
    
        $updateStatus->closeConnection();
        }

     }
       
 // :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::> DELETE STATUS <:::::::::::  
     public function deleteStatus(){
        if(isset($_GET['deUsId']) && isset($_GET['deJbId'])){
            $user=$_GET['deUsId'];
            $job=$_GET['deJbId'];
        
            $deleteStatus = new DatabaseOffer();

        if ($deleteStatus->deleteStatus($user,$job)) {
           header("Location:../jobease-php-oop-master/dashboard/candidat.php");
           exit();
        } else {
            echo "Error deleted job offer.";
        }
        $deleteStatus->closeConnection();
        }

     }
  

}