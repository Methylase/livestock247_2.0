<?php
class Create_post extends Trongate {
	/**
	 * Renders the (default) 'create post' webpage for public access.
	 *
	 * @return void
	 */
	function index(){
		if(!isset($_SESSION['trongatetoken'])){
            redirect(BASE_URL.'login');
        }
		$trongate_user_id = $_SESSION['user_id'];
        $profile_result = $this->model->get_one_where('trongate_user_id', $trongate_user_id,'profiles');
        if ($profile_result == false) {
            $_SESSION['failureMessage'] = 'kindly update your profile';
            redirect(BASE_URL.'profile');
          
        }

        $profile_lock = $this->model->get_one_where('trongate_user_id', $trongate_user_id,'profiles');
        if ($profile_result->lock_user == 'lock') {
            $_SESSION['failureMessage'] = 'You are not allowed to make a blog post';
            redirect(BASE_URL.'profile');
          
        }

        $data['profile_result'] = $profile_result;
		$data['title'] = 'Create Post';
		$data['view_module'] = 'create_post'; // Indicates the module where the view file exists.
		$data['view_file'] = 'create_post'; // Specifies the base name of the target PHP view file.
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

                $link_post_title = $this->trongate_administrators->protectData($_POST['link-post-title']);
                $post_title = $this->trongate_administrators->protectData($_POST['post-title']);
                $post_description = $this->trongate_administrators->protectData($_POST['post-description']);
                
                // File upload directory
                $uploadDir = "blog_post_upload/";
                $file_name = $this->trongate_administrators->protectData(basename($_FILES["file"]["name"]));
                $temp = explode(".", $_FILES["file"]["name"]);
                $file_name = round(microtime(true)).'.'.end($temp);
                $targetFilePath = $uploadDir . $file_name;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                
          
                $allowedTypes = array('jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov', 'wmv');
                if (!in_array($fileType, $allowedTypes)) {
                    $_SESSION["uploadFile"] = "Sorry, only JPG, JPEG, PNG, GIF, MP4, AVI, MOV, and WMV files are allowed to upload.";
                    redirect(BASE_URL.'create_post');
                } elseif ($_FILES["file"]["size"] > $maxFileSize) {
                    $_SESSION["uploadFile"] = "Error: File size exceeds maximum allowed size.";
                    redirect(BASE_URL.'create_post');
                } else {
                    if (empty($link_post_title)) {
                        $_SESSION["link-post-title"] = "Link post title is required.";
                        redirect(BASE_URL.'create_post');
                    } else {
                       if(empty($post_title)){
                            $_SESSION["post-title"] = "Post title is required.";
                            redirect(BASE_URL.'create_post');
                       }else{
                            if(empty($post_description)){
                                $_SESSION["post-description"] = "Post description is required.";
                                redirect(BASE_URL.'create_post');
                            }else{ 
                                $trongate_user_id = $_SESSION['user_id'];
                                $profile = $this->model->get_one_where('trongate_user_id', $trongate_user_id,'profiles');
                                if(!$profile){
                                    $_SESSION["failureMessage"]= "Kindly update your profile";
                                    redirect(BASE_URL.'profile');
                                }
								if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
									// upload post into database
									$trongate_user_id = $_SESSION['user_id'];
									$data['link_post_title'] = $link_post_title;
									$data['post_title'] = $post_title;
									$data['post_description'] = $post_description;//generates random unique strings 
									$data['post_image'] = $file_name; 
									$data['trongate_user_id'] = $trongate_user_id;
									$data['created_at'] = Date('Y-m-d H:i:s');
									$this->model->insert($data, 'blog_post');
									$_SESSION["successMessage"]= "Post successfully created.";
									redirect(BASE_URL.'create_post');
								} else {
									$_SESSION["uploadFile"] = "Sorry, there was an error uploading your file.";
									redirect(BASE_URL.'create_post');
								}
                            }
                       }
                    }
                }
            } else {
                $_SESSION["uploadFile"]= "Please upload post image file.";
                redirect(BASE_URL.'create_post');
            }
        
        }
    }
}
