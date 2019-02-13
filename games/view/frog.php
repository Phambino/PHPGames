<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="utf-8">
                <title>Frog Jump Puzzle</title>
        </head>
        <body>
                <h1>Welcome to Frog Jump Puzzle Game</h1>
                <form action="index.php" method="post">
		<?php
			foreach($_SESSION['Frog']->position as $key=>$value) {
				if($value == 1) { ?>
					<img src="http://www.cs.toronto.edu/~arnold/309/19s/lectures/javascript/frogs/yellowFrog.gif" height="80" alt="leftfrog1" />	
				<?php } else if($value == 0) { ?>
					<img src="http://www.cs.toronto.edu/~arnold/309/19s/lectures/javascript/frogs/empty.gif" height="80" alt="empt" />
				<?php } else if($value == 2) { ?>
					<img src="http://www.cs.toronto.edu/~arnold/309/19s/lectures/javascript/frogs/greenFrog.gif" height="80" alt="leftfrog3" />				
				<?php } 
			}
		?>
                </form>
		<?php echo ("Move the frogs from one side to the other"); ?>
		<form action="index.php" method="post">
			<input type="submit" name="leftfrog1" value="Left Frog 1" />
			<input type="submit" name="leftfrog2" value="Left Frog 2" />
			<input type="submit" name="leftfrog3" value="Left Frog 3" />
			<input type="submit" name="rightfrog3" value="Right Frog 3" />
			<input type="submit" name="rightfrog2" value="Right Frog 2" />
			<input type="submit" name="rightfrog1" value="Right Frog 1" />
		</form>
		<?php
			if($_SESSION['Frog']->position[2] == 2 && $_SESSION['Frog']->position[3] == 2 &&
				$_SESSION['Frog']->position[4] == 2 && $_SESSION['Frog']->position[5] == 0 &&
				$_SESSION['Frog']->position[6] == 1 && $_SESSION['Frog']->position[7] == 1 &&
				$_SESSION['Frog']->position[8] == 1) {
					echo("YOU WIN!!");
					echo("</br>");
		?>
		
		<?php
				} 
		?>

                <form action="index.php" method="post">
                        <input type="submit" name="back" value="Go back?" />
                </form>


        </body>
</html>

