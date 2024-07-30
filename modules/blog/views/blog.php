<?php 
		$page=$_GET['page'];
		if($page < 1){
		$page=1;
			
		}
    $blog_post=Modules::run('blog/get_pages',$page);
?>
<div class="wrapper-blog-hero">
    <div class="wrapper-blog-content text-center">
        <h5 class="text-success text-center main-title">OUR BLOG</h5>
        <h2 class="blog-title font-weight-bold">Welcome to Livestock247 Blog</h2>
        <p class="blog-content">The latest industry news, interviews, technologies, and resources.</p>
    </div>
</div>
<div class="wrapper-article">  
    <div class="wrapper-hoina-features-content">  
        <h2 class="wrapper-article-title">Latest articles</h2> 
        <?php if(isset($blog_post) && $blog_post !=null){ ?>
            
            <?php 
            
            $blog_result ='';
            $blog_result .='<div class="row row-article-1">';
            ?>
  
                
                <?php foreach($blog_post as $post){ ?>
                    <?php $blog_result .= '<div class="col-lg-4 col-md-4 col-article">
                                                <div class="col-article-content">
                                                    <img src="'.BASE_URL.'blog_post_upload/'.$post->post_image.'" class="w-100 img-fluid img-article">
                                                    <h5 class="article-subtitle"><a href='.BASE_URL.'blog_post?id='.$post->id.'>'.strtoupper($post->link_post_title).'</a></h5>
                                                    <h2 class="article-main-title">'.$post->post_title.'</h2>
                                                    <p class="article-content">
                                                    '.$post->post_description.'
                                                    </p>
                                                    <div class="author d-flex align-items-start">
                                                        <div class="author-content d-flex align-items-center justify-content-center">
                                                            <span class="author-tag">'.Modules::run('profile/get_user_tag',$post->trongate_user_id).'</span>
                                                            <span class="author-details mt-3 ml-3">
                                                                <h6 class="author-name">'.Modules::run('profile/get_user_fullname',$post->trongate_user_id).'</h6>
                                                                <p><span class="date-posted">'.Modules::run('blog/get_created_date',$post->trongate_user_id).'</span><span class="last-read-time">'.Modules::run('blog/last_read_time',$post->id).'</span></p>
                                                            </span>
                                                        </div> 
                                                    </div>                    
                                                </div>
                                            </div>';
                   } 
                   $blog_result .= '</div>';
                   echo $blog_result;

                    if($page<1){ 
                        $page=1;
                    } 

                    if($page>$lastpage){
                        $page=$lastpage;
                    }
                    if($page==1){
                    
                ?>
                    <ul class='pagination'>
                    <li class=''><a  href='<?= BASE_URL.'blog?page='.$page ?>' class='page-link' ><img src="<?= THEME_DIR?>img/button/Left.svg"> </a></li>
                <?php }else{
                    $prev=$page-1;
                ?>
                    <ul class='pagination'>
                        <li class=''><a href='<?= BASE_URL.'blog?page='.$prev ?>' class='page-link' ><img src="<?= THEME_DIR?>img/button/next.svg" style="height:38px"></a></li>
                <?php 
                }
                 
                for($j=0; $j<$total; $j++){
                    if($page==$j){
                ?>
                    <li class=''><a href='<?= BASE_URL.'blog?page='.$j ?>'  class='page-link'><?php echo $j ?></a></li>
                <?php            
                    }
                }
           
                if($page==$lastpage){
                    
            ?>
			    <li class=''> <a href='<?= BASE_URL.'blog?page='.$lastpage ?>'  class='page-link'>Last</a></li>
            <?php
		   }else{
			$next=$page+1;
           
           ?>
			<li class=''><a href='<?= BASE_URL.'blog?page='.$next ?>'  class='pag-li'><img src="<?= THEME_DIR?>img/button/next.svg" style="height:38px"> </a></li>
		   <?php
            }  
           ?>
            
            </ul>                 
            <?php }else{ ?>  
            <p class="text-center">No blog post article found</p>
        <?php } ?>  
 
                                         
    </div>
</div>



