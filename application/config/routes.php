<?php 

return [
	'account/login' => [
		'controller'=>'account',
		'action'=>'login',
	],
	'{page:\d+}' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'account/register' => [
		'controller'=>'account',
		'action'=>'register',
	],
	'account/logout' => [
		'controller'=>'account',
		'action'=>'logout',
	],
	'' => [
		'controller'=>'main',
		'action'=>'index',
	],
	'add' => [
		'controller'=>'main',
		'action'=>'add',
	],
	'change' => [
		'controller'=>'main',
		'action'=>'change',
	],
	'sort' => [
		'controller'=>'main',
		'action'=>'sort',
	],
];