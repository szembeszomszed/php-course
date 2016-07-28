<!DOCTYPE html>
<html>
	<head>
		<link type='text/css' rel="stylesheet" href="flipcount.css"/>
		<title>Coin Flips</title>
	</head>
	<body>
		<p>Let's flip a coin until we get 4 heads in a row!</p>

		<?php
		$flipCount = 0;
		$headCount = 0;

		while (headCount < 4) {
			$flip = rand(0, 1);
			$flipCount++;

			if($flip) {
				$headCount++;
				echo "<div class=\"coin\">H</div>";
			} else {
				$headCount = 0;
				echo "<div class=\"coin\">T</div>";
			}
		}

		echo "<p>It took {$flipCount} flips!</p>";
		?>
	</body>
</html>
