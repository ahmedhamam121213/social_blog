
<?php 
session_start();
//connection of data base
$db = new PDO("mysql:host=localhost;dbname=social_blog", "root", "" , array(PDO::MYSQL_ATTR_INIT_COMMAND =>  "SET NAMES 'UTF8'") );
//fetch info of logged user

//start if user click delete
if( isset( $_GET['action'] )  && $_GET['action']= 'delete' && isset( $_GET['id'] ) ){
  $id = $_GET['id'];
  
  if( $id >= 0  ){

    $sql =$db->prepare(" DELETE FROM users WHERE id = :id ");
    $sql->execute( array( ":id" => $id ) );
    $_SESSION['messege']  = "user has been deleted successfully";
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/social_blog/user.php');
    

  }
}
//end if user click delete

require_once("head.php");
?>
  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
  </div>
  <div class="section profile-content" style="background:#fff ">
    <div class="container">
      <div class="owner">
        <div class="avatar">
          <img src="https://t3.ftcdn.net/jpg/01/49/81/06/240_F_149810615_9YowtTtIjcqe6AZXsH1VCPbXzC1ON9yN.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
        </div>
      </div>
<!--start fetch all users-->
<?php
$sql =  $db->prepare(" SELECT * from users");
$myResult = $sql->execute();
$users = $sql->fetchAll() ;
?>

<!--if new user saved message will appeear-->
<?php if( isset( $_SESSION['messege'] ) ){ ?>
  <h4 class="text-center">
    <div class="alert alert-success">
      <div class="container">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <span style="font-size: 20px;font-weight: 400;"
        ><?php  echo $_SESSION['messege']; $_SESSION['messege']=""  ?> </span>
      </div>
    </div>
  </h4>
<?php } ?>
<!--if new user saved message will appeear-->
<a class="btn btn-primary" href="addUser.php?action=add">Add User</a>
<!--start table-->
<table class="table">
  <thead>
    <tr>
      <!-- <th scope="col">id</th> -->
      <th scope="col">Id</th>
      <th scope="col">Username</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
     <?php 
    foreach( $users as $user ){ ?>
    <tr>
      <?php

       // echo "<td>".$employee->id."</td>" ;
       echo "<td>".$user['id']."</td>" ;
       echo "<td>".$user['username']."</td>" ;
       echo "<td><a href='editUser.php?action=edit&id=".$user['id']."'>edit</a>
       <a href='?action=delete&id=".$user['id']."' onclick=\"return confirm('Are you sure you want to delete this item?');\">delete</a>
       </td>" ;
      ?>
    </tr>
  <?php } ?>
   
  </tbody>
</table>
<!--end table-->

<!--end fetch all users-->


     

      
      
    </div>
  </div>
  <?php require_once("footer.php"); ?>