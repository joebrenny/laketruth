
<!DOCTYPE html>


<?php //require 'config.php'; ?>

<html lang="en" dir="ltr">
  <head>
    <head>
      <title>Lake Truth</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
  </head>

<?php include 'parts/navbar.php'; ?>


<body>

  <div class="container">

    <h2>Create account on this page !!!!!</h2>
    <form class="form-horizontal" action="includes/signup_inc.php" method="post" enctype="multipart/form-data" >
       
       <div class="form-group">
        <label class="control-label col-sm-2" for="email">FullName</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="email" value="" placeholder="Enter Full Name" name="name" required>
        </div>
      </div>     


      <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="email" value="" placeholder="Enter email" name="email" required>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="UserName">UserName</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="username"  placeholder="Enter Username" name="uid" >
          
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Password:</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Confirm Password:</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="pwd2" placeholder="Confirm Password" name="pwdrepeat">
        </div>
      </div>
     
    <!--  <div class="form-group">
        <label class="control-lab col-sm-2" for="pwdconf" > </lablel>
      </div>  -->
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div class="checkbox">
            <label><input type="checkbox" name="remember"> Remember me</label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" name="submit" class="btn btn-default">Submit</button>
        </div>
      </div>
    </form>
        <p>
      Already a member? <a href="login.php">Sign in</a>
    </p>
  </div>
</body>
</html>
