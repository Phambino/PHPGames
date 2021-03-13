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
			<h1>Rock Paper Scissors</h1>
			<h3>Pick One!</h3>

			<form action="index.php" method="post">
				<input type="submit" name="rock" value="rock" />
				<input type="submit" name="paper" value="paper" />
				<input type="submit" name="scissors" value="scissors" />
			</form>

			<h3>Your Opponent Picked:</h3>
			<?php
				echo ('</br>');
				if(($_SESSION['RPS']->num) == 0) { ?>
					<img src="https://ih0.redbubble.net/image.349567647.9176/st%2Csmall%2C215x235-pad%2C210x230%2Cf8f8f8.lite-1u1.jpg" alt="rock">
			<?php		echo ('</br>'); echo ($_SESSION['RPS']->state);
				} else if(($_SESSION['RPS']->num) == 1) { ?>
					<img src="https://i.ytimg.com/vi/gSv4WiQ_gOM/hqdefault.jpg"  alt="paper">
			<?php		echo ('</br>'); echo ($_SESSION['RPS']->state);
				} else if(($_SESSION['RPS']->num) == 2){ ?>
					<img src="http://en.spongepedia.org/images/5/50/SpatHead.JPG" alt="scissors">
			<?php		echo ('</br>'); echo ($_SESSION['RPS']->state);
				}
			?>
			</section>
			<section class='stats'>
				<h1>Stats</h1>
				<?php
				echo ("Total Games: {$_SESSION['RPS']->totalgames}");
				echo ('</br>');
				echo ("Wins: {$_SESSION['RPS']->wins}");
				echo ('</br>');
				echo ("Losses: {$_SESSION['RPS']->losses}");
				echo ('</br>');
				echo ("Draws: {$_SESSION['RPS']->draws}");
				?>
			</section>
		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

