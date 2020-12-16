<?php

require_once "connection.php";

if(isset($_REQUEST['update_id']))
{
	try
	{
		$id = $_REQUEST['update_id']; //get "update_id" from index.php page through anchor tag operation and store in "$id" variable

		$select_stmt = $db->prepare('SELECT * FROM tbl_file WHERE id =:id'); //sql select query
		$select_stmt->bindParam(':id',$id);
		$select_stmt->execute();
		$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
	}
	catch(PDOException $e)
	{
		$e->getMessage();
	}

}

if(isset($_REQUEST['btn_update']))
{
	try
	{
		$fname	= $_REQUEST['fname'];
		$lname	= $_REQUEST['lname'];
		$age	= $_REQUEST['age'];	//textbox name "txt_name"

		$image_file	= $_FILES["image"]["name"];
		$type		= $_FILES["image"]["type"];	//file name "txt_file"
		$size		= $_FILES["image"]["size"];
		$temp		= $_FILES["image"]["tmp_name"];

		$path="upload/".$image_file; //set upload folder path

		$directory="upload/"; //set upload folder path for update time previous file remove and new file upload for next use

		if($image_file)
		{
			if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif') //check file extension
			{
				if(!file_exists($path)) //check file not exist in your upload folder path
				{
					if($size < 5000000) //check file size 5MB
					{
						unlink($directory.$row['image']); //unlink function remove previous file
						move_uploaded_file($temp, "upload/" .$image_file);	//move upload file temperory directory to your upload folder
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
				$errorMsg="Upload JPG, JPEG, PNG & GIF File Formate.....CHECK FILE EXTENSION"; //error message file extension
			}
		}
		else
		{
			$image_file=$row['image']; //if you not select new image than previous image sam it is it.
		}

		if(!isset($errorMsg))
		{
			$update_stmt=$db->prepare('UPDATE tbl_file SET fname=:fnamec,lname=:lnamec,age=:agec, image=:imagec WHERE id=:id'); //sql update query
			$update_stmt->bindParam(':id',$id);
			$update_stmt->bindParam(':fnamec',$fname);
			$update_stmt->bindParam(':lnamec',$lname);
			$update_stmt->bindParam(':agec',$age);
			$update_stmt->bindParam(':imagec',$image_file);	//bind all parameter


			if($update_stmt->execute())
			{
				$updateMsg="File Update Successfully.......";	//file update success message
				header("refresh:3;index.php");	//refresh 3 second and redirect to index.php page
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
<title>PHP PDO File Upload Using MySQL</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

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
          <a class="navbar-brand" href="#">Home</a>
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
		if(isset($updateMsg)){
		?>
			<div class="alert alert-success">
				<strong>UPDATE ! <?php echo $updateMsg; ?></strong>
			</div>
        <?php
		}
		?>

			<form method="post" class="form-horizontal" enctype="multipart/form-data">

				<div class="form-group">
				<label class="col-sm-3 control-label"> First Name</label>
				<div class="col-sm-6">
				<input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>" required/>
				</div>
				</div>

								<div class="form-group">
				<label class="col-sm-3 control-label"> Last Name</label>
				<div class="col-sm-6">
				<input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>" required/>
				</div>
				</div>

								<div class="form-group">
				<label class="col-sm-3 control-label"> Age</label>
				<div class="col-sm-6">
				<input type="text" name="age" class="form-control" value="<?php echo $age; ?>" required/>
				</div>
				</div>


				<div class="form-group">
				<label class="col-sm-3 control-label">Profile Image</label>
				<div class="col-sm-6">
				<input type="file" name="image" class="form-control" value="<?php echo $image; ?>"/>
				<p><img src="upload/<?php echo $image; ?>" height="100" width="100" /></p>
				</div>
				</div>


				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9 m-t-15">
				<input type="submit"  name="btn_update" class="btn btn-primary" value="Update">
				<a href="index.php" class="btn btn-danger">Cancel</a>
				</div>
				</div>

			</form>

		</div>

	</div>

	</div>

	</body>
</html>