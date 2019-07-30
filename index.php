<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Simple CRUD</title>
	<link rel="stylesheet" href="assets/bootstrap.4.3.1.min.css">
	<link rel="stylesheet" href="assets/style.css">
	</head>
	<body>
		<!-- include process.php file -->
		<?php require_once 'process.php'; ?>

		<!-- get session data -->
		<?php if (isset($_SESSION['message'])) :?>
			<!-- message after delete/update action -->
			<div class="alert alert-<?=$_SESSION['msg_type'];?>">
		<?php 
			echo $_SESSION['message'];
			unset($_SESSION['message']);
			session_destroy();
		 ?>
			</div>
		<?php endif; ?>
		<div class="container">
			<h2 class="text-center">PHP CRUD</h2>
			<div class="row">
				<div class="col-sm-12">
					<h2>User Data</h2>
					<hr>
					<form action="process.php" method="POST">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th>Name</th>
								<th>Location</th>
								<th>E-mail</th>
								<th>Password (Encrypted)</th>
								<th colspan="2">Actions</th>
							</tr>
						</thead>
						<tbody>	
		<?php 
			// get data form database to show
			$result = $mysqli->query("SELECT * FROM data");
		 ?>
		<?php if (mysqli_num_rows($result) > 0): 
				while ($row = $result->fetch_assoc()):?>
							<tr>
								<td><?= $row['name'];?></td>
								<td><?= $row['location'];?></td>
								<td><?= $row['email'];?></td>
								<td><?= $row['password'];?></td>
								<td>
									<!-- //get id with url  -->
									<a class="btn btn-info" href="index.php?edit=<?= $row['id']; ?>">Edit</a>
									<a class="btn btn-danger" href="process.php?delete=<?= $row['id']; ?>">Delete</a>
								</td>
							</tr>
		<?php endwhile;
				else:?>
					<!-- show message if no data-->
							<tr>
								<td colspan="6" class="text-center bg-light"><h3 class="text-muted">Not Data To Show!</h3></td>
							</tr>
		<?php
			endif;?>
						</tbody>
					</table>
					</form> 
				</div>
				<div class="col-sm-6 offset-sm-3">
		<?php if (isset($edit_mode)): ?>
						<h2>Update</h2>
		<?php else: ?>
						<h2>Register</h2>
		<?php endif ?>
					<hr>
					<form action="process.php" method="post">
						<!-- to get individual profile id  -->
						<input type="hidden" name="id" value="<?php if(isset($id)) echo $id ;?>">
						<div class="form-group">
							<input type="text" class="form-control" name="name" value="<?php if(isset($name)) echo $name;?>" placeholder="Enter your name">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="location" value="<?php if(isset($location)) echo $location;?>" placeholder="Enter your location">
						</div>
						<div class="form-group">
							
							<input type="text" class="form-control" name="email" value="<?php if(isset($email)) echo $email;?>" placeholder="Enter your email">
						</div>
						<div class="form-group">
							
							<input type="password" class="form-control" name="password" value="<?php if(isset($password)) echo "Enter your new password";?>" placeholder="Enter your password">
						</div>
						<div class="form-group">
		<?php if (isset($submit_btn)): ?>
								<button type="submit" class="btn btn-info btn-full" name="update">Update</button>
		<?php else: ?>
								<button type="submit" class="btn btn-primary btn-full" name="save">Submit</button>
		<?php endif; ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
	</html>
	<!-- this is first try of very simple PHP CRUD app  -->