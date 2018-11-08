<?php include('include/header.php'); ?>
<div class="wrap">
	<div id="content">
		<div id="main">
			<div class="full_w">
				<form name="test" method="post">
					<label for="username">Username:</label>
					<input id="username" name="username" class="text" />
					<label for="password">Password:</label>
					<input id="password" name="password" type="password" class="text"/>
					<div class="sep"></div>
					<input type="submit" name="submit" value="login">
					<label for="cookie">Remember Me? </label>
					<input type="checkbox" id="cookie" name="cookie" value="1"/>
				</form>
			</div>
		</div>
	</div>
</div>
		<?php
			session_start();
			$con = mysqli_connect("localhost","root","","library");

			// Check connection
			if (mysqli_connect_errno())
			  {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }

			if(isset($_POST['submit']))
			{
				$username = isset($_POST['username'])?$_POST['username']:'';
				$password = isset($_POST['password'])?$_POST['password']:'';
				$cookie   = isset($_POST['cookie'])?$_POST['cookie']:'';
				


				if ($cookie == 1)
				{
					 include('C:\xampp\htdocs\Library\include\cookie_set.php');  
				}
	

				//set session
				$_SESSION["username"]=$username;

				$sql = "SELECT username, password FROM users WHERE username='".$username."' and password=md5('".$password."')";
				$sql_role = "SELECT user_id, user_role FROM users WHERE username='$username'";


				$result = $con->query($sql);
				$role_result= $con->query($sql_role);
					
				if ($result -> num_rows > 0) {
					while($row = $role_result -> fetch_assoc())
					{
						$_SESSION["user_role"]=$row["user_role"];
						$_SESSION["user_id"]=$row["user_id"];
					}
					echo header('Location:dash.php');
				} else {
				    echo "Wrong Username or Password!";
				}

				$con->close();
			}

		?>

<?php include('include/footer.php'); ?>

