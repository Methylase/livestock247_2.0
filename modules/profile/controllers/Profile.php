<?php
class Profile extends Trongate {

	/**
	 * Renders the (default) 'welcome' webpage for public access.
	 *
	 * @return void
	 */

	 function index(): void {
        if(!isset($_SESSION['trongatetoken'])){
            redirect(BASE_URL.'login');
        }
        $trongate_user_id = $_SESSION['user_id'];
        $profile_result = $this->model->get_one_where('trongate_user_id', $trongate_user_id,'profiles');
        $data['profile_result'] = $profile_result;
		$data['title'] = 'Profile';
		$data['view_module'] = 'profile'; // Indicates the module where the view file exists.
		$data['view_file'] = 'profile'; // Specifies the base name of the target PHP view file.
		$this->template('blogger', $data); // Loads the 'welcome' view file within the public template.
	}


    
    /**
     * Handles the submission of profile forms,
     *
     * @return void
     */
    function submit(): void {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(isset($_FILES["file"]) && !empty($_FILES["file"]["name"])) {

                $maxFileSize = 10 * 1024 * 1024; 
                $this->module('trongate_administrators');

                $firstname = $this->trongate_administrators->protectData($_POST['firstname']);
                $lastname = $this->trongate_administrators->protectData($_POST['lastname']);
                $email = $this->trongate_administrators->protectData($_POST['email']);
                $phone_number = $this->trongate_administrators->protectData($_POST['lastname']);
                $designation = $this->trongate_administrators->protectData($_POST['designation']);
                // File upload directory
                $uploadDir = "uploads/";
                $file_name = $this->trongate_administrators->protectData(basename($_FILES["file"]["name"]));
                $temp = explode(".", $_FILES["file"]["name"]);
                $file_name = round(microtime(true)).'.'.end($temp);
                $targetFilePath = $uploadDir . $file_name;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                
          
                $allowedTypes = array('jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov', 'wmv');
                if (!in_array($fileType, $allowedTypes)) {
                    $_SESSION["uploadFile"] = "Sorry, only JPG, JPEG, PNG, GIF, MP4, AVI, MOV, and WMV files are allowed to upload.";
                    redirect(BASE_URL.'profile');
                } elseif ($_FILES["file"]["size"] > $maxFileSize) {
                    $_SESSION["uploadFile"] = "Error: File size exceeds maximum allowed size.";
                    redirect(BASE_URL.'profile');
                } else {
                    if (empty($firstname)) {
                        $_SESSION["recipe_name"] = "Firstname is required.";
                        redirect(BASE_URL.'profile');
                    } else {
                       if(empty($lastname)){
                            $_SESSION["lastname"] = "Lastname is required.";
                            redirect(BASE_URL.'profile');
                       }else{
                            if(empty($email)){
                                $_SESSION["email"] = "Email is required.";
                                redirect(BASE_URL.'profile');
                            }else{
                                if(empty($phone_number)){
                                    $_SESSION["phone_number"] = "Phone number is required.";
                                    redirect(BASE_URL.'profile');
                                }else{
                                    if(empty($phone_number)){
                                        $_SESSION["designation"] = "Desinated role is required.";
                                        redirect(BASE_URL.'profile');
                                    }else{
                                        $trongate_user_id = $_SESSION['user_id'];
                                        $data['firstname'] = $firstname;
                                        $data['lastname'] = $lastname;
                                        $data['email'] = $email;//generates random unique strings
                                        $data['phone_number'] = $phone_number; 
                                        $data['profile_image'] = $file_name; 
                                        $data['designated_position'] = $designation; 
    
                                        if(isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id'])){
                                            $profile_id = $this->trongate_administrators->protectData($_POST['id']);
                                            $profile_result = $this->model->get_one_where('id', $profile_id,'profiles');
                                            if(!$profile_result){
                                                redirect(BASE_URL.'dashboard');
                                            }
                                            $file = $profile_result->profile_image;
                                            unlink('uploads/'.$file);
                                            move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
                                            
                                            $this->model->update($profile_id, $data, 'profiles');
                                            $_SESSION["successMessage"]= "Profile successfully updated.";
                                            redirect(BASE_URL.'profile');
                                        }else{
                                            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                                                // upload record into database
                                                $data['trongate_user_id'] = $trongate_user_id;
                                                $this->model->insert($data, 'profiles');
                                                $_SESSION["successMessage"]= "Profile successfully updated.";
                                                redirect(BASE_URL.'profile');
                                            } else {
                                                $_SESSION["uploadFile"] = "Sorry, there was an error uploading your file.";
                                                redirect(BASE_URL.'profile');
                                            }  
                                        }                                          
                                    }
                                

                                }
                            }
                       }
                    }
                }
            } else {
                $_SESSION["uploadFile"]= "Please upload profile image.";
                redirect(BASE_URL.'profile');
            }
        
        }
    }

    //get user tag
    function get_user_tag($user_id){
        $profile_result = $this->model->get_one_where('trongate_user_id', $user_id,'profiles');
        $first_firstname = ucfirst(substr($profile_result->firstname,0,1));  
        $first_lastname = ucfirst(substr($profile_result->lastname,0,1)); 
        $user_tag = $first_firstname.$first_lastname;
        return $user_tag;
    }

     //get user fullname
     function get_user_designated_position($user_id){
        $profile_result = $this->model->get_one_where('trongate_user_id', $user_id,'profiles');
        $designation = ucwords($profile_result->designated_position);  
        return $designation ;
    }   

    //get user fullname
    function get_user_fullname($user_id){
        $profile_result = $this->model->get_one_where('trongate_user_id', $user_id,'profiles');
        $fullname = ucwords($profile_result->firstname.' '.$profile_result->lastname);  
        return $fullname;
    }

}
