
<?php 

//connection of data base
$db = new PDO("mysql:host=localhost;dbname=social_blog", "root", "" , array(PDO::MYSQL_ATTR_INIT_COMMAND =>  "SET NAMES 'UTF8'") );
if(  isset( $_POST['Add-user'] )  ){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $image_url = $_POST['image_url'];

  $sql =  $db->prepare( " INSERT INTO users ( username , password , image_url ) 
             VALUES (:username,:password,:image_url)" );
  $bindedParams = array( ":username" => $username , ":password" => $password ,":image_url" => $image_url );

  if( $sql->execute( $bindedParams ) ){
    $message = "User Has Been Saved Succesfully";
  }         
}
require_once("head.php");
?>
  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
  </div>
<!--start add user-->
<?php if( isset( $_GET['action'] )  && $_GET['action']= 'add' ){ ?>

  <div class="section profile-content"  style="background:#fff">
    <div class="container">
      <div class="owner">
        <div class="avatar">
          <img src="https://image.shutterstock.com/image-photo/pensive-young-african-american-freelancer-260nw-557613382.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
        </div>
      </div>
      <?php if( isset( $message ) ){ ?>
      <h4 class="text-center">
        <div class="alert alert-success">
          <div class="container">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="nc-icon nc-simple-remove"></i>
            </button>
            <span style="font-size: 20px;font-weight: 400;"><?php  echo $message;  ?> </span>
          </div>
        </div>
      </h4>
      <?php } ?>
    </div>
  </div>
  <div class="main">
    <div class="section landing-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto">
            <h2 class="text-center">Add User</h2>
            <form class="contact-form" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <label>Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <!-- <i class="nc-icon nc-single-02"></i> -->
                      </span>
                    </div>
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <!-- <i class="nc-icon nc-email-85"></i> -->
                      </span>
                    </div>
                    <input type="text" name="password" class="form-control" placeholder="Password" required>
                  </div>
                </div>
              </div>
              <label>Image Url</label>
              <textarea class="form-control" name="image_url" rows="4" placeholder="Type Your Image Url" required></textarea>
              <div class="row">
                <div class="ml-auto mr-auto">
                  <input type="submit" name="Add-user" class="btn btn-danger btn-lg btn-fill" value="Submit">
                  
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
<!--end add user-->


<!--start fetch all users-->
<?php if( isset( $_GET['action'] )  && $_GET['action']= 'view' ){
$sql =  $db->prepare(" SELECT * from users");
$myResult = $sql->execute();
$users = $sql->fetchAll() ;
echo "<pre>";
echo "</pre>";
?>
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
       echo "<td><a href='?action=edit&id=".$user['id']."'>edit</a>
       <a href='?action=delete&id=".$user['id']."' >delete</a>
       </td>" ;
      ?>
    </tr>
	<?php } ?>
   
  </tbody>
</table>
<!--end table-->


  <?php } ?>
<!--end fetch all users-->
  
  
  <?php require_once("footer.php"); ?>