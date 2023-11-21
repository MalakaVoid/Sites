
<?php 
	$mas_header = array(
		'Добавить товар' => '/admin/add_item.php',
		'Удалить товар' => '/admin/del_item.php',
	);
?>
<div class='header' align='center'>
	<?php 
		$flag = True;
		foreach ($mas_header as $title => $url) {
			if ($url == $_SERVER['REQUEST_URI']){
				$class_el = "active";
			} else {
				$class_el = "";
			}

			if ($flag){
				$flag = False;
				$style_first = "first";
			} else{
				$style_first = "";
			}

			echo "<a href='{$url}' class='head-item {$class_el} {$style_first}''><span>{$title}</span></a>";
			
		}
	?>
</div>