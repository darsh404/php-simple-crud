<?php 
	session_start();

	require_once './db.inc.php';

	// Save Data
	if (isset($_POST['save'])) {
		trim($_POST['name']);
		if (!empty($_POST['name'])) {
			# code...
		
		$name = $_POST['name'];
		$location = $_POST['location'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);

		$mysqli->query("INSERT INTO data (name , location, email, password) VALUES('$name', '$location', '$email', '$password') ") or die($mysqli->error);

		$_SESSION['message'] = 'Record has been saved';
		$_SESSION['msg_type'] = 'success';

		header("location: index.php");
		}else{
		
		$_SESSION['message'] = 'Please fill the form!';
		$_SESSION['msg_type'] = 'danger';
		
		header("location: index.php");
		}

	};

	// Delete Data
	if (isset($_GET['delete'])) {
		$id = $_GET['delete'];

		$mysqli->query("DELETE FROM data WHERE id = $id") or die($mysqli->error());

		$_SESSION['message'] = "Record has been deleted";
		$_SESSION['msg_type'] = 'danger';


		header("location: index.php");
	};


	// Edit Button Trigger
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$submit_btn = true;
		$edit_mode = true;
		$result = $mysqli->query("SELECT * FROM data WHERE id = $id") or die($mysqli->error());

		if ($result) {
			$row = $result->fetch_array();
			$name = $row['name'];
			$location = $row['location'];
			$email = $row['email'];
			$password = $row['password'];
		}

	}

	// Update Data
	if (isset($_POST['update']) ) {
		$id = $_POST['id'];
		$name_update = $_POST['name'];
		$location_update = $_POST['location'];
		$email_update = $_POST['email'];
		$password = md5($_POST['password']);

		$mysqli->query("UPDATE data SET name='$name_update', location='$location_update', email='$email_update', password='$password' WHERE id = $id ") or die($mysqli->error);

		$_SESSION['message'] = "Record has been updated";
		$_SESSION['msg_type'] = 'warning';

		header("location: index.php");
	}