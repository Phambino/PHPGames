<?php
	$_REQUEST['guess']=!empty($_REQUEST['guess']) ? $_REQUEST['guess'] : '';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" type="text/css" href="./style.css" />
		<title>Games</title>
	</head>
	<body>
		<?php include("header.html");  ?>
		<main>
			<section>
			<h1>GuessGame</h1>
			<?php echo(view_errors($errors)); ?>
			<?php 
				foreach($_SESSION['GuessGame']->history as $key=>$value){
					echo("<br/> $value");
				}
			?>
			<form method="post">
				<input type="submit" name="submit" value="start again" />
			</form>
			</section>
			<section class='stats'>
				<h1>Stats</h1>
				<?php 
					echo ("Total Guesses: {$_SESSION['GuessGame']->numGuesses}");
				?>
			</section>
		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

