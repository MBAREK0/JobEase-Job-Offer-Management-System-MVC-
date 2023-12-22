<?php 
namespace App\Controllers;
use App\Models\Offers; 

class Condidat{

   public function condidat(){

    if(isset($_GET['upUsId']) && isset($_GET['upJbId'])){
        $user=$_GET['upUsId'];
        $job=$_GET['upJbId'];

        ?><script>alert('hahaha hahaha' +$user +'_'+ $job )</script><?php
        $updateStatus = new Offers();

    if ($updateStatus->updateStatus($user,$job)) {
        echo "Job offer updated successfully.";
    } else {
        echo "Error updating job offer.";
    }

   
    }


    require_once __DIR__. '/../../view/candidat.php';
   }     


}