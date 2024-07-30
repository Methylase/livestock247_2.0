 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Create User</h1>
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

    <p class="text-danger">
        <?php 
            echo  (isset($_SESSION["failureMessage"]) && !empty($_SESSION["failureMessage"])) ? $_SESSION["failureMessage"] : "";           
            $_SESSION["failureMessage"] ='';
            unset($_SESSION["failureMessage"]); 
        ?>
    </p>        


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Create User</h6>
                <div class="float-right text-default" id="createUserToggle"><i class="fas fa-plus" id="close"></i></div>
            </div>
            <div class="card-body" id="create-user-body">
            <form class="form" action="<?= BASE_URL ?>create_user/submit" method="POST">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="username" class="control-label">Username</label>
                                <input type="text"  name="username" class="form-control" placeholder="Enter username">
                                <span class="text-danger">
                                    <?php 
                                        echo  (isset($_SESSION["username"]) && !empty($_SESSION["username"])) ? $_SESSION["username"] : "";           
                                        $_SESSION["username"] ="";
                                        unset($_SESSION["username"]); 
                                    ?>
                                </span> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="user-password" class="control-label"> Password</label>
                                <input type="password"  name="password" class="form-control" placeholder="Enter user password">
                                <span class="text-danger">
                                    <?php 
                                        echo  (isset($_SESSION["password"]) && !empty($_SESSION["password"])) ? $_SESSION["password"] : "";           
                                        $_SESSION["password"] ="";
                                        unset($_SESSION["password"]); 
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="user-role" class="control-label"> User Role</label>
                                <select name="role_name" class="form-control">
                                    <option value="">Select User Role</option>
                                    <option value="2">Blogger</option>
                                </select>
                                <span class="text-danger">
                                    <?php 
                                        echo  (isset($_SESSION["role_name"]) && !empty($_SESSION["role_name"])) ? $_SESSION["role_name"] : "";           
                                        $_SESSION["role_name"] ="";
                                        unset($_SESSION["role_name"]); 
                                    ?>
                                </span>
                            </div>
                        </div>                            
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group text-right">
                                <button type="submit"  id="create-user"  class="btn btn-warning" ><i class="fa fa-save"></i> Create User</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>
</div>