 <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">All Users</h1>
    </div>

    <!-- Content Column -->
    <div    class="col-lg-12 mb-4">

        <!-- Approach -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">All Users</h6>
                <div class="float-right text-warning" id="usersToggle"><i class="fas fa-plus" id="close"></i></div>
            </div>
            <div class="card-body " id="users-body">
                        <div class="table-responsive">
                            <?php if(isset($users) && $users !=null){ ?>
                                <table class="table table-bordered table-striped" id="dataTableUsers" width="100%" cellspacing="0">                                
                                    <thead>
                                    <tr>
                                    <th>S/N</th>
                                        <th>Username</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                        <?php $i=1 ?>
                                    
                                    <tbody>
                                    <?php foreach($users as $user):  ?>
                                        <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $user->username ?></td>
                                        <td><?= $user->firstname ?></td>
                                        <td><?= $user->lastname ?></td>
                                        <td><?= $user->email ?></td>
                                        <td><?= $user->phone_number ?></td>
                                        <td> 
                                            <?php if($user->username == "blogger_admin"){
                                                $disabled ="disabled";
                                              }else{
                                                $disabled ="";
                                              } 
                                            ?>                                     
                                            <a class="btn btn-sm btn-warning text-white lockUser <?= $disabled ?>"  id="lock <?= $user->id ?>" data-title="Lock User" data-toggle="modal" data-target="#lock-user">
                                                <?php if($user->lock_user == "lock"){?>
                                                    <span class="fa fa-lock" title="Lock user" ></span>
                                                <?php }else{ ?>
                                                    <span class="fa fa-unlock" title="Lock user"></span>
                                                <?php } ?>    
                                            </a>
                                            
                                        </td>  
                                        </tr>
                                        
                                        <?php $i++ ?>
                                    
                                    <?php endforeach; ?>
                                
                                    </tbody>  
                                </table>

                            <?php 
                                }else{
                            ?>  
                                <p class="text-center">No User found</p>
                            <?php } ?>  

                        </div>                         
                        <!-- modal for lock user -->
                        <div class="modal col-md-10 offset-md-2  col-sm-10 offset-sm-2 " id="lock-user" tabindex="-1" role="dialog" aria-labelledby="lock" aria-hidden="true">                  
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title" id="Heading">Lock this user</h4>
                                </div>
                                <div class="modal-body">
                                <div class="alert alert-warning  format"><span class="fa fa-warning text-danger"></span> Are you sure you want to lock this user?</div>
                                </div>
                                <div class="modal-footer">
                                <button  class="btn btn-success lock_user"><span class="fa fa-check-circle"></span> Yes</button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="fa fa-remove"></span> No</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    <!-- end of modal for lock user -->                        
            </div>
        </div>
    </div>
</div>