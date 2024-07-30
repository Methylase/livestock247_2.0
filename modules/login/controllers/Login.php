<?php
class Login extends Trongate {
    private $blog_user = 'blogger_admin';
    private $password = 'Passme@+++'; //where to go after login
    /**
     * Initializes the Trongate_user_levels class.
     */
    function __construct() {
		$this->module('trongate_administrators');
		$blogger = 	$this->blog_user;
        $password = $this->trongate_administrators->_hash_string($this->password);
        $record_obj =$this->model->get_one_where('username', $blogger,'trongate_administrators');

        if ($record_obj == false) {
			$this->module('trongate_users');
			$data['username'] = $blogger;
			$data['password'] = $password;
			$data['trongate_user_id'] = $this->trongate_users->_create_user(2);
			$this->model->insert($data,'trongate_administrators');
		}
    }

	/**
	 * Renders the (default) 'welcome' webpage for public access.
	 *
	 * @return void
	 */

	 function index(): void {

		if(isset($_SESSION['trongatetoken'])){
            redirect(BASE_URL.'dashboard');
        }

    	$data['form_location'] = BASE_URL . 'dashboard/submit';
        $data['username'] = post('username');
		$data['title'] = 'Login';
		$data['view_module'] = 'login'; // Indicates the module where the view file exists.
		$data['view_file'] = 'login'; // Specifies the base name of the target PHP view file.
		$this->template('login', $data); // Loads the 'welcome' view file within the public template.
	}

}
