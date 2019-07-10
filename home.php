
<?php 
session_start();
//connection of data base
$db = new PDO("mysql:host=localhost;dbname=social_blog", "root", "" , array(PDO::MYSQL_ATTR_INIT_COMMAND =>  "SET NAMES 'UTF8'") );

//fetch info of logged user

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
        <div class="name">
          <h4 class="title"><?php echo $foundUser['username']; ?>
            <br />
          </h4>
        
        </div>
      </div>

      <!--start view blog posts-->
      <?php if( isset( $_GET['action'] )  && $_GET['action']== 'view' ){ ?>
        <a href="addPost.php?action=add" class="btn btn-primary"> Add Post </a><br><br><br>
         <!--start fetch post of user-->
        <?php
        if( isset( $foundUser['id'] ) ){
          $id = $foundUser['id']; 
          $sql =  $db->prepare(" SELECT * from posts WHERE user_id = \"$id\"  ");
          $myResult = $sql->execute();
          $postsResult = $sql->fetchAll() ;?>
            
          <div class="row">
            <?php foreach( $postsResult as $post ){ ?>
            <div class="col-md-4">
              <!--start blog post-->
              <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://html.crumina.net/html-olympus/img/post2.jpg" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $post['title']; ?></h5>
                  <p class="card-text"><?php echo $post['body']; ?></p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><?php echo $post['created']; ?></li>
                </ul>
                <div class="card-body">
                  <a href="addPost.php?action=edit&id=<?php echo $post['id']; ?>" class="card-link">Edit Post</a>
                  <a href="#" class="card-link">Delete Post</a>
                </div>
              </div>
              <!--end blog post-->
            </div>
            <?php } ?>
          </div>

       <?php }
        
        
        ?>
        <!--end fetch posts of user--> 
      <?php } ?>  
      <!--start view blog posts-->

      <!--start edit blog post-->
      <?php if( isset( $_GET['action'] )  && $_GET['action']== 'edit' ){ ?>
      <h4>edit</h4>  
      <?php } ?>  
      <!--start edit blog post-->

      <!--start edit blog post-->
      <?php if( isset( $_GET['action'] )  && $_GET['action']== 'delete' ){ ?>
      <h4>delete</h4>  
      <?php } ?>  
      <!--start edit blog post-->

     

      
      
    </div>
  </div>
  <?php require_once("footer.php"); ?>