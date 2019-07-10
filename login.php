
  <?php 
  session_start();
  //connection of data base
  $db = new PDO("mysql:host=localhost;dbname=social_blog", "root", "" , array(PDO::MYSQL_ATTR_INIT_COMMAND =>  "SET NAMES 'UTF8'") );
 if(  isset( $_POST['submit'] )  ){

  $username = $_POST['username'];
$password = $_POST['password']; 
//fetch info of logged user

$sql =  $db->prepare(" SELECT * from users WHERE username = \"$username\"  and password = \"$password\" ");
$myResult = $sql->execute();
if( $myResult ){ 
  $foundUser = $sql->fetchAll() ;
  $foundUser =  array_shift($foundUser);
  $_SESSION['id'] = $foundUser['id'];
  header('Location:http://'.$_SERVER['HTTP_HOST'].'/social_blog/home.php?action=view&id=' . $_SESSION['id']);
 }else{
   $errorMsg = "Invalid Login";
 }


 }
  
  require_once("head.php");
  
  ?>
  <div class="page-header" style="background-image: url('https://images.pexels.com/photos/1559041/pexels-photo-1559041.jpeg?cs=srgb&dl=background-beverage-blank-1559041.jpg&fm=jpg');background-size: cover">
    <div class="filter"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 ml-auto mr-auto">
          <div class="card card-register">
            <h3 class="title mx-auto">Welcome</h3>
            <form class="register-form"  method="post" enctype="multipart/form-data" >
              <label>Username</label>
              <input type="text" class="form-control" placeholder="Username" name="username">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password">
              <input class="btn btn-danger btn-block btn-round" type="submit" name="submit" >
              <?php if( isset($errorMsg) ){ echo "<p>" .$errorMsg. "</p>"; } ?>
            </form>
           
          </div>
        </div>
      </div>
    </div>

  </div>
<?php require_once("footer.php"); ?>