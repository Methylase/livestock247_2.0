<?php
class Edit_post extends Trongate {

	/**
	 * Renders the (default) 'welcome' webpage for public access.
	 *
	 * @return void
	 */

	 function index(): void {
        if(!isset($_SESSION['trongatetoken'])){
            redirect(BASE_URL.'login');
        }

        $edit_id = $_GET['id'];
        if( $edit_id  == null || $edit_id  == '' || !is_numeric($edit_id )){
            redirect(BASE_URL.'dashboard');
        }  
        $trongate_user_id = $_SESSION['user_id'];
        $profile_result = $this->model->get_one_where('trongate_user_id', $trongate_user_id,'profiles');
        $edit_post = $this->model->get_one_where('id', $edit_id ,'blog_post');
        $data['edit_post'] = $edit_post;
        $data['profile_result'] = $profile_result;
		$data['title'] = 'Edit Post';
		$data['view_module'] = 'edit_post'; // Indicates the module where the view file exists.
		$data['view_file'] = 'edit_post'; // Specifies the base name of the target PHP view file.
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
                    redirect(BASE_URL.'edit_post?id='.$_POST['id']);
                } elseif ($_FILES["file"]["size"] > $maxFileSize) {
                    $_SESSION["uploadFile"] = "Error: File size exceeds maximum allowed size.";
                    redirect(BASE_URL.'edit_post?id='.$_POST['id']);
                } else {
                    if (empty($link_post_title)) {
                        $_SESSION["link-post-title"] = "Link post title is required.";
                        redirect(BASE_URL.'edit_post?id='.$_POST['id']);
                    } else {
                       if(empty($post_title)){
                            $_SESSION["post-title"] = "Post title is required.";
                            redirect(BASE_URL.'edit_post?id='.$_POST['id']);
                       }else{
                            if(empty($post_description)){
                                $_SESSION["post-description"] = "Post description is required.";
                                redirect(BASE_URL.'edit_post?id='.$_POST['id']);
                            }else{ 

                                if(isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id'])){
                                    $post_id = $this->trongate_administrators->protectData($_POST['id']);
                                    $edit_post_result = $this->model->get_one_where('id', $post_id,'blog_post');
                                    if(!$edit_post_result){
                                        redirect(BASE_URL.'dashboard');
                                    }
                                    $file = $edit_post_result->post_image;
                                    unlink('blog_post_upload/'.$file);
                                    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
									$data['link_post_title'] = $link_post_title;
									$data['post_title'] = $post_title;
									$data['post_description'] = $post_description;//generates random unique strings 
									$data['post_image'] = $file_name; 
									$data['updated_at'] = Date('Y-m-d H:i:s');
                                    $this->model->update($post_id, $data, 'blog_post');
                                    $_SESSION["successMessage"]= "Post successfully updated.";
                                    redirect(BASE_URL.'edit_post?id='.$post_id);
                                }



                            }
                       }
                    }
                }
            } else {
                $_SESSION["uploadFile"]= "Please upload post image file.";
                redirect(BASE_URL.'edit_post?id='.$_POST['id']);
            }
        
        }
    }

}
