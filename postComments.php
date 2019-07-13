<?php 
session_start();
if( isset($_SESSION['id']) ){


  $user_id = $_SESSION['id'];
  //connection of data base
  $db = new PDO("mysql:host=localhost;dbname=social_blog", "root", "" , array(PDO::MYSQL_ATTR_INIT_COMMAND =>  "SET NAMES 'UTF8'") );
  //fetch user details
  $sql =  $db->prepare(" SELECT * from users WHERE id = " . $_SESSION['id'] );
  $myResult = $sql->execute();
  $foundUser = $sql->fetchAll() ;
  $foundUser =  array_shift($foundUser);
  require_once("head.php");
  ?>
    <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
      <div class="filter"></div>
    </div>

    <div class="section profile-content">
        <div class="container">
            <div class="owner">
                <div class="avatar">
                    <img src="<?php echo $foundUser['image_url']; ?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                </div>
            </div>

            <div class="name text-center" >
                <h4 class="title"><?php echo $foundUser['username']; ?>
                <br />
                </h4>
            
            </div>
        </div>
    </div>    

  
  <!--start edit post-->
  <?php if( isset( $_GET['action'] )  && $_GET['action'] == 'view' && isset( $_GET['postId'] ) ){ ?>
    <!--start fetch data by id-->
    <?php 
    $postId = $_GET['postId'];
    $sql =  $db->prepare(" SELECT * from posts WHERE id = \"$postId\"  ");
    $myResult = $sql->execute();
    $foundPost = $sql->fetchAll() ;
    $foundPost =  array_shift($foundPost);
    echo "<pre>";
    print_r($foundPost);
    echo "</pre>";

    

    echo "<h1>comments details</h1>";
      $commentsDetails = $db->prepare(" SELECT users.image_url as image , users.username as user , comments.title as comment FROM users JOIN comments ON comments.user_id = users.id 
        WHERE comments.post_id = \"$postId\" " );
     $result = $commentsDetails->execute();
    $details = $commentsDetails->fetchAll();
    

    foreach ($details as $record) {
      echo "<p>imgUrl = <b>" .$record['image']. "</b><p>";
      echo "<p>imgUrl = <b>" .$record['user']. "</b><p>";
      echo "<p>imgUrl = <b>" .$record['comment']. "</b><p>";
      echo "<hr>";
    }
    ?>


    <!--end fetch data by id-->

  <?php } ?>
  <!--start edit post-->
  <?php require_once("footer.php"); 

}else{
  header('Location:http://'.$_SERVER['HTTP_HOST'].'/social_blog/login.php ');
}
