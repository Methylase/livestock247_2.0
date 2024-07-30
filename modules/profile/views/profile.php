 <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update Profile</h1>
      </div>
    
      <!-- Content Column -->
      <div class="col-lg-12 mb-4">
             <p class="text-success">
                <?php 
                    echo  (isset($_SESSION["successMessage"]) && !empty($_SESSION["successMessage"])) ? $_SESSION["successMessage"] : "";           
                    $_SESSION["successMessage"] ='';
                    unset($_SESSION["successMessage"]); 
                ?>
            </p>

            <p class="text-danger">
                <?php 
                    echo  (isset($_SESSION["failureMessage"]) && !empty($_SESSION["failureMessage"])) ? $_SESSION["failureMessage"] : "";           
                    $_SESSION["failureMessage"] ='';
                    unset($_SESSION["failureMessage"]); 
                ?>
            </p>            
  
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Update Profile</h6>
                    <div class="float-right text-warning" id="profileToggle"><i class="fas fa-plus" id="close"></i></div>
                </div>
                <div class="card-body" id="profile-body">
                    <form class="form" action="<?= BASE_URL ?>profile/submit" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="id" value="<?php echo  isset($profile_result->id)&& !empty($profile_result->id)? $profile_result->id: "" ?>">
                        <input type="hidden" name="trongate_user_id" value="<?php echo isset($profile_result->trongate_user_id)&& !empty($profile_result->trongate_user_id)? $profile_result->trongate_user_id: "" ?>">
                        <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="text-center img-container">
                                    <img src="<?php echo isset($profile_result->file) && !empty($profile_result->file)?  BASE_URL."uploads/".$profile_result->file :  THEME_DIR."img/defaultImage.jpg" ?>" class="img-fluid mb-4">

                                </div>                      
                                <input type="file" id="file" name="file" class="form-control">
                                <label for="profile-image" class="control-label">Select profile image</label> 
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
                            <div class="col-md-6 col-sm-6 ">
                                <div class="form-group">
                                    <label for="first-name" class="control-label">Firstname</label>
                                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter first name" value="<?php echo  isset($profile_result->firstname)&& !empty($profile_result->firstname)? $profile_result->firstname: "" ?>">
                                    <span class="text-danger">
                                        <?php 
                                            echo  (isset($_SESSION["firstname"]) && !empty($_SESSION["firstname"])) ? $_SESSION["firstname"] : "";           
                                            $_SESSION["firstname"] ="";
                                            unset($_SESSION["firstname"]); 
                                        ?>
                                    </span>                      
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                                <div class="form-group">
                                    <label for="last-name" class="control-label">Lastname</label>
                                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter last name" value="<?php echo isset($profile_result->lastname)&& !empty($profile_result->lastname)? $profile_result->lastname: "" ?>">
                                    <span class="text-danger">
                                        <?php 
                                            echo  (isset($_SESSION["lastname"]) && !empty($_SESSION["lastname"])) ? $_SESSION["lastname"] : "";           
                                            $_SESSION["lastname"] ="";
                                            unset($_SESSION["lastname"]); 
                                        ?>
                                    </span>                      
                                </div>
                            </div>                      
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email" class="control-label"> Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" value="<?php echo isset($profile_result->email)&& !empty($profile_result->email)? $profile_result->email: "" ?>" >
                                    <span class="text-danger">
                                        <?php 
                                            echo  (isset($_SESSION["email"]) && !empty($_SESSION["email"])) ? $_SESSION["email"] : "";           
                                            $_SESSION["email"] ="";
                                            unset($_SESSION["email"]); 
                                        ?>
                                    </span>                        
                                </div>
                            </div>                      
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone-number" class="control-label"> Phone Number</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Enter phone number" value="<?php echo isset($profile_result->phone_number)&& !empty($profile_result->phone_number)? $profile_result->phone_number: "" ?>">
                                    <span class="text-danger">
                                        <?php 
                                            echo  (isset($_SESSION["phone_number"]) && !empty($_SESSION["phone_number"])) ? $_SESSION["phone_number"] : "";           
                                            $_SESSION["phone_number"] ="";
                                            unset($_SESSION["phone_number"]); 
                                        ?>
                                    </span>                       
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="designation" class="control-label">Author's Designation</label>
                                    <input type="text" id="designation" name="designation" class="form-control"  value="Content Strategist, Livestock247" readonly>
                                    <span class="text-danger">
                                        <?php 
                                            echo  (isset($_SESSION["designation"]) && !empty($_SESSION["designation"])) ? $_SESSION["designation"] : "";           
                                            $_SESSION["designation"] ="";
                                            unset($_SESSION["designation"]); 
                                        ?>
                                    </span>                      
                                </div>
                            </div>                  
                            <div class="col-md-6 col-sm-6">
                                <br>
                                <div class="form-group text-right">
                                    <button type="submit"  id="update-profile"  class="btn btn-warning" ><i class="fa fa-save"></i> Update Profile </button>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
            </div>
      </div>
    </div>