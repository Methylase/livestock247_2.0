 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Edit Post</h1>
</div>

<!-- Content Column -->
<div    class="col-lg-12 mb-4">
    <p class="text-success">
        <?php 
            echo  (isset($_SESSION["successMessage"]) && !empty($_SESSION["successMessage"])) ? $_SESSION["successMessage"] : "";           
            $_SESSION["successMessage"] ='';
            unset($_SESSION["successMessage"]); 
        ?>
    </p>

    <!-- Approach -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Create Post</h6>
            <div class="float-right text-warning" id="editPostToggle"><i class="fas fa-plus" id="close"></i></div>
        </div>
        <div class="card-body" id="edit-post-body">
            <form class="form" action="<?= BASE_URL ?>edit_post/submit" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="id" value="<?php echo isset($edit_post->id)&& !empty($edit_post->id)? $edit_post->id: "" ?>">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">                       
                            <input type="file" id="file" name="file" class="form-control">
                            <label for="create-post-image" class="control-label"> Select post image</label>  
                            <br>
                            <span class="text-danger">
                                <?php 
                                    echo  (isset($_SESSION["uploadFile"]) && !empty($_SESSION["uploadFile"])) ? $_SESSION["uploadFile"] : "";           
                                    $_SESSION["uploadFile"] ="";
                                    unset($_SESSION["uploadFile"]); 
                                ?>
                            </span>  
                        </div>
                    </div>                       
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="link-post-title" class="control-label">Link post title</label>
                            <input type="text" id="link-post-title" name="link-post-title" class="form-control" placeholder="Enter link post title" value="<?php echo isset($edit_post->link_post_title)&& !empty($edit_post->link_post_title)? $edit_post->link_post_title: "" ?>">
                            <span class="text-danger">
                                <?php 
                                    echo  (isset($_SESSION["link-post-title"]) && !empty($_SESSION["link-post-title"])) ? $_SESSION["link-post-title"] : "";           
                                    $_SESSION["link-post-title"] ="";
                                    unset($_SESSION["link-post-title"]); 
                                ?>
                            </span>                      
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="post-title" class="control-label">Post title</label>
                            <input type="text" id="post-title" name="post-title" class="form-control" placeholder="Enter post title" value="<?php echo isset($edit_post->post_title)&& !empty($edit_post->post_title)? $edit_post->post_title: "" ?>">
                            <span class="text-danger">
                                <?php 
                                    echo  (isset($_SESSION["post-title"]) && !empty($_SESSION["post-title"])) ? $_SESSION["post-title"] : "";           
                                    $_SESSION["post-title"] ="";
                                    unset($_SESSION["post-title"]); 
                                ?>
                            </span>                      
                        </div>
                    </div>                      
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="post-description" class="control-label"> Post description</label>
                            <textarea  id="post-description" name="post-description" class="form-control" placeholder="Enter email" ><?php echo isset($edit_post->post_description)&& !empty($edit_post->post_description)? $edit_post->post_description: "" ?></textarea>
                            <span class="text-danger">
                                <?php 
                                    echo  (isset($_SESSION["post-description"]) && !empty($_SESSION["post-description"])) ? $_SESSION["post-description"] : "";           
                                    $_SESSION["post-description"] ="";
                                    unset($_SESSION["post-description"]); 
                                ?>
                            </span>                        
                        </div>
                    </div>                      
                </div>  
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group text-right">
                            <button type="submit"  id="edit-post"  class="btn btn-warning" ><i class="fa fa-save"></i> Update Post </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>