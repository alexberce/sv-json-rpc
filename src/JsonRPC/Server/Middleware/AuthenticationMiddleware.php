<?php


namespace SmartValue\JsonRPC\Server\Middleware;


use JsonRPC\Exception\AccessDeniedException;
use JsonRPC\Exception\AuthenticationFailureException;
use JsonRPC\MiddlewareInterface;

class AuthenticationMiddleware implements MiddlewareInterface {
	
	/**
	 * Execute Middleware
	 *
	 * @access public
	 *
	 * @param  string $username
	 * @param  string $password
	 * @param  string $procedureName
	 *
	 * @throws AccessDeniedException
	 * @throws AuthenticationFailureException
	 */
	public function execute( $username, $password, $procedureName ) {
		if (
			$username !== getenv('JSON_RPC_SERVER_USERNAME') ||
			$password !== getenv('JSON_RPC_SERVER_PASSWORD')
		) {
			throw new AuthenticationFailureException( 'Wrong credentials!' );
		}
	}
}