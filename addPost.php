<?php 
session_start();
$user_id = $_SESSION['id'];
//connection of data base
$db = new PDO("mysql:host=localhost;dbname=social_blog", "root", "" , array(PDO::MYSQL_ATTR_INIT_COMMAND =>  "SET NAMES 'UTF8'") );
//add user
if(  isset( $_POST['Add-post'] )  ){
  $title = $_POST['title'];
  $body = $_POST['body'];

  $sql =  $db->prepare( " INSERT INTO posts ( title , body , created ,  user_id ) 
             VALUES (:title,:body,:user_id)" );
  $bindedParams = array( ":title" => $title , ":body" => $body ,":user_id" => $user_id );

  if( $sql->execute( $bindedParams ) ){
    $_SESSION['messege']  = "Post Has Been Saved Succesfully";
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/social_blog/home.php?action=view');
  }         
}
require_once("head.php");
?>
  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
  </div>
<!--start add post-->
  <?php if( isset( $_GET['action'] )  && $_GET['action'] == 'add' ){ ?>

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
            <h2 class="text-center">Add Post</h2>
            <form class="contact-form" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <label>Title</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <!-- <i class="nc-icon nc-single-02"></i> -->
                      </span>
                    </div>
                    <input type="text" name="title" class="form-control" placeholder="Title" required>
                  </div>
                </div>
              </div>
              <label>Body</label>
              <textarea class="form-control" name="body" rows="4" placeholder="Type Your description" required></textarea>
              <div class="row">
                <div class="ml-auto mr-auto">
                  <input type="submit" name="Add-post" class="btn btn-danger btn-lg btn-fill" value="Submit">
                  
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
<!--end add post-->

<!--start edit post-->
<?php if( isset( $_GET['action'] )  && $_GET['action'] == 'edit' && isset( $_GET['id'] ) ){ ?>
  <!--start fetch data by id-->
  <?php 
  $id = $_GET['id'];
  $sql =  $db->prepare(" SELECT * from posts WHERE id = \"$id\"  ");
  $myResult = $sql->execute();
  $foundPost = $sql->fetchAll() ;
  $foundPost =  array_shift($foundPost);

  //start if user click update
if( isset($_POST['edit-post']) ){

  $sql =  $db->prepare( " UPDATE posts SET title = :title , body = :body WHERE id = :id");
  $bindedParams = array( ":title" => $_POST['title'] ,
                         ":body" => $_POST['body'] ,
                         ":id" => $id );
  $sql = $sql->execute( $bindedParams ) ;

  //insert data into data base
  if( $sql ){


    $_SESSION['messege']  = "user has been updated Sussecfully";
    header('Location:http://'.$_SERVER['HTTP_HOST'].'/social_blog/home.php?action=view');
  }else{
    echo  $_SESSION['messege'] = "something went wrong";
  }
}
//end if user click update
  ?>
  <!--end fetch data by id-->
  <div class="main">
    <div class="section landing-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto">
            <h2 class="text-center">Edit Post</h2>
            <form class="contact-form" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <label>Title</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <!-- <i class="nc-icon nc-single-02"></i> -->
                      </span>
                    </div>
                    <input type="text" name="title" class="form-control" placeholder="Title" required value="<?php if( isset( $foundPost['title'] ) ){ echo $foundPost['title']; } ?>">
                  </div>
                </div>
              </div>
              <label>Body</label>
              <textarea class="form-control" name="body" rows="4" placeholder="Type Your description" required><?php if( isset( $foundPost['body'] ) ){ echo $foundPost['body']; } ?></textarea>
              <div class="row">
                <div class="ml-auto mr-auto">
                  <input type="submit" name="edit-post" class="btn btn-danger btn-lg btn-fill" value="Submit">
                  
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<!--start edit post-->
<?php require_once("footer.php"); ?>