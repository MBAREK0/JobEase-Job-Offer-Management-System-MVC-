<?php 
namespace App\Controllers;
use App\Models\Offers; 
    class Dashboard{
        public function dashboard(){


            
            if ( isset($_POST['addoffersubmit'])) {

   
                $_SESSION['check']='secces';
                $title = $_POST['title'];
                $description = $_POST['description'];
                $company = $_POST['company'];
                $location = $_POST['Location'];
                
    
                $folder = "img/";
               
                if (!empty($_FILES['file']['name'])) {
                    $image = basename($_FILES['file']['name']);
                    $filename = uniqid() . $image;
                    $filePath = $folder . $filename;
                    $fileType = pathinfo($image,PATHINFO_EXTENSION);
                    $formats = array('jpg','png','jpeg','gif');
                    if (in_array($fileType,$formats)) {
                    move_uploaded_file($_FILES['file']['tmp_name'],$filePath);
    
                    }
                }else {
                    $filename="articles.svg";
                }
                $database = new Offers();

                if ($database->insertJobOffer($title, $description, $company, $location,$filename)) {

                    
                } else {
                   echo $database->error;
                }
              
            } 

            if(isset($_GET['offerid'])){
                $del_id=$_GET['offerid'];
                $deletOffer= new Offers();
               if( $deletOffer->deleteOffer($del_id)){
                header("Location:index.php?route=Home");
                 exit();
               }
            }
            // // // // // // // // // // // // // // //
            if(isset($_GET['applyid'])){
                
                $user_id = $_SESSION['userid'];
                $job_id  =$_GET['applyid'];
                $app_offer = new Offers();

                if ($app_offer->applyOffer( $user_id, $job_id)) {
                    echo "apply successfully.";
                } else {
                    echo "Error applay";
                }

                $database->closeConnection();
                        
            }


        
            
            require_once __DIR__. '/../../view/dashboard.php';
        }
       
    }