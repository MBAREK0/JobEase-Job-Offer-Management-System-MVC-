<?php 
namespace App\Controllers;
use App\Models\Offers; 
    class UpdateOffers{
        public function UpdateOffers(){
           
            if ( isset($_POST['updateoffersubmit'])) {
      
                $title = $_POST['title'];
                $description = $_POST['description'];
                $company = $_POST['company'];
                $location = $_POST['Location'];
                $img=$_POST['img'];
              
           
                $folder = "img/";
                
                if (!empty($_FILES['file']['name'])) {
                    $image = basename($_FILES['file']['name']);
                    $filename = uniqid() . $image;
                    $filePath = $folder . $filename;
                    $fileType = pathinfo($image,PATHINFO_EXTENSION);
                    $formats = array('jpg','png','jpeg','gif');
                    if (in_array($fileType,$formats)) {
                        if (move_uploaded_file($_FILES['file']['tmp_name'],$filePath)) {
                            echo'ok';
                            
                          
                        }
                    }
                }else {
                    $filename=$_GET['updateimg'];
                }
            
                $updateOffer = new Offers();
               if (isset($_GET['upofferid'])){
                $update_id=$_GET['upofferid'];
              
               }
                if ($updateOffer->updateOffer($title, $description, $company, $location,$filename,$update_id)) {
                    header("Location:index.php?route=Home");
                    exit();
                } else {
                    echo "Error updating job offer.";
                }
            }
            require_once __DIR__. '/../../view/updateoffer.php';
        }
       
    }