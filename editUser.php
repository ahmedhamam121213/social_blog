
<?php 
session_start();
if( isset($_SESSION['id']) ){

//connection of data base
$db = new PDO("mysql:host=localhost;dbname=social_blog", "root", "" , array(PDO::MYSQL_ATTR_INIT_COMMAND =>  "SET NAMES 'UTF8'") );
//fetch user data by id
$id = $_GET['id'];
$sql =  $db->prepare(" SELECT * from users WHERE id = \"$id\"  ");
$myResult = $sql->execute();
$foundUser = $sql->fetchAll() ;
$foundUser =  array_shift($foundUser);
//start if user click update
if( isset($_POST['edit-user']) ){

  $sql =  $db->prepare( " UPDATE users SET username = :username , password = :password , image_url = :image_url WHERE id = :id");
  $bindedParams = array( ":username" => $_POST['username'] ,
                         ":password" => $_POST['password'] ,
                         ":image_url" => $_POST['image_url'] ,
                         ":id" => $id );
  $sql = $sql->execute( $bindedParams ) ;

  //insert data into data base
  if( $sql ){


    $_SESSION['messege']  = "user has been updated Sussecfully";
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/social_blog/user.php');
  }else{
    echo  $_SESSION['messege'] = "something went wrong";
  }
}
//end if user click update



require_once("head.php");
?>
  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
  </div>
<!--start add user-->
  <?php if( isset( $_GET['action'] )  && $_GET['action']= 'edit' && isset( $_GET['id'] ) ){ ?>


  <div class="section profile-content"  style="background:#fff">
    <div class="container">
      <div class="owner">
        <div class="avatar">
          <img src="<?php  if( isset($foundUser['image_url']) ){ echo $foundUser['image_url']; } ?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
        </div>
      </div>
      
    </div>
  </div>
  <div class="main">
    <div class="section landing-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto">
            <h2 class="text-center">Edit User</h2>
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
                    <input type="text" name="username" class="form-control" placeholder="Username" required value="<?php  if( isset($foundUser['username']) ){ echo $foundUser['username']; } ?>">
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
                    <input type="text" name="password" class="form-control" placeholder="Password" required value="<?php  if( isset($foundUser['password']) ){ echo $foundUser['password']; } ?>">
                  </div>
                </div>
              </div>
              <label>Image Url</label>
              <textarea class="form-control" name="image_url" rows="4" placeholder="Type Your Image Url" required ><?php  if( isset($foundUser['image_url']) ){ echo $foundUser['image_url']; } ?></textarea>
              <div class="row">
                <div class="ml-auto mr-auto">
                  <input type="submit" name="edit-user" class="btn btn-danger btn-lg btn-fill" value="Submit">
                  
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

<?php require_once("footer.php");     
}else{
header('Location:http://'.$_SERVER['HTTP_HOST'].'/social_blog/login.php ');
}
