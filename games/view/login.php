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
		<main>
			<section>
				<h1>Games</h1>
				<form action="index.php" method="post">
					<legend>Login</legend>
					<table>
						<!-- Trick below to re-fill the user form field -->
						<tr><th><label for="user">User</label></th><td><input type="text" name="user" value="<?php echo($_REQUEST['user']); ?>" /></td></tr>
						<tr><th><label for="password">Password</label></th><td> <input type="password" name="password" /></td></tr>
						<tr><th>&nbsp;</th><td><input type="submit" name="submit" value="login" /></td></tr>
						<tr><th>&nbsp;</th><td><?php echo(view_errors($errors)); ?></td></tr>
					</table>
				</form>
			<form action="index.php" method="post">
				<input type="submit" name="regi" value="register"/>
			</form>
			</section>
				<form>
					<img height="100" src="https://s3.us-east-1.amazonaws.com/dexerto-assets-production-cbbdf288/uploads/2021/01/28224707/the-wallstreetbets-stock-saga-how-reddit-memes-took-gamestop-to-the-moon-1024x576.jpg?w=620" alt="gme">
					<img height="100" src="https://images.emojiterra.com/google/android-10/512px/1f680.png" alt="rocket">
				</form>
			<section>
			</section>
		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

