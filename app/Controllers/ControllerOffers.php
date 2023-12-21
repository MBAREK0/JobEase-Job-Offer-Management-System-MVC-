<?php
namespace App\Controllers;
use App\Models\Offers; 

class ControllerOffers {

    function index(){
        $Offers = new Offers();
    
         $Offers->getAllJobOffers();
            

    }
       // :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::> CREATE A JOB OFFER <:::::::::::
    public function createOffer(){

        if ( isset($_POST['addoffersubmit'])) {
            session_start();
            $_SESSION['check']='secces';
            $title = $_POST['title'];
            $description = $_POST['description'];
            $company = $_POST['company'];
            $location = $_POST['Location'];
        
        
            $folder = "uploads/";
            
            if (!empty($_FILES['file']['name'])) {
                $image = basename($_FILES['file']['name']);
                $filename = uniqid() . $image;
                $filePath = $folder . $filename;
                $fileType = pathinfo($image,PATHINFO_EXTENSION);
                $formats = array('jpg','png','jpeg','gif');
                if (in_array($fileType,$formats)) {
                   move_uploaded_file($_FILES['file']['tmp_name'],$filePath);
        
                }
            }
        
            $database = new DatabaseOffer();
        
            if ($database->insertJobOffer($title, $description, $company, $location,$filename)) {
                header("Location:../jobease-php-oop-master/dashboard/dashboard.php");
                exit();
            } else {
                return "Error executing query: " . $database->connection->error;
            }
        
            $database->closeConnection();
        }
    }



     // :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::> DELETE A JOB OFFER <:::::::::::
     public function  deleteOffer(){

        if(isset($_GET['offerid'])){
            $del_id=$_GET['offerid'];
            $deletOffer= new DatabaseOffer();
           if( $deletOffer->deleteOffer($del_id)){

           }
      
        }
    
     }


     // :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::> UPDATE A JOB OFFER <:::::::::::
     public function updateOffer(){
        if ( isset($_POST['updateoffersubmit'])) {
      
            $title = $_POST['title'];
            $description = $_POST['description'];
            $company = $_POST['company'];
            $location = $_POST['Location'];
        
            $rep = "";
            $folder = "uploads/";
            
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
            }
        
            $updateOffer = new DatabaseOffer();
           if (isset($_GET['updateid'])){
            $update_id=$_GET['updateid'];
    
           }
            if ($updateOffer->updateOffer($title, $description, $company, $location,$filename,$update_id)) {
                header("Location:../index.php");
                exit();
            } else {
                echo "Error updating job offer.";
            }
        
            $updateOffer->closeConnection();
        }
     }

  
    
    // :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::> SEARCH <:::::::::::
    public function search(){
        $S_Offer = new DatabaseOffer;

        if(isset($_GET["term"])) {
            $search = $_GET["term"];
            $jobOffers = $S_Offer->searchOffer($search);
            session_start();
            
               
        ?>
                   <?php foreach ($jobOffers as $offer): ?>
                    <article class="postcard light green">
                        <a class="postcard__img_link" href="#">
                            <img class="postcard__img" src="controls/uploads/<?php echo $offer['img']; ?>" alt="Image Title" />
                        </a>
                        <div class="postcard__text t-dark">
                            <h3 class="postcard__title green"><a href="#"><?php echo $offer['title']; ?></a></h3>
                            <div class="postcard__subtitle small">
                                <time datetime="2020-05-25 12:00:00">
                                    <i class="fas fa-calendar-alt mr-2"></i><?php echo $offer['created_at']; ?>
                                </time>
                            </div>
                            <div class="postcard__bar"></div>
                            <div class="postcard__preview-txt"><?php echo $offer['description']; ?></div>
                            <ul class="postcard__tagbox">
                                <li class="tag__item"><i class="fas fa-tag mr-2"></i><?php echo $offer['company']; ?></li>
                                <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li>
                                <?php 
                                 
                                if($_SESSION['role'] === 'candidate'){
                                echo '  <li class="tag__item play green">';
                                echo '<a onclick="apply('.$offer['id'].')" ><i class="fas fa-play mr-2"></i>APPLY NOW</a>';
                                echo '  </li>';
                                }
                                ?>
                                <?php 
                              
                                if($_SESSION['role'] === 'admin'){
                                    echo'<a href="controls/updateoffer.php?upofferid='.$offer['id'] .' " ><li class="tag__item"><i class="fas fa-clock mr-2"></i>update</li></a>';
                                    echo'<a href="controls/userinfo.php?offerid='.$offer['id'] .' " ><li class="tag__item"><i class="fas fa-clock mr-2"></i>delete.</li></a>';
                                
        
                                
                                }
                                ?>
                            </ul>
                        </div>
                    </article>
                    <?php endforeach;
                   
                }
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