<?php
class Users extends Trongate {
	/**
	 * Renders the (default) 'all post' webpage for public access.
	 *
	 * @return void
	 */
	function index(): void{

		if(!isset($_SESSION['trongatetoken'])){
            redirect(BASE_URL.'login');
        }
		
		$trongate_user_id = $_SESSION['user_id'];
        $profile_result = $this->model->get_one_where('trongate_user_id', $trongate_user_id,'profiles');
        $sql= "SELECT trongate_administrators.trongate_user_id as id, trongate_administrators.username as username, trongate_administrators.lock_user as lock_user,
		profiles.firstname as firstname, profiles.lastname as lastname, profiles.email as email, profiles.phone_number
		as phone_number FROM trongate_administrators INNER JOIN profiles ON trongate_administrators.trongate_user_id
		= profiles.trongate_user_id WHERE trongate_administrators.username !='admin'";
        $users = $this->model->query($sql, 'object');
        $data['profile_result'] = $profile_result;
        $data['users'] = $users;
		$data['title'] = 'Users';
		$data['view_module'] = 'users'; // Indicates the module where the view file exists.
		$data['view_file'] = 'users'; // Specifies the base name of the target PHP view file.
		$this->template('blogger', $data); // Loads the 'welcome' view file within the public template.
	}

	/**
	 * 'lock user'
	 *
	 * @return void
	 */
	function lock_user():void {
       
       $this->module('trongate_administrators');
	   $this->module('trongate_tokens');

       $trongate_user_id = $this->trongate_administrators->protectData($_POST['trongate_user_id']);
       $params['trongate_user_id'] = $trongate_user_id;
	   $lock_user = $this->model->get_one_where('trongate_user_id', $trongate_user_id,'trongate_administrators');

	   	if($lock_user == false){
			abort('401');
	   	}
	   	if($lock_user->lock_user !='lock'){
			$params['lock_user'] = 'lock';
			$sql= "UPDATE trongate_administrators SET lock_user = :lock_user WHERE trongate_user_id =:trongate_user_id";
			$lock_user = $this->model->query_bind($sql, $params);
			$response = ['status' => 'success', 'message'=>'User with an id '.$trongate_user_id.' has been locked'];
   		}else{
			$params['lock_user'] = NULL;
			$sql= "UPDATE trongate_administrators SET lock_user = :lock_user WHERE trongate_user_id =:trongate_user_id";
			$lock_user = $this->model->query_bind($sql, $params);
			$response = ['status' => 'success', 'message'=>'User with an id '.$trongate_user_id.' has been unlocked'];			
		}

		// Return response as JSON
		echo json_encode($response);
	}

	function number_of_users(){

		$stmt =  "SELECT count(*) AS total FROM trongate_administrators WHERE username ='admin' AND lock_user IS NULL";
		$users_result  = $this->model->query($stmt,'object');
		$users_count  = $users_result[0]->total;
		echo $users_count;
	}

	
	function number_of_locked_users(){

		$stmt =  "SELECT count(*) AS total FROM trongate_administrators WHERE lock_user='lock'";
		$users_result  = $this->model->query($stmt,'object');
		$lock_users_count  = $users_result[0]->total;
		echo $lock_users_count;
	}
	
}
