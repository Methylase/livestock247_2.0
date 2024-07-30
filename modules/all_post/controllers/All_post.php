<?php
class All_post extends Trongate {
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
		$this->module('dashboard');
		if($this->dashboard->authorize_user($trongate_user_id) =="blogger_admin"){ 
			$sql= "SELECT * FROM blog_post WHERE delete_post IS NULL";
			$all_post = $this->model->query($sql, 'object');
		}else{
			$sql= "SELECT * FROM blog_post WHERE delete_post IS NULL AND trongate_user_id =$trongate_user_id";
			$all_post = $this->model->query($sql, 'object');
		}

        $data['profile_result'] = $profile_result;
        $data['all_post'] = $all_post;
		$data['title'] = 'All Post';
		$data['view_module'] = 'all_post'; // Indicates the module where the view file exists.
		$data['view_file'] = 'all_post'; // Specifies the base name of the target PHP view file.
		$this->template('blogger', $data); // Loads the 'welcome' view file within the public template.
	}

	/**
	 *'delete post'
	 *
	 * @return void
	 */
	function delete_post(){
       
       $this->module('trongate_administrators');

       $post_id = $this->trongate_administrators->protectData($_POST['post_id']);
       $params['id'] = $post_id;
       $params['delete_post'] = 'delete';

        $sql= "UPDATE blog_post SET delete_post = :delete_post WHERE id =:id";
        $delete_post = $this->model->query_bind($sql, $params);

            $response = ['status' => 'success', 'message'=>'Post with an id '.$post_id.' has been deleted successfully'];
            // Return response as JSON
            echo json_encode($response);
	}

}
