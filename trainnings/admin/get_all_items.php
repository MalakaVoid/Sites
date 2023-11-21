<?php
	$tmp = file_get_contents("../products.json");
	$products = json_decode($tmp, true);

	$types = array();
	$categoryes = array();
	$items = array();
	foreach ($products as $type => $cat_arr) {
		$types[] = $type;
		foreach ($cat_arr as $cat => $item_arr) {
			$categoryes[] = $cat;
			foreach ($item_arr as $title => $item_properties) {
				$items[] = $title;
			};
		};
	};
?>