<?php 
namespace App\Models;
use App\Models\conection;


class Offers {


    private $db;
    public $error;

    public function __construct()
    {      
        // Get an instance of the Database class
        $this->db = conection::getInstance()->getConnection();
    }
        
    public function insertJobOffer($title, $description, $company, $location,$filename) {
            $sql = "INSERT INTO job_offers (title, description, company, location,img) VALUES ('$title', '$description', '$company', '$location','$filename')";
            
            if ($this->db->query($sql)) {
                return true;
            } else {
                $this->error="Error executing query: " . $this->db->error;
                return false;
            }
        }
        // ......................................................getAllJobOffers
        public function getAllJobOffers() {
            $sql = "SELECT * FROM job_offers";
            $result = $this->db->query($sql);
    
            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                return [];
            }
        }
        // ......................................................deleteOffer
        public function deleteOffer($id){
            $del_req  = "DELETE FROM job_offers WHERE id =$id";
            $del_result = $this->db->query($del_req);
            if ($del_result){
                return true;
            }
            else {
                return false;
            }
        }
        // ......................................................updateOffer
    
        public function updateOffer($title, $description, $company, $location,$filename,$id){
            $update_sql = "UPDATE job_offers SET title = '$title', description = '$description', company = '$company', location = '$location', img = '$filename' WHERE id = $id";
    
            $update_result = $this->db->query($update_sql);
            if ($update_result){
                return true;
            }
            else {
                return false;
            }
        }
        // ......................................................getJobOffer
        public function getJobOffer($id) {
            $upsql = "SELECT * FROM job_offers WHERE id =$id";
            $upresult = $this->db->query($upsql);
    
            if ($upresult->num_rows > 0) {
                return $upresult->fetch_assoc();
            } else {
                return [];
            }
        }
        // ......................................................searchOffer
        public function searchOffer($search){
            $S_sql = "SELECT * FROM job_offers WHERE title LIKE '%$search%' OR description LIKE '%$search%' OR company LIKE '%$search%' OR location LIKE '%$search%'";
            $S_result = $this->db->query($S_sql);
            if ($S_result->num_rows > 0) {
                return $S_result->fetch_all(MYSQLI_ASSOC);
            } else {
                return [];
            }
        }
        // ......................................................applyOffer
        public function applyOffer($user_id,$job_id){
            $check_app_sql = "SELECT * FROM `job_applications` WHERE `user_id`='$user_id' AND `job_offer_id`='$job_id'";
            $chack_req = $this->db->query($check_app_sql);
            if ($chack_req !== false) {
                if ($chack_req->num_rows == 0) {
                    $app_sql = "INSERT INTO `job_applications`(`user_id`, `job_offer_id`) VALUES ('$user_id','$job_id')";
            
                    if ($this->db->query($app_sql)) {
                        return true;
                    } else {
                        return false;
                    }
                  
                } else {
                    return 'you are alrady applyed this jop ';
                }
            } else {
                // Handle the SQL error, for example:
                return "Error executing query: " . $this->db->error;
            }
        }
        // ......................................................getUserNontification
        public function getUserNontification($user_id) {
          
            $get_nonti_req="SELECT `title`,`company` FROM `job_offers` J INNER JOIN `job_applications` A ON J.id = A.job_offer_id WHERE A.user_id =$user_id AND A.status='accept'";
            $Nonti = $this->db->query($get_nonti_req);
    
            if ($Nonti !== false) {
                if ($Nonti->num_rows > 0) {
                    return $Nonti->fetch_all(MYSQLI_ASSOC);
                } else {
                    return [];
                }
            } else {
                // Handle the SQL error, for example:
                return "Error executing query: " . $this->db->error;
            }
        }
        // ......................................................getAdminNontification
        public function getAdminNontification() {
          
            $get_non_req="SELECT username,title,status,job_offer_id,user_id FROM `job_applications`  JA INNER JOIN job_offers JO INNER JOIN users U ON JA.job_offer_id = JO.id AND JA.user_id = u.id WHERE visibility=1";
            $Non = $this->db->query($get_non_req);
    
            if ($Non !== false) {
                if ($Non->num_rows > 0) {
                    return $Non->fetch_all(MYSQLI_ASSOC);
                } else {
                    return [];
                }
            } else {
                // Handle the SQL error, for example:
                return "Error executing query: " . $this->db->error;
            }
        }
        // ......................................................updateStatus
        public function updateStatus($usid, $jbid){
            $update_app_sql = "UPDATE `job_applications` SET `status`='accept',`visibility`='0' WHERE `user_id`='$usid' AND `job_offer_id`='$jbid'";
    
            $update_app_result = $this->db->query($update_app_sql);
            if ($update_app_result){
                return true;
            }
            else {
                return false;
            }
    
        } 
        // ......................................................deleteStatus
        public function deleteStatus($usid, $jbid){
            $delete_app_sql = "DELETE FROM `job_applications` WHERE `user_id`='$usid' AND `job_offer_id`='$jbid'";
    
            $delete_app_result = $this->db->query($delete_app_sql);
            if ($delete_app_result){
                return true;
            }
            else {
                return false;
            }
    
        } 
        
    
    }// -----------------------------------------------------------------------------------------------------------------</ CLOSE CLASS >
    