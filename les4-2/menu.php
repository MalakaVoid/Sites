<?php 
	$hd['Main page']['title'] = "Главная страница";
	$hd['Main page']['url'] = "index.php";
	$hd['About us']['title'] = "О нас";
	$hd['About us']['url'] = "1.php";
	$hd['Price']['title'] = "Цены";
	$hd['Price']['url'] = "2.php";
	$hd['Contacts']['title'] = "Контакты";
	$hd['Contacts']['url'] = "3.php";
?>
<!DOCTYPE html>
<!-- 
Визуальная состовляющаяя:
Меню:
Главная, о нас, цены, контакты
Закрасить фон ячейки меню на которой находится пользователь
При наведении на элемент меню, пусть закрашивается другим цветом
Не виз сост:
У каждого элеммента:
Название
ссылка путь: урл
Массив с названием и путем элемента

Сначала сделать каркас потом массив
-->
<html>
<head>
	<title>Менюшка</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<!--
	<div class='header' align="center">
		<div class='header-cont'>
			<a href="">Главная страница</a>
		</div>
		<div class='header-cont'>
				<a href="">О нас</a>
		</div>
		<div class='header-cont'>
				<a href="">Цены</a>
		</div>
		<div class='header-cont'>
				<a href="">Контакты</a>
		</div>
	</div>
-->
	<div class='header' align="center">
		<?php 
		foreach ($hd as $name => $arr) {
			if ('/'.$arr['url'] == $_SERVER['REQUEST_URI']){
				$class_el = "style='background-color: darkred;'";
			} else {
				$class_el = "";
			}

			echo "<div class='header-cont' {$class_el}>
					<a href='{$arr['url']}'>{$arr['title']}</a>
				</div>";
		}
		?>
	</div>

</body>
</html>