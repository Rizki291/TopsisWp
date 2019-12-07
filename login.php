<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="web/css/login.css">
</head>
	<body>
	<div class="login">
		<div class="login-screen">
			<div class="app-title">
				<h1>Login</h1>
			</div>
			<form action="" method="post">
			<div class="login-form">
				<div class="control-group">
					<input type="text" class="login-field" value="" placeholder="username" id="login-name" name="user">
					<label class="login-field-icon fui-user" for="login-name"></label>
				</div>

				<div class="control-group">
					<input type="password" class="login-field" value="" placeholder="password" id="login-pass" name="pass">
					<label class="login-field-icon fui-lock" for="login-pass"></label>
				</div>

				<input type="submit" name="btn" class="btn btn-primary btn-large btn-block" value="login">
			</div>
			</form>
			<?php
			if(isset($_POST['btn'])){
				include 'crud/koneksi.php';
				$query = mysqli_query($koneksi,"select * from tbl_admin where username='".$_POST['user']."' and password='".$_POST['user']."'");
				$nums = mysqli_num_rows($query);
				if ($nums > 0) {
					header('location:admin/form_home.php');
				}else{
					echo "<script>alert('Login Gagal')</script>";
				}
			}
			?>
		</div>
	</div>
</body>
</body>
</html>