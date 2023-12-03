<?php

$set = array(
	'header' => 'Заголовок',
	'inst_name_link' => 'Имя ссылки в Instagram',
	// 'link_title' => 'Заголовок кнопки',
	// 'link' => 'Ссылка',
);


$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 75,
		'ROWS' => 3
	);
}
