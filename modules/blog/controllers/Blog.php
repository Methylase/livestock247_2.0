<?php
class Blog extends Trongate {

	/**
	 * Renders the (default) 'welcome' webpage for public access.
	 *
	 * @return void
	 */

	 function index(): void {

		if(isset($_GET['page'])){
			$page=$_GET['page'];
			if($page < 1){
			 $page=1;
		   }

		   if($page==""){
			$page=1;
		   }
		   $page_max=10;
		   $page_limit= ($page-1) * $page_max;
		   
			$sql= "SELECT * FROM blog_post WHERE delete_post IS NULL LIMIT $page_limit,$page_max";
			$blog_post = $this->model->query($sql, 'object');

			$stmt =  "SELECT count(*) AS total FROM blog_post WHERE delete_post IS NULL";
			$result = $this->model->query($stmt,'object');
			$total = $result[0]->total;
			$lastpage=ceil($total/$page_max);

			$data['page'] = $page;
			$data['total'] = $total;
			$data['lastpage'] = $lastpage;
			$data['blog_post'] = $blog_post;
			$data['title'] = 'Blog';
			$data['view_module'] = 'blog'; // Indicates the module where the view file exists.
			$data['view_file'] = 'blog'; // Specifies the base name of the target PHP view file.
			$this->template('livestock247', $data); // Loads the 'welcome' view file within the public template.
	 	}else{
			redirect(BASE_URL.'blog?page=1');
		}
	}


    //get user tag
    function get_pages($page){
		$page_max=10;
		$page_limit= ($page-1) * $page_max;
		
		 $sql= "SELECT * FROM blog_post WHERE delete_post IS NULL LIMIT $page_limit,$page_max";
		 $blog_post = $this->model->query($sql, 'object');
		 return $blog_post;
    	
	}
    //get created date
    function get_created_date($user_id){
        $blog_result = $this->model->get_one_where('trongate_user_id', $user_id,'blog_post');
		if($blog_result ==false){
			abort("401");
		}
		$date_created =date('j M Y',strtotime($blog_result->created_at));

		 return $date_created;
        
    }	


    //get created date
    function last_read_time($post_id){

        $blog_result = $this->model->get_one_where('id', $post_id,'blog_post');
		if($blog_result ==false){
			abort("401");
		}
         if($blog_result->last_read_time != NULL){
			$last_read_time = $blog_result->last_read_time;
			$last_read_time = ' last read '.$last_read_time;
		 }else{
			$last_read_time ="";
           
		 }
		 return $last_read_time;
        
    }	
	
	function number_of_blog_post(){

		$stmt =  "SELECT count(*) AS total FROM blog_post";
		$blog_result  = $this->model->query($stmt,'object');
		$blog_post_count  = $blog_result[0]->total;
		echo $blog_post_count;
	}

	function number_of_deleted_post(){

		$stmt =  "SELECT count(*) AS total FROM blog_post WHERE delete_post='delete'";
		$blog_result  = $this->model->query($stmt,'object');
		$delete_post_count  = $blog_result[0]->total;
		echo $delete_post_count;
	}
	
	
}
