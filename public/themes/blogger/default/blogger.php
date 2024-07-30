<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="description" content="">  
  <meta name="author" content="">

  <title>Livestock247 - <?php echo $title ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= THEME_DIR?>blog_template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="icon" type="image/png" href="<?= THEME_DIR?>img/desktop logo.png"  sizes ="25x25"> 
  <!-- Custom styles for this template-->
  <link href="<?= THEME_DIR?>jqueryTimePicker/jquery.timepicker.min.css" rel="stylesheet"> 
  <link href="<?= THEME_DIR?>blog_template/css/jquery.dataTables.min.css" rel="stylesheet"> 
  <link href="<?= THEME_DIR?>blog_template/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= THEME_DIR?>blog_template/css/bootstrap-multiselect.min.css" rel="stylesheet">
  <script src="<?= THEME_DIR?>jqueryTimePicker/jquery.timepicker.min.js"></script> 
  <script src="<?= THEME_DIR?>blog_template/vendor/jquery/jquery.min.js"></script> 
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

  <script>
      function dateTime(){
        var date = new Date();
        var h = date.getHours();
        var m = date.getMinutes();
        if (h > 12) {
          h -= 12;
        }else if (h ===0){
          h = 12;
        }
        var s =date.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        var  result = h+':'+ m +':'+s;
        document.getElementById('time').innerHTML = result;
        var t =setTimeout(dateTime,1000);
      }
      function checkTime(i) {
        if (i < 10) {
           i = "0" + i;
        }
        return i;
      }  

      $(document).ready(function(){     
        
        $('#usersToggle').click(function(){
            $('#users-body').toggle();
        }); 
        

        $('#createUserToggle').click(function(){
            $('#create-user-body').toggle();
        }); 

        $('#profileToggle').click(function(){
            $('#profile-body').toggle();
        }); 

        $('#createPostToggle').click(function(){
            $('#create-post-body').toggle();
        }); 

        $('#allBlogPostToggle').click(function(){
            $('#all-blog-post-body').toggle();
        }); 

        $('#dataTablePosts').DataTable({
          "aLengthMenu":[[5,10,15,20,50,100,200, 500,-1], [5,10,15,20,50,100,200,500, "All"]],
          "iDisplayLenghth": 5,
        }); 

        $('#dataTableUsers').DataTable({
          "aLengthMenu":[[5,10,15,20,50,100,200, 500,-1], [5,10,15,20,50,100,200,500, "All"]],
          "iDisplayLenghth": 5,
        });        

        // delete of post
        $('.deletePost').on('click', function(){
          var delPost = $(this).attr('id');
          delPost = delPost.split(' ');
          $('.del_post').attr('id', 'del_post'+delPost[1])
          $('#del_post'+delPost[1]).on('click', function(){
          values= {
            "post_id": delPost[1]
          }
          $.ajax({
              type: "POST",
              url: "<?= BASE_URL ?>all_post/delete_post",
              data: values,
              dataType: 'json',
          }).done(function(result){
              console.log(result);
              
            if (result.status=='success'){
              $('#confirm-delete').modal('hide');
              $("#all-blog-post-body").prepend("<div class='status alert alert-warning text-center col-sm-9 offset-sm-1'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a><strong >" +result.message+"</strong></div>"); 
              setTimeout(function(){
              location.reload();
              }, 3000);
            }
          });
          });
        });


        // lock user
        $('.lockUser').on('click', function(){
          var lockUser = $(this).attr('id');
          lockUser = lockUser.split(' ');
          $('.lock_user').attr('id', 'lock_user'+lockUser[1])
          $('#lock_user'+lockUser[1]).on('click', function(){
          values= {
            "trongate_user_id": lockUser[1]
          }
          $.ajax({
              type: "POST",
              url: "<?= BASE_URL ?>users/lock_user",
              data: values,
              dataType: 'json',
          }).done(function(result){
              console.log(result);
              
            if (result.status=='success'){
              $('#lock-user').modal('hide');
              $("#users-body").prepend("<div class='status alert alert-warning text-center col-sm-9 offset-sm-1'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a><strong >" +result.message+"</strong></div>"); 
              setTimeout(function(){
              location.reload();
              }, 3000);
            }
          });
          });
        }); 

        
        //number of users
        setInterval(function() {
          $.get('<?= BASE_URL ?>users/number_of_users', function(data){
            $('.number_of_users').html(data);
          });            
        }, 1000);
      


        //number of locked users
        setInterval(function() {
          $.get('<?= BASE_URL ?>users/number_of_locked_users', function(data){
            $('.number_of_locked_users').html(data);
          });          
        }, 1000);

        
        //number of blog post
        setInterval(function() {
          $.get('<?= BASE_URL ?>blog/number_of_blog_post', function(data){
            $('.number_of_blog_post').html(data);
          });          
        }, 1000);
    
        
        //number of blog post
        setInterval(function() {
          $.get('<?= BASE_URL ?>blog/number_of_deleted_post', function(data){
            $('.number_of_deleted_post').html(data);
          });            
        }, 1000);
       
              
      });

      tinymce.init({
      /*selector: 'textarea#post-description',*/
      skin: 'bootstrap',
      plugins: 'lists, link, image, media',
      toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
      menubar: true,
    });


  </script>
    <style>
     i#close, #time{
      display: inline-block;
      border-radius: 60px;
      box-shadow: 1px 1px 1px #888;
      padding: 0.5em 0.6em;
     }

     th{
      text-align:center;
      }
      td{
          font-size: .85rem !important;
      }

      td.post-description{
        overflow-y: scroll;
        text-overflow: ellipsis;
        white-space: wrap;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        height:100%;
      }
      td:hover{
        color: black;
      }      
      .table-redesign{
        border-radius: 20px !important;
        border-bottom: 2px solid #36b9cc !important;
      }
     .paginate-btn{
        margin: 2px;
      }
     .paginate-btn{
        margin: 2px;
      }
      .img-rounded{
     border: 1px solid #E74A3B;
     border-left: 10px solid #E74A3B;
     border-right: 10px solid #E74A3B;
     /*background-color: #E74A3B;*/
      border-radius: 5px !important;   
     }   
     .services{
         margin-left: 5px;
      } 
      
      .container-fluid{
        min-height: 600px;
        max-height: 900px;
      }

      .img-container{
        width: 250px;
      } 
       .img-container > img{
          height: 180px;
       }
      @media (max-width: 986px) {
        .d-form {
            text-align: center !important; 
            width:70% !important; 
            margin:auto !important; 
            background-color:red !important; 
        }
    }
    </style>  
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= BASE_URL ?>dashboard">
        <div class="sidebar-brand-text mx-3">Livestock247 </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?= BASE_URL ?>dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <?php if(Modules::run('dashboard/authorize_user',$_SESSION['user_id']) =="blogger_admin"){ ?>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseCreateUser" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog fa-user text-gray-400"></i>
          <span>Users</span>
        </a>
        <div id="collapseCreateUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Users:</h6>
              <a class="collapse-item" href="<?= BASE_URL ?>create_user">Create User</a>  
              <a class="collapse-item" href="<?= BASE_URL ?>users">Users</a>   
          </div>
        </div>
      </li>
      <?php } ?>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog fa-user text-gray-400"></i>
          <span>Profile</span>
        </a>
        <div id="collapseProfile" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Profile:</h6>
              <a class="collapse-item" href="<?= BASE_URL ?>profile">Update Profile</a> 
            <!--<a class="collapse-item" href="<?= BASE_URL ?>reset-password">Reset Password</a>-->
                          
          </div>
        </div>
      </li>      
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePost" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog fa-user text-gray-400"></i>
          <span>Post</span>
        </a>
        <div id="collapsePost" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Post:</h6>
              <a class="collapse-item" href="<?= BASE_URL ?>create_post">Create Post</a>
              <a class="collapse-item" href="<?= BASE_URL ?>all_post">All Blog Post</a>             
          </div>
        </div>
      </li>        
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>      
      <!-- Nav Item - Pages Collapse Menu -->

      <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL ?>dashboard/logout_blogger" onclick="event.preventDefault();
       document.getElementById('logout-form').submit()">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          <span>Logout</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <span class="bg-warning" id="time" style="padding:8px;color:white;border-radius:3px"></span>
          </div>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>
                
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo isset($profile_result->email)&& !empty($profile_result->email)? $profile_result->email: "" ?></span>
         
                <img class="img-profile rounded-circle" src="<?php echo isset($profile_result->file) && !empty($profile_result->file)?  BASE_URL."uploads/".$profile_result->file :  THEME_DIR."img/defaultImage.jpg" ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= BASE_URL ?>profile">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= BASE_URL ?>dashboard/logout_blogger" onclick="event.preventDefault();
                document.getElementById('logout-form').submit()">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
          <?= Template::display($data) ?>
        <!-- Footer -->
        <footer class="sticky-footer bg-white ">
            <div class="container my-auto">
              <div class="copyright text-center my-auto">
                <span>Copyright &copy; The School <?=  Date('Y') ?></span>
              </div>
            </div>
          </footer>
          <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= THEME_DIR?>blog_template/vendor/jquery/jquery.min.js"></script>
  <script src="<?= THEME_DIR?>blog_template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= THEME_DIR?>blog_template/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= THEME_DIR?>blog_template/js/sb-admin-2.min.js"></script>
   <script> window.onload=dateTime();</script>    
  <!-- Page level plugins -->
  <script src="<?= THEME_DIR?>blog_template/vendor/chart.js/Chart.min.js"></script>
  <script type="text/javascript" src="<?= THEME_DIR?>jqueryTimePicker/jquery.timepicker.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="<?= THEME_DIR?>blog_template/js/demo/chart-area-demo.js"></script>
  <script src="<?= THEME_DIR?>blog_template/js/demo/chart-pie-demo.js"></script>
  <script src="<?= THEME_DIR?>blog_template/js/jquery.dataTables.min.js"></script> 
  <script src="<?= THEME_DIR?>blog_template/js/bootstrap-multiselect.min.js"></script> 
    <form id='logout-form' action="<?= BASE_URL ?>dashboard/logout_blogger"
    method="POST" style='display:none'>
    </form>
</body>

</html>
