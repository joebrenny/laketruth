<?php

require_once "../config.php";

if(isset($_REQUEST['btn_insert']))
{
	try
	{
		$fname	= $_REQUEST['fname'];
		$lname	= $_REQUEST['lname'];
		$age	= $_REQUEST['age'];
		//$image	= $_REQUEST['image'];	//textbox name "txt_name"

		$image_file	= $_FILES["image"]["name"];
		$type		= $_FILES["image"]["type"];	//file name "txt_file"
		$size		= $_FILES["image"]["size"];
		$temp		= $_FILES["image"]["tmp_name"];

		$path="upload/".$image_file; //set upload folder path

		if(empty($fname)){
			$errorMsg="Please Enter Name";
		}
		else if(empty($image_file)){
			$errorMsg="Please Select Image";
		}
		else if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif') //check file extension
		{
			if(!file_exists($path)) //check file not exist in your upload folder path
			{
				if($size < 5000000) //check file size 5MB
				{
					move_uploaded_file($temp, "../superadmin/upload/" .$image_file); //move upload file temperory directory to your upload folder
				}
				else
				{
					$errorMsg="Your File To large Please Upload 5MB Size"; //error message file size not large than 5MB
				}
			}
			else
			{
				$errorMsg="File Already Exists...Check Upload Folder"; //error message file not exists your upload folder path
			}
		}
		else
		{
			$errorMsg="Upload JPG , JPEG , PNG & GIF File Formate.....CHECK FILE EXTENSION"; //error message file extension
		}

		if(!isset($errorMsg))
		{
			$insert_stmt=$db->prepare('INSERT INTO tbl_file(fname,lname,age,image) VALUES(:fname,:lname,:age,:image)'); //sql insert query
			$insert_stmt->bindParam(':fname',$fname);
			$insert_stmt->bindParam(':lname',$lname);
			$insert_stmt->bindParam(':age',$age);
			$insert_stmt->bindParam(':image',$image_file);	  //bind all parameter

			if($insert_stmt->execute())
			{
				$insertMsg="File Upload Successfully........"; //execute query success message
				header("refresh:3;index.php"); //refresh 3 second and redirect to index.php page
			}
		}
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>PHP PDO File Upload Using MySQL:ADD</title>

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
          <a class="navbar-brand" href="index.php">Lake Truth</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Back to Home</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<div class="wrapper">

	<div class="container">

		<div class="col-lg-12">

		<?php
		if(isset($errorMsg))
		{
			?>
            <div class="alert alert-danger">
            	<strong>WRONG ! <?php echo $errorMsg; ?></strong>
            </div>
            <?php
		}
		if(isset($insertMsg)){
		?>
			<div class="alert alert-success">
				<strong>SUCCESS ! <?php echo $insertMsg; ?></strong>
			</div>
        <?php
		}
		?>

			<form method="post" class="form-horizontal" enctype="multipart/form-data">

				<div class="form-group">
				<label class="col-sm-3 control-label">Lake Name</label>
				<div class="col-sm-6">
				<input type="text" name="fname" class="form-control" placeholder="enter Lake Name" />
				</div>
				</div>

				<div class="form-group">
				<label class="col-sm-3 control-label">Comments</label>
				<div class="col-sm-6">
				<input type="text" name="lname" class="form-control" placeholder="enter comments about lake" />
				</div>
				</div>

								<div class="form-group">
				<label class="col-sm-3 control-label">Rate (1-100)</label>
				<div class="col-sm-6">
				<input type="text" name="age" class="form-control" placeholder="rate lake 1-100" />
				</div>
				</div>


				<div class="form-group">
				<label class="col-sm-3 control-label">Lake Image</label>
				<div class="col-sm-6">
				<input type="file" name="image" class="form-control" />
				</div>
				</div>


				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9 m-t-15">
				<input type="submit"  name="btn_insert" class="btn btn-success " value="Insert">
				<a href="index.php" class="btn btn-danger">Cancel</a>
				</div>
				</div>

			</form>

		</div>

	</div>

	</div>

	</body>
</html>
