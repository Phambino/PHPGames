

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Rock Paper Scissors</title>
	</head>
	<body>
		<h1>Welcome to Rock Paper Scissors</h1>
		<form action="index.php" method="post">
		<img src="https://ih0.redbubble.net/image.349567647.9176/st%2Csmall%2C215x235-pad%2C210x230%2Cf8f8f8.lite-1u1.jpg" height="80" alt="rock" />
		<img src="https://i.ytimg.com/vi/gSv4WiQ_gOM/hqdefault.jpg" height="80" alt="paper" />
		<img src="http://en.spongepedia.org/images/5/50/SpatHead.JPG" height="80" alt="scissors" />
		</form>

		<form action="index.php" method="post">
			<input type="submit" name="rock" value="rock" /> 
			<input type="submit" name="paper" value="paper" />
			<input type="submit" name="scissors" value="scissors" />
		</form>

		<?php echo ("Your Opponent picked: "); ?>
                <?php if(($_SESSION['RPS']->num) == 0) { ?>
                        <img src="https://ih0.redbubble.net/image.349567647.9176/st%2Csmall%2C215x235-pad%2C210x230%2Cf8f8f8.lite-1u1.jpg" alt="rock" height="80">
                <?php }
                else if(($_SESSION['RPS']->num) == 1) { ?>
                        <img src="https://i.ytimg.com/vi/gSv4WiQ_gOM/hqdefault.jpg"  alt="paper" height="80">
                <?php }
                else if(($_SESSION['RPS']->num) == 2){ ?>
                        <img src="http://en.spongepedia.org/images/5/50/SpatHead.JPG" alt="scissors" height="80">
                <?php } ?>
		
	 	<?php echo ($_SESSION['RPS']->history); ?> <?php echo ('</br>'); ?> <?php echo ('</br>'); ?> <?php echo ('</br>'); ?>
		<?php echo ("Total games played: "); ?> <?php echo ($_SESSION['RPS']->totalgames); ?> <?php echo ('</br>'); ?>
		<?php echo ("Total wins: "); ?> <?php echo ($_SESSION['RPS']->wins); ?> <?php echo ('</br>'); ?> 
		<?php echo ("Total losses: "); ?> <?php echo ($_SESSION['RPS']->losses); ?> <?php echo ('</br>'); ?>
		<?php echo ("Total draws: "); ?> <?php echo ($_SESSION['RPS']->draws); ?> <?php echo ('</br>'); ?>
                <form action="index.php" method="post">
                	<input type="submit" name="back" value="Go back?" />
                </form>	

		
	</body>
</html>
