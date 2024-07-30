<?php
class Blog_post extends Trongate {

	/**
	 * Renders the (default) 'welcome' webpage for public access.
	 *
	 * @return void
	 */



	function index(): void {
		
        $post_id = $_GET['id'];
        if( $post_id  == null || $post_id  == '' || !is_numeric($post_id )){
            redirect(BASE_URL.'/');
        }  

		$sql= "SELECT * FROM blog_post WHERE delete_post IS NULL LIMIT 3";
		$related_post = $this->model->query($sql, 'object');

        	$blog_post = $this->model->get_one_where('id', $post_id ,'blog_post');
			if(!$blog_post){
				redirect(BASE_URL.'blog');
			}
			$data['related_post'] = $related_post;
        	$data['blog_post'] = $blog_post;
			$data['title'] = 'Blog Post';
			$data['view_module'] = 'blog_post'; // Indicates the module where the view file exists.
			$data['view_file'] = 'blog_post';
			$this->template('livestock247', $data); // Loads the 'welcome' view file within the public template.
	 	
	}


   /**
     * Handles the submission of profile forms,
     *
     * @return void
     */
    function time_spent(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

			/*$data = json_decode(file_get_contents('php://input'));
			$timeSpentInSeconds = $data->timeSpent;
			$blog_post_id = $data->blog_post_id;
			$this->module('trongate_administrators');
			$_SESSION['time_spent'] = $this->trongate_administrators->protectData($timeSpentInSeconds);
			$time_spent = $_SESSION['time_spent'];
			$blog_post_id = $this->trongate_administrators->protectData($blog_post_id);
			$param['last_read_time'] = $time_spent;
			$this->model->update($blog_post_id, $param, 'blog_post');
			$time_spent;*/

			$this->module('trongate_administrators');
			$_SESSION['time_spent'] = $this->trongate_administrators->protectData($_POST['timeSpent']);
			$time_spent = $_SESSION['time_spent'];
			$blog_post_id = $this->trongate_administrators->protectData($_POST['blog_post_id']);
			$param['last_read_time'] = $time_spent;
			$this->model->update($blog_post_id, $param, 'blog_post');
			echo $time_spent;
        
        }
    }

	
}
