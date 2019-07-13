
<?php 
session_start();
if( isset($_SESSION['id']) ){

//connection of data base
$db = new PDO("mysql:host=localhost;dbname=social_blog", "root", "" , array(PDO::MYSQL_ATTR_INIT_COMMAND =>  "SET NAMES 'UTF8'") );
//add user
if(  isset( $_POST['Add-user'] )  ){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $image_url = $_POST['image_url'];

  $sql =  $db->prepare( " INSERT INTO users ( username , password , image_url ) 
             VALUES (:username,:password,:image_url)" );
  $bindedParams = array( ":username" => $username , ":password" => $password ,":image_url" => $image_url );

  if( $sql->execute( $bindedParams ) ){
    $_SESSION['messege']  = "User Has Been Saved Succesfully";
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/social_blog/user.php');
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

<!--start edit user-->
  <?php if( isset( $_GET['action'] )  && $_GET['action']= 'edit' && isset( $_GET['id'] ) ){ ?>
   <h1>edit user</h1> 
  <?php } ?>  
<!--start edit user-->

<?php require_once("footer.php");
}else{
header('Location:http://'.$_SERVER['HTTP_HOST'].'/social_blog/login.php ');
}
