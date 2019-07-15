<?php 
  session_start();
  //connection of data base
  require_once("con.php");
  if(  isset( $_POST['submit'] )  ){

  $username = $_POST['username'];
$password = $_POST['password']; 
//fetch info of logged user

$sql =  $db->prepare(" SELECT * from users WHERE username = \"$username\"  and password = \"$password\" ");
$myResult = $sql->execute();
$count = $sql->rowCount();
if( $count != 0 ){ 
  $foundUser = $sql->fetchAll() ;
  $foundUser =  array_shift($foundUser);
  $_SESSION['id'] = $foundUser['id'];
  header('Location:home.php?action=view&id=' . $_SESSION['id']);
 }else{
   $errorMsg = "Invalid Login";
 }


 }
  ?>
 <!DOCTYPE html>

 <html lang="en">
 
 <head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
   <title>
     login
   </title>
   <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
   <!--     Fonts and icons     -->
   <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
   <!-- CSS Files -->
   <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
   <link href="assets/css/paper-kit.css?v=2.2.0" rel="stylesheet" />
   <!-- CSS Just for demo purpose, don't include it in your project -->
   <link href="assets/demo/demo.css" rel="stylesheet" />
 </head>
 
 <body class="register-page sidebar-collapse">
 

  <div class="page-header" style="background-image: url('https://images.pexels.com/photos/1559041/pexels-photo-1559041.jpeg?cs=srgb&dl=background-beverage-blank-1559041.jpg&fm=jpg');background-size: cover">
    <div class="filter"></div>
    <div class="container" style="margin-top:0">
      <div class="row">
        <div class="col-lg-4 ml-auto mr-auto">
          <div class="card card-register">
            <h3 class="title mx-auto">Social Blog</h3>
            <form class="register-form"  method="post" enctype="multipart/form-data" >
              <label>Username</label>
              <input type="text" class="form-control" placeholder="Username" name="username" value="ahmed">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password" value="123456">
              <input class="btn btn-danger btn-block btn-round" type="submit" name="submit" >
              <br>
              <?php if( isset($errorMsg) ){ echo "<p class='text-center'><b>" .$errorMsg. "</b></p>"; } ?>
            </form>
           
          </div>
        </div>
      </div>
    </div>

  </div>
<?php require_once("footer.php"); ?>