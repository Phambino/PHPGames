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
				<h1>All Stats</h1>
				<h2>Guess Game:</h2>
				<?php echo ("Total wins: {$_SESSION['Allstats']->ggwin}"); ?>
				<h2>Rock Paper Scissors:</h2>
				<?php echo ("Total wins: {$_SESSION['Allstats']->rpswin}"); ?> <br>
				<?php echo ("Total losses: {$_SESSION['Allstats']->rpsloss}"); ?> <br>
				<?php echo ("Total draws: {$_SESSION['Allstats']->rpsdraw}"); ?>
				<h2>Frogs:</h2>
				<?php echo ("Total wins: {$_SESSION['Allstats']->frogwin}"); ?>
			</section>
		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

