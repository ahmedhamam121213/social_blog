
  <?php require_once("head.php"); ?>
  <div class="page-header" style="background-image: url('https://images.pexels.com/photos/1559041/pexels-photo-1559041.jpeg?cs=srgb&dl=background-beverage-blank-1559041.jpg&fm=jpg');background-size: cover">
    <div class="filter"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 ml-auto mr-auto">
          <div class="card card-register">
            <h3 class="title mx-auto">Welcome</h3>
            <form class="register-form" action="home.php" method="post" enctype="multipart/form-data" >
              <label>Username</label>
              <input type="text" class="form-control" placeholder="Username" name="username">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password">
              <input class="btn btn-danger btn-block btn-round" type="submit" name="submit" >
            </form>
           
          </div>
        </div>
      </div>
    </div>

  </div>
<?php require_once("footer.php"); ?>