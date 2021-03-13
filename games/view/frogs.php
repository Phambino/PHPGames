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
				<h1>Frogs</h1>
				<form action="index.php" method="post">
					<section class='froggrid'>
					<?php 
					foreach($_SESSION['Frogs']->position as $key=>$value) {
						if($value == 1) { ?>
							<img src="http://www.cs.toronto.edu/~arnold/309/19s/lectures/javascript/frogs/yellowFrog.gif" height="80" alt="leftfrog1" />
						<?php } else if($value == 0) { ?>
							<img src="http://www.cs.toronto.edu/~arnold/309/19s/lectures/javascript/frogs/empty.gif" height="80" alt="empt" />
						<?php } else if($value == 2) { ?>
							<img src="http://www.cs.toronto.edu/~arnold/309/19s/lectures/javascript/frogs/greenFrog.gif" height="80" alt="leftfrog3" />				
						<?php } 
					}
					?>
					</section>
				</form>
				<?php echo("<br/>"); ?>
				<form action="index.php" method="POST">
					<input type="submit" name="leftfrog1" value="Left Frog 1" />
					<input type="submit" name="leftfrog2" value="Left Frog 2" />
					<input type="submit" name="leftfrog3" value="Left Frog 3" />
					<input type="submit" name="rightfrog3" value="Right Frog 3" />
					<input type="submit" name="rightfrog2" value="Right Frog 2" />
					<input type="submit" name="rightfrog1" value="Right Frog 1" />
					<input type="submit" name="retry" value="Start Over?" />
				</form>

				<?php 
				if($_SESSION["Frogs"]->getState()=="YOU WIN"){
					echo($_SESSION["Frogs"]->getState());
				}
				?>
			</section>
			<section class='stats'>
				<h1>Stats</h1>
				<?php
				echo ("Total Wins: {$_SESSION['Frogs']->wins}");
				?>
			</section>
		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

