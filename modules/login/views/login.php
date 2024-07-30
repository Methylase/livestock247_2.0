
<?php

    $attr['placeholder'] = 'Enter your username here';
    $attr['autocomplete'] = 'off';
    $attr['class']='form-control';
    $btn_submit['class'] ='btn btn-primary btn-block font-weight-bold mr-2';
    $btn_cancel['class'] ='btn btn-warning font-weight-bold';
    $error['class']='highlight-errors';
    echo "<div class='wrapper-form-container'>
            <div class='form-container'>
            <div class='text-center mb-3'>";
 ?>
    <p class="text-danger">
        <?php 
            echo  (isset($_SESSION["failureMessage"]) && !empty($_SESSION["failureMessage"])) ? $_SESSION["failureMessage"] : "";           
            $_SESSION["failureMessage"] ='';
            unset($_SESSION["failureMessage"]); 
        ?>
    </p>  
    <?php
                echo  "<img src='".THEME_DIR."img/desktop logo.png' class='w-50 img-fluid mt-5'> 
            </div>
                <h2 class='text-center mb-4'>Login</h2>";

                echo form_open($form_location, $error);
                    echo " <div class='form-group'>";
                    echo form_label('Username', array('class'=>'control-label'));
                    echo form_input('username', $username, $attr);
                    echo strip_tags(str_replace('&#9679;','', validation_errors('username')));
                    echo "</div>";
                    echo " <div class='form-group'>";
                    echo form_label('Password');
                    $attr['placeholder'] = str_replace('username', 'password',  $attr['placeholder']);
                    echo form_password('password', '', $attr);
                    echo strip_tags(str_replace('&#9679;','', validation_errors('password')));
                    echo "</div>";
                    echo " <div class='form-group'>";
                    echo form_label(form_checkbox('remember', 1) . ' Remember me');
                    echo "</div>";
                    echo " <div class='form-group'>";
                    echo form_submit('submit', 'Login', $btn_submit);
                echo form_close();
echo        "</div>
        </div>
    </div>";

?>
<!--<div class="wrapper-form-container">
    <div class="form-container">
        <div class="text-center mb-3">
            <img src="<?= BASE_URL ?>img/logo.png" class="w-50 img-fluid"> 
        </div>

        <h2 class="text-center mb-4">Blogger</h2>
        <form action="<?= BASE_URL ?>dashboard/submit" method="POST" >
            <div class="form-group">
                <label for="user-name" class="control-label">Username</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password" class="control-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>  
            <div class="form-group mt-3">
                <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block font-weight-bold">
            </div>                                             
        </form>
    </div>

</div>-->