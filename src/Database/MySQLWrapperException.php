<?php


namespace SmartValue\Database;


class MySQLWrapperException extends \Exception {
	const INVALID_CONNECTION = 1;
	const INVALID_TABLE_NAME = 2;
	const INVALID_PARAM_TYPE = 3;
}