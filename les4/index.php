<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Table</title>
</head>
<body>
	<table class="tab" border="1">
		<tr>
			<td colspan=100 style='background-color: rgb(255, 0, 0, 1.0);' valign="top">1</td>
		</tr>
		<?php
		$tmp = 100;
		$content = 2;
		$gard = 254;
		for ($i = 1; $i < 100; $i++){
			echo "<tr>";
			echo "<td rowspan={$tmp} style='background-color: rgb(0, {$gard}, 0, 1.0);' valign='top'>{$content}</td>";
			$tmp = $tmp-1;
			$content++;
			echo "<td colspan={$tmp} style='background-color: rgb({$gard}, 0, 0, 1.0);'>{$content}</td>";
			echo "</tr>";
			$content++;
			$gard-=3;
		} 
		?>
	</table>

</body>
</html>