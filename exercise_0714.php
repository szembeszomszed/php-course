<!DOCTYPE html>
<html>
	<head>
		<title>exercise_0714</title>
	</head>
	<body>
		<?php

			$headerNum1 = "Szám1";
			$headerNum2 = "Szám2";
            $headerOperation = "Művelet";
			$headerResult = "Eredmény";

			$num1 = 45;
			$num2 = 15;

            $plus = "+";
            $minus = "-";
            $multipliedBy = "*";
            $dividedBy = "/";

            $resultAddition = $num1 + $num2;
            $resultSubtraction = $num1 - $num2;
            $resultMultiplication = $num1 * $num2;
            $resultDivision = $num1 / $num2;

			echo "<table style=\"border-collapse: collapse\" border=\"1px\">
				<thead>
					<tr>
						<th style=\"text-align: center\">$headerNum1</th>
						<th style=\"text-align: center\">$headerOperation</th>
						<th style=\"text-align: center\">$headerNum2</th>
						<th style=\"text-align: center\">$headerResult</th>
					</tr>
				</thead>
				<tbody>
				    <tr>
				        <td style=\"text-align: center\">$num1</td>
				        <td style=\"text-align: center\">$plus</td>
				        <td style=\"text-align: center\">$num2</td>
				        <td style=\"text-align: center\">$resultAddition</td>
				    </tr>
				    <tr>
				        <td style=\"text-align: center\">$num1</td>
				        <td style=\"text-align: center\">$minus</td>
				        <td style=\"text-align: center\">$num2</td>
				        <td style=\"text-align: center\">$resultSubtraction</td>
				    </tr>
				    <tr>
				        <td style=\"text-align: center\">$num1</td>
				        <td style=\"text-align: center\">$multipliedBy</td>
				        <td style=\"text-align: center\">$num2</td>
				        <td style=\"text-align: center\">$resultMultiplication</td>
				    </tr>
				    <tr>
				        <td style=\"text-align: center\">$num1</td>
				        <td style=\"text-align: center\">$dividedBy</td>
				        <td style=\"text-align: center\">$num2</td>
				        <td style=\"text-align: center\">$resultDivision</td>
				    </tr>
				</tbody>
			</table>";

            echo "<br/>
                  <br/>
                <table style=\"border-collapse: collapse\" border=\"1px\">
				<thead>
					<tr>
						<th style=\"text-align: center\">$headerNum1</th>
						<th style=\"text-align: center\">$headerOperation</th>
						<th style=\"text-align: center\">$headerNum2</th>
						<th style=\"text-align: center\">$headerResult</th>
					</tr>
				</thead>
				<tbody>";
            for($i = 0; $i <= 50; $i++) {
                $j = $i * $i;
                $result = $i + $j;
                if ($i % 2 === 0) {
                    echo "<tr>
                            <td style=\"text-align: center; background-color: #cecece\">$i</td>
                            <td style=\"text-align: center; background-color: #cecece\">$plus</td>
                            <td style=\"text-align: center; background-color: #cecece\">$j</td>
                            <td style=\"text-align: center; background-color: #cecece\">$result</td>
                        </tr>";
                } else {
                    echo "<tr>
                            <td style=\"text-align: center\">$i</td>
                            <td style=\"text-align: center\">$plus</td>
                            <td style=\"text-align: center\">$j</td>
                            <td style=\"text-align: center\">$result</td>
                        </tr>";
                }
            }

            echo "</tbody>
            	</table>
            	<br/>
	            <br/>";

	        echo "<table style=\"border-collapse: collapse\" border=\"1px\">
					<thead>
						<tr>
							<th style=\"text-align: center\">$headerNum1</th>
							<th style=\"text-align: center\">$headerOperation</th>
							<th style=\"text-align: center\">$headerNum2</th>
							<th style=\"text-align: center\">$headerResult</th>
						</tr>
					</thead>
					<tbody>";
	        for($i = 0; $i <= 50; $i++) {
	            $j = $i * $i;
	            $result = $j - $i;
	            if ($i % 2 === 0) {
	                echo "<tr>
	                            <td style=\"text-align: center; background-color: #cecece\">$j</td>
	                            <td style=\"text-align: center; background-color: #cecece\">$minus</td>
	                            <td style=\"text-align: center; background-color: #cecece\">$i</td>
	                            <td style=\"text-align: center; background-color: #cecece\">$result</td>
	                        </tr>";
	            } else {
	                echo "<tr>
	                            <td style=\"text-align: center\">$j</td>
	                            <td style=\"text-align: center\">$minus</td>
	                            <td style=\"text-align: center\">$i</td>
	                            <td style=\"text-align: center\">$result</td>
	                        </tr>";
	            }
	        }

            echo "</tbody>
            	</table>
            	<br/>
	            <br/>";

	        echo "<table style=\"border-collapse: collapse\" border=\"1px\">
					<thead>
						<tr>
							<th style=\"text-align: center\">$headerNum1</th>
							<th style=\"text-align: center\">$headerOperation</th>
							<th style=\"text-align: center\">$headerNum2</th>
							<th style=\"text-align: center\">$headerResult</th>
						</tr>
					</thead>
					<tbody>";
	        for($i = 0; $i <= 50; $i++) {
	            $j = $i + $i;
	            $result = $i * $j;
	            if ($i % 2 === 0) {
	                echo "<tr>
	                            <td style=\"text-align: center; background-color: #cecece\">$i</td>
	                            <td style=\"text-align: center; background-color: #cecece\">$multipliedBy</td>
	                            <td style=\"text-align: center; background-color: #cecece\">$j</td>
	                            <td style=\"text-align: center; background-color: #cecece\">$result</td>
	                        </tr>";
	            } else {
	                echo "<tr>
	                            <td style=\"text-align: center\">$i</td>
	                            <td style=\"text-align: center\">$multipliedBy</td>
	                            <td style=\"text-align: center\">$j</td>
	                            <td style=\"text-align: center\">$result</td>
	                        </tr>";
	            }
	        }

            echo "</tbody>
            	</table>
            	<br/>
	            <br/>";

	        echo "<table style=\"border-collapse: collapse\" border=\"1px\">
					<thead>
						<tr>
							<th style=\"text-align: center\">$headerNum1</th>
							<th style=\"text-align: center\">$headerOperation</th>
							<th style=\"text-align: center\">$headerNum2</th>
							<th style=\"text-align: center\">$headerResult</th>
						</tr>
					</thead>
					<tbody>";
	        for($i = 0; $i <= 50; $i++) {
	            $j = $i + 1;
	            $result = round($i / $j, 2);
	            if ($i % 2 === 0) {
	                echo "<tr>
	                            <td style=\"text-align: center; background-color: #cecece\">$i</td>
	                            <td style=\"text-align: center; background-color: #cecece\">$dividedBy</td>
	                            <td style=\"text-align: center; background-color: #cecece\">$j</td>
	                            <td style=\"text-align: center; background-color: #cecece\">$result</td>
	                        </tr>";
	            } else {
	                echo "<tr>
	                            <td style=\"text-align: center\">$i</td>
	                            <td style=\"text-align: center\">$dividedBy</td>
	                            <td style=\"text-align: center\">$j</td>
	                            <td style=\"text-align: center\">$result</td>
	                        </tr>";
	            }
	        }

            echo "</tbody>
            	</table>
            	<br/>
	            <br/>";	       	


		?>
	</body>
</html>