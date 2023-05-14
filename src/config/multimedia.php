<?php

return [
	'name' => '4Multi.Store',
    'backend' => 'admin',
	'auth' => [
		'route' => 'profil',
		'register' => true,
		'login' => true,
        'otp' => [
            'login' => false,
            'register' => false,
            'recovery' => false
        ],
	],
	'assets' => [
		'bootstrap' => true
	],
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
