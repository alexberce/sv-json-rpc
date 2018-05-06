<?php

use SmartValue\Database\QueryBuilder;
use Symfony\Component\Dotenv\Dotenv;

include_once "vendor/autoload.php";


//Load DotENV
(new Dotenv())->load(__DIR__ . '/../.env');

$queryBuilder = QueryBuilder::getInstance();

var_dump(
	$queryBuilder->select(['id', 'username', 'email'])
	             ->from('users')
	             ->where('id > 15')
	             ->limit(5)
	             ->orderBy('email')
	             ->orderBy('username', 'ASC')
	             ->getQuery()
);


var_dump(
	$queryBuilder->delete()
	             ->from('notifications')
	             ->where('notificationType="old"')
	             ->limit(20)
	             ->getQuery()
);

var_dump(
	$queryBuilder->insert()
	             ->into('users')
	             ->columns(['username', 'password', 'email'])
	             ->values(['alex', '123', 'alex@123.com'])
	             ->values(['test', '123', 'test@123.com'])
	             ->getQuery()
);