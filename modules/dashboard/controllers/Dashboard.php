<?php
class Dashboard extends Trongate {

    private $dashboard_home = 'dashboard';
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
        
		$trongate_user_id = $_SESSION['user_id'];
		if($this->dashboard->authorize_user($trongate_user_id) =="blogger_admin"){ 
			$sql= "SELECT * FROM blog_post WHERE delete_post IS NULL";
			$all_post = $this->model->query($sql, 'object');
		}else{
			$sql= "SELECT * FROM blog_post WHERE delete_post IS NULL AND trongate_user_id =$trongate_user_id";
			$all_post = $this->model->query($sql, 'object');
		}
        $data['profile_result'] = $profile_result;
        $data['all_post'] = $all_post;
		$data['title'] = 'Dashboard';
		$data['view_module'] = 'dashboard'; // Indicates the module where the view file exists.
		$data['view_file'] = 'dashboard'; // Specifies the base name of the target PHP view file.
		$this->template('blogger', $data); // Loads the 'welcome' view file within the public template.



	}


    /**
     * Handles the submission of login forms, validating user input and logging users in if validation passes.
     * Redirects to the login form on validation failure or redirects to the base URL on 'Cancel' submission.
     *
     * @return void
     */
    function submit(): void {

        $submit = post('submit');


        if ($submit == 'Login') {

            $this->validation_helper->set_rules('username', 'username', 'required|callback_blogger_check');
            $this->validation_helper->set_rules('password', 'password', 'required|min_length[5]');
            $result = $this->validation_helper->run();
            $this->module('trongate_administrators');
            if ($result == true) {
                $this->_log_blogger_in(post('username'), post('password'));
            } else {
                redirect(BASE_URL.'login');
            }
        } elseif ($submit == 'Cancel') {
           redirect(BASE_URL.'login');
        }
    }


    /**
     * Logs in the user based on the provided username and handles token generation for session or cookie-based authentication.
     *
     * @param string $username The username used for login.
     * @return void
     */
    function _log_blogger_in(string $username, string $password): void {
        
        $this->module('trongate_tokens');
        $user_obj = $this->model->get_one_where('username', $username,'trongate_administrators');
        $trongate_user_id = $user_obj->trongate_user_id;
        $hashed_password = $user_obj->password;

        if($user_obj->lock_user=="lock"){
            $_SESSION["failureMessage"] = "Kindly contact the administrator for your access";
            redirect(BASE_URL.'login');
        }else if(!password_verify($password, $hashed_password)){
            redirect(BASE_URL.'login');
        }



        $token_data['user_id'] = $trongate_user_id;
        $_SESSION['user_id'] = $trongate_user_id;
        $remember = post('remember');
        if (($remember === '1') || ($remember === 1)) {
            //set a cookie and remember for 30 days
            $token_data['expiry_date'] = time() + (86400 * 30);
            $token = $this->trongate_tokens->_generate_token($token_data);
            setcookie('trongatetoken', $token, $token_data['expiry_date'], '/');
        } else {
            //user did not select 'remember me' checkbox
            $_SESSION['trongatetoken'] = $this->trongate_tokens->_generate_token($token_data);
        }

        redirect($this->dashboard_home);
    }


        /**
     * Validates the submitted username and password for login authentication.
     *
     * @param string $submitted_username The username submitted for login.
     * @return string|bool Returns an error message (string) if authentication fails, otherwise returns TRUE.
     */
    function blogger_check(string $submitted_username): string|bool {
        $submitted_password = post('password');
        $error_msg = 'You did not enter a correct username and/or or password.';

        $result = $this->model->get_one_where('username', $submitted_username, 'trongate_administrators');
        if (gettype($result) == 'object') {
            $this->module('trongate_administrators');
            $hashed_password = $result->password;
            $is_password_good = $this->trongate_administrators->_verify_hash($submitted_password, $hashed_password);
            if ($is_password_good == true) {
                return true;
            }
        }

        return $error_msg;
    }


    //get created date
    function authorize_user($user_id){

        $user_result = $this->model->get_one_where('id', $user_id,'trongate_users');
         if($user_result != false) {
            $user_level = $this->model->get_one_where('id', $user_result->user_level_id,'trongate_user_levels');
			$user_role = $user_level->level_title;
		 }else{
			$user_role = "";
           
		 }
		 return $user_role;
        
    }    

    /**
     * Handles user logout by destroying tokens and redirects based on existence of the secret login segment.
     *
     * @return void
     */
    function logout_blogger(): void {
        $this->module('trongate_tokens');
        $this->trongate_tokens->_destroy();
         redirect(BASE_URL.'login');
    }

}
