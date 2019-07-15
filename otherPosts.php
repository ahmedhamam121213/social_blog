<?php 
ob_start();
session_start();
if( isset($_SESSION['id']) ){

//connection of data base
require_once("con.php");
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
      <a href="addPost.php?action=add" class="btn btn-primary"> Add Post </a>
      <br>
      <?php if( isset( $_SESSION['messege'] ) ){ ?>
      <h4 class="text-center">
          <div class="alert alert-success">
          <div class="container">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="nc-icon nc-simple-remove"></i>
              </button>
              <span style="font-size: 20px;font-weight: 400;"
              ><?php  echo $_SESSION['messege']; ?> </span>
          </div>
          </div>
      </h4>
      <?php } ?>
      <br>
        <!--start fetch post of user-->
      <?php
      if( isset( $foundUser['id'] ) ){
        $id = $foundUser['id']; 
        $sql =  $db->prepare(" SELECT * from posts WHERE user_id != \"$id\" ORDER BY id DESC ");
        $myResult = $sql->execute();
        $postsResult = $sql->fetchAll() ;?>
          
        <div class="row">
          <?php foreach( $postsResult as $post ){ ?>
          <div class="col-md-4 post-container">
            <!--start blog post-->
            <div class="card" >
              <img class="card-img-top" src="<?php echo $post['picture_url']; ?>" alt="Card image cap">
              <div class="card-body comment-container">
              <?php //fix big strength of body 
                  if( strlen( $post['title'] ) > 70 ){
                    $title = substr( $post['title'] ,0 , 70 ) . '..........' ; 
                      
                  }else{
                    $title = $post['title'];
                  } ?>
                <h5 style="font-weight:500" class="card-title"><?php echo $title;
               
                 //fix big strength of body 
                  if( strlen( $post['body'] ) > 70 ){
                    $body = substr( $post['body'] ,0 , 70 ) . '..........' ; 
                      
                  }else{
                    $body = $post['body'];
                  } ?></h5>
                
                
                <p class="card-text"><?php echo $body  ; ?></p>
                  <!--start require comments.php-->
                  <?php require_once("comments.php"); ?>
                  <!--end require comments.php-->
                  <!--start check if user submit comment-->
                  <?php
                  $sql =  $db->prepare(" SELECT * from comments WHERE post_id = " . $post['id'] );
                  $myResult = $sql->execute();
                  $count = $sql->rowCount();
                  $comments = $sql->fetchAll();
                  
                  
                  if( count($comments) > 0 ){
                    $lastComment = $comments[count($comments) - 1]['title'];
                    
                    if( strlen($lastComment) > 17 ){
                       $lastComment = substr( $lastComment , 0 , 17 ) . '...' ; 
                        
                    }
                    
                    $lastId = $comments[count($comments) - 1]['user_id'];
                    //start fetch image url of the comment of user
                   $sql = $db->prepare("SELECT users.image_url FROM users JOIN comments ON comments.user_id = users.id WHERE comments.title = \"$lastComment\" AND comments.user_id = $lastId " );
                       $myResult = $sql->execute();
                        $foundPost = $sql->fetchAll() ;
                        $foundPost =  array_shift($foundPost);
                    
                   
                      
                    echo "<div style='position:relative'>";
                    echo "<p class='btn btn-info btn-round' 
                    style='text-transform: lowercase;
                    background-color: #51cbce;
                    border-color: #fff;
                    font-weight: normal;
                    color: #fff;
                    width: 80%;
                    text-align:left;
                    font-size: 15px;'>";
                    echo "<img src=".$foundPost['image_url']." class='img-comment'>";          
                    echo $lastComment. "</p>";
                    echo "<span class='down-arrow'></span>";
                    echo "</div>";
                  }
                  

                  ?>
                  

                  <!--end check if user submit comment-->
                <p style="text-align: right;"><a  class="comment-number" style="padding:0" href="postComments.php?action=view&postId=<?php echo $post['id']; ?>">
                <?php  if( isset( $count ) ){ echo $count . " Comment";} ?></a></p>
              </div>
                <div class="card-body new_anchor_style">
                <a href="addPost.php?action=view&id=<?php echo $post['id']; ?>" class="card-link">View</a>
                <a href="addPost.php?action=edit&id=<?php echo $post['id']; ?>" class="card-link">Edit</a>
                <a href="?action=delete&id=<?php echo $post['id']; ?>" class="card-link" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <form method="post" >
                  
                    <div class="input-group">
                    <input type="text" class="form-control" name="title" placeholder="Write a Comment">
                    <div class="input-group-append">
                <span class="input-group-text"><i class="fa fa-comments" aria-hidden="true"></i></span>
              </div>
                    <input type="hidden" class="form-control" name="post_id" value="<?php echo $post['id'];  ?>" >
                    <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['id'];  ?>" >
                    <input type="submit" name="add-comment" value="submit" style="display:none">
                  </div>
                  
                  </form>
                  
                </li>
              </ul>
            
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
    <?php if( isset( $_GET['action'] )  && $_GET['action']== 'delete' ){
      $id = $_GET['id'];

      if( $id >= 0  ){
    
        $sql =$db->prepare(" DELETE FROM posts WHERE id = :id ");
        $sql->execute( array( ":id" => $id ) );
        $_SESSION['messege']  = "post has been deleted successfully";
        header('Location:home.php?action=view');
    }} ?>  
    <!--start edit blog post-->

    

    
    
  </div>
</div>
<?php require_once("footer.php");

}else{
header('Location:index.php ');
}
ob_end_flush();