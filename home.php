
<?php require_once("head.php"); ?>
  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
  </div>
  <div class="section profile-content">
    <div class="container">
      <div class="owner">
        <div class="avatar">
          <img src="assets/img/faces/joe-gardner-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
        </div>
        <div class="name">
          <h4 class="title"><?php if( isset( $_POST['submit'] ) ){ echo $_POST['username']; } ?>
            <br />
          </h4>
        
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <!--start blog post-->
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="https://html.crumina.net/html-olympus/img/post2.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Post title</h5>
              <p class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">7 HOURS AGO</li>
            </ul>
            <div class="card-body">
              <a href="#" class="card-link">Comment here</a>
            </div>
          </div>
          <!--end blog post-->
        </div>

        <div class="col-md-4">
          <!--start blog post-->
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="https://html.crumina.net/html-olympus/img/post2.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Post title</h5>
              <p class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">7 HOURS AGO</li>
            </ul>
            <div class="card-body">
              <a href="#" class="card-link">Comment here</a>
            </div>
          </div>
          <!--end blog post-->
        </div>

        <div class="col-md-4">
          <!--start blog post-->
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="https://html.crumina.net/html-olympus/img/post2.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Post title</h5>
              <p class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">7 HOURS AGO</li>
            </ul>
            <div class="card-body">
              <a href="#" class="card-link">Comment here</a>
            </div>
          </div>
          <!--end blog post-->
        </div>
      </div>

     

      
      
    </div>
  </div>
  <?php require_once("footer.php"); ?>