<?php



  if( isset( $_POST['add-comment'] ) ){

             
              
              $title   = $_POST['title'];
              $post_id = $_POST['post_id'];
              $user_id = $_POST['user_id'];
            
              $sql =  $db->prepare( " INSERT INTO comments ( title , post_id ,  user_id ) 
                         VALUES (:title,:post_id,:user_id)" );
              $bindedParams = array( ":title" => $title , ":post_id" => $post_id ,":user_id" => $user_id );
            
              if( $sql->execute( $bindedParams ) ){
                $_SESSION['messege']  = "Comment Has Been Saved Succesfully";
                
                
              }  else{

                $_SESSION['messege']  = "somthing went wrong";
                
              }  

   } 
?>
     
