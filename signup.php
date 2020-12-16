<?php
  session_start();
//Database Configuration File
include('config.php');
error_reporting(0);

  if(isset($_POST['login']))
  {

    // Getting username/ email and password
    $uname=$_POST['username'];
    $password=$_POST['password'];
    // Fetch data from database on the basis of username/email and password
    $sql ="SELECT UserName,UserEmail,LoginPassword,role FROM userdata WHERE (UserName=:usname || UserEmail=:usname)";
    $query= $db -> prepare($sql);
    $query-> bindParam(':usname', $uname, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach ($results as $row) {
$hashpass=$row->LoginPassword;
$role=$row->role;

}

//verifying Password

//verifying Password
if (password_verify($password, $hashpass) && $role == "Admin") {
$_SESSION['userlogin']=$_POST['username'];
    echo "<script type='text/javascript'> document.location = 'admin/index.php'; </script>";
}



elseif (password_verify($password, $hashpass) && $role == "User") {
      $_SESSION['userlogin']=$_POST['username'];
    echo "<script type='text/javascript'> document.location = 'user/index.php'; </script>";
}



elseif (password_verify($password, $hashpass) && $role == "suadmin") {
    $_SESSION['userlogin']=$_POST['username'];
    echo "<script type='text/javascript'> document.location = 'superadmin/index.php'; </script>";
}



else{echo "<script>alert('Wrong Password');</script>";}
}
//if username or email not found in database
else{
echo "<script>alert('User not registered with us');</script>";
  }



}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>laketruth | Login form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <div id="login-overlay" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Login Form</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-6">
                      <div class="well">
                          <form id="loginForm" method="post">
                              <div class="form-group">
                                  <label for="username" class="control-label">Username / Email id</label>
                                  <input type="text" class="form-control" id="username" name="username"  required="" title="Please enter you username or Email-id" placeholder="email or username" >
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" required="" title="Please enter your password">
                                  <span class="help-block"></span>
                              </div>

                              <button type="submit" class="btn btn-success btn-block" name="login">Login</button>
                          </form>
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <p class="lead">Register now for <span class="text-success">FREE</span></p>
                      <ul class="list-unstyled" style="line-height: 2">
                          <li><span class="fa fa-check text-success"></span> 1</li>
                          <li><span class="fa fa-check text-success"></span> 2</li>
                          <li><span class="fa fa-check text-success"></span> 3</li>
                          <li><span class="fa fa-check text-success"></span> 4</li>
                          <li><span class="fa fa-check text-success"></span> 5</li>

                      </ul>
                      <p><a href="reg.php" class="btn btn-info btn-block">Yes please, register now!</a></p>
                  </div>
              </div>
          </div>
      </div>
  </div>
<script type="text/javascript">

</script>
</body>
</html>
