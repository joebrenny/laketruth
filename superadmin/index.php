
<?php

session_start();
include('../config.php');
if(strlen($_SESSION['userlogin'])==0)
{
header('location:../index.php');
}
else{


	//require_once "connection.php";

	if(isset($_REQUEST['delete_id']))
	{
		// select image from db to delete
		$id=$_REQUEST['delete_id'];	//get delete_id and store in $id variable

		$select_stmt= $db->prepare('SELECT * FROM tbl_file WHERE id =:id');	//sql select query
		$select_stmt->bindParam(':id',$id);
		$select_stmt->execute();
		$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
		unlink("upload/".$row['image']); //unlink function permanently remove your file

		//delete an orignal record from db
		$delete_stmt = $db->prepare('DELETE FROM tbl_file WHERE id =:id');
		$delete_stmt->bindParam(':id',$id);
		$delete_stmt->execute();

		header("Location:http://joebrenny.com/final_project/superadmin/index.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>Lake Truth</title>

<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="../js/jquery-1.12.4-jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>

</head>

	<body>


	<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="">Lake Truth</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="../index.php">Back to Home</a></li>
          </ul>
<!--add the log out button here -->

        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<div class="wrapper">

	<div class="container">
			<div align="center"><h1><span class="label label-danger">Super User</span></h1></div>
		<div class="col-lg-12">
			<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <h3><a href="add.php"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Lake Data</a></h3>         <p align="right">
                                        <a href="../logout.php" class="btn btn-info btn-lg">
                                          <span class="glyphicon glyphicon-log-out"></span> Log out
                                        </a>
                                      </p>
            </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Lake Name</th>
                                            <th>Comments</th>
                                            <th>Rating 0-100</th>
                                            <th>File</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$select_stmt=$db->prepare("SELECT * FROM tbl_file");	//sql select query
									$select_stmt->execute();
									while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
									{
									?>
                                        <tr>
                                            <td><?php echo $row['fname']; ?></td>
                                            <td><?php echo $row['lname']; ?></td>
                                            <td><?php echo $row['age']; ?></td>
                                            <td><img src="../superadmin/upload/<?php echo $row['image']; ?>" width="100px" height="60px"></td>
                                            <td><a href="edit.php?update_id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a></td>
                                            <td><a href="index.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                                        </tr>
                                    <?php
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

		</div>

	</div>

	</div>

	</body>
</html>
<?php } ?>
