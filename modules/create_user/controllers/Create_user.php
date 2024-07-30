<?php
class Create_user extends Trongate {

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
		$data['title'] = 'Create User';
		$data['view_module'] = 'create_user'; // Indicates the module where the view file exists.
		$data['view_file'] = 'create_user'; // Specifies the base name of the target PHP view file.
		$this->template('blogger', $data); // Loads the 'welcome' view file within the public template.
	}


    
    /**
     * Handles the submission of creating user forms,
     *
     * @return void
     */
    function submit(): void {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->module('trongate_administrators');

                $username = $this->trongate_administrators->protectData($_POST['username']);
                $password = $this->trongate_administrators->protectData($_POST['password']);
                $role_name = $this->trongate_administrators->protectData($_POST['role_name']);

                    if (empty($username)) {
                        $_SESSION["username"] = "Username is required.";
                        redirect(BASE_URL.'create_user');
                    } else {

                        if(empty($password)){
                            $_SESSION["password"] = "Password is required.";
                            redirect(BASE_URL.'create_user');
                        }else{ 
                            if(empty($role_name)){
                                $_SESSION["role_name"] = "Role name is required.";
                                redirect(BASE_URL.'create_user');
                            }else{ 

                                $password = $this->trongate_administrators->_hash_string($password);
                                $record_obj =$this->model->get_one_where('username', $username,'trongate_administrators');
                        
                                if ($record_obj == false) {
                                    $this->module('trongate_users');
                                    $data['username'] = $username;
                                    $data['password'] = $password;
                                    $data['trongate_user_id'] = $this->trongate_users->_create_user(3);
                                    $this->model->insert($data,'trongate_administrators');
                                    $_SESSION["successMessage"] = "User successfully created.";
                                    redirect(BASE_URL.'create_user');
                                }else{
                                    $_SESSION["failureMessage"] = "Oops something went wrong.";
                                    redirect(BASE_URL.'create_user');                                    
                                }    

                            }

                        }
                    }
                
        
        }
    }

}
