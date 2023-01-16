<?php

return [
	'name' => '4Multi.Store',
    'backend' => 'admin',
	'modules' => [
		'page' => true,
		'blog' => true,
		'media' => true,
		'translate' => true,
		'layout' => true,
		'setting' => [
			'cookie' => true,
			'thumbnails' => true
		],
		'content' => [
			'popup' => true,
			'slider' => true,
			'navigation' => true,
		]
	]
];
