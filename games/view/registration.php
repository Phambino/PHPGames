<?php
// So I don't have to deal with unset $_REQUEST['user'] when refilling the form
// You can also take a look at the new ?? operator in PHP7

$_REQUEST['user']=!empty($_REQUEST['user']) ? $_REQUEST['user'] : '';
$_REQUEST['password']=!empty($_REQUEST['password']) ? $_REQUEST['password'] : '';
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
		<main id="regi">
			<section>
				<h1>Games</h1>
				<form action="index.php" method="post">
					<legend>Registration</legend>
					<table>
						<!-- Trick below to re-fill the user form field -->
						<tr><th><label for="user">Username</label></th><td><input type="text" name="user" value="<?php echo($_REQUEST['user']); ?>" /></td></tr>
						<tr><th><label for="password">Password</label></th><td> <input type="password" name="password" /></td></tr>
                        <tr><th><label for="password2">Confirm Password</label></th><td> <input type="password" name="password2" /></td></tr>
                        <tr><th><label for="email">Email </label></th><td> <input type="text" name="email" /></td></tr>
					</table>

					<br>
					<label for="gender">What is your gender?</label><br>
					<input type="radio" id="male" name="gender" value="male">
					<label for="male">Male</label><br>
					<input type="radio" id="female" name="gender" value="female">
					<label for="female">Female</label><br>
					<input type="radio" id="other" name="gender" value="other">
					<label for="other">Other</label>


					<br>
					<label for="colour">Choose a colour:</label>
					<select name="colour" id="colour">
					<option value="na">Choose</option>
					<option value="red">Red</option>
					<option value="blue">Blue</option>
					<option value="green">Green</option>
					<option value="black">Black</option>
					<option value="white">White</option>
					</select>

					<br>
					<input type="submit" name="submit" value="register" /> <br> <br>
					<input type="submit" name="log" value="Go Back to Login"/>
					<?php echo(view_errors($errors)); ?>
				</form>
			</section>
		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

