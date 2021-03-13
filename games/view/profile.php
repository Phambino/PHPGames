<?php
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Games</title>
	</head>
	<body>
        <?php include("header.html");  ?>
		<main>
			<section>
				<h1>Profile</h1>
				<form action="index.php" method="post">
					<table>
						<!-- Trick below to re-fill the user form field -->
						<tr><th><label for="oldpassword">Old Password</label></th><td><input type="password" name="oldpassword" /></td></tr>
						<tr><th><label for="newpassword">New Password</label></th><td> <input type="password" name="newpassword" /></td></tr>
                        <tr><th><label for="newpassword2">Confirm New Password</label></th><td> <input type="password" name="newpassword2" /></td></tr>
                        <tr><th><label for="email">Change Email </label></th><td> <input type="text" name="email" /></td></tr>
					</table>

					<br>
					<label for="gender">Change Specified Gender?</label><br>
					<input type="radio" id="male" name="gender" value="male">
					<label for="male">Male</label><br>
					<input type="radio" id="female" name="gender" value="female">
					<label for="female">Female</label><br>
					<input type="radio" id="other" name="gender" value="other">
					<label for="other">Other</label>


					<br>
					<label for="colour">Change colour?:</label>
					<select name="colour" id="colour">
					<option value="na">Choose</option>
					<option value="red">Red</option>
					<option value="blue">Blue</option>
					<option value="green">Green</option>
					<option value="black">Black</option>
					<option value="white">White</option>
					</select>

					<br>
					<input type="submit" name="submit" value="Change?" />
					<?php echo(view_errors($errors)); ?>
				</form>
			</section>
			<section class='stats'>
				<h1>Current information</h1>
				Username: <p style="text-align:center;"><?php echo ("{$_SESSION['Profile']->name}"); ?></p>
				Password: <p style="text-align:center;"><?php echo ("{$_SESSION['Profile']->password}"); ?></p>
				Email: <p style="text-align:center;"><?php echo ("{$_SESSION['Profile']->email}"); ?></p>
				Gender: <p style="text-align:center;"><?php echo ("{$_SESSION['Profile']->gender}"); ?></p>
				Colour: <p style="text-align:center;"><?php echo ("{$_SESSION['Profile']->colour}"); ?></p>
			</section>

		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

