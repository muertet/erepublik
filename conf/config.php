<?php
$envs = array
(
    'local' => '^(localhost|menut-local\.com)$',
    'prod' => '^(mydomain\.com)$',
);

$config = array
(

    'dbserver' => array
    (
        'local' => 'localhost',
        'prod' => 'localhost',
    ),

    'dbuser' => array
    (
        'local' => 'root',
        'prod' => 'root',
    ),

    'dbpass' => array
    (
        'local' => '',
        'prod' => 'MYSQL_PASSWORD',
    ),

    'dbname' => array
    (
        'local' => 'erepublik',
        'prod' => 'erepublik',
    ),
	'dbport' => array
	(
		'local' => null,
		'prod' => null,
	),
	/* mydomain.com/erepublik => /erepublik/ is basedir
	  if you will be using mydomain.com/ => /
	  *********
	  ALSO REMEMBER TO EDIT .HTACCESS FILE TO MATCH THIS SETTING
	  *********
	*/
    'basedir' => array
    (
        'local' => '/erepublik/',
        'prod' => '/erepublik/',
    ),
	// NO FINAL SLASH!
	'domain'=>array(
		'local'=>'localhost/erepublik',
		'prod'=>'mydomain.com'
	),
	'appId'=>array(
		'local'=>1,
		'prod'=>1,
	),
	'secret'=>array(
		'local'=>'2345r6tujyhtg',
		'prod'=>'2345r6tujyhtg',
	),

    'root' => dirname(dirname(__FILE__)),
	'fulldir' => dirname(dirname(__FILE__)).'/',
);