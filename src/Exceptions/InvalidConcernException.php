<?php

namespace FDC\Support\Exceptions;

use \LogicException;
use \Throwable;

/**
 * Exception thrown when using or implementing a concern, but not any
 * concerns required by it.
 */
class InvalidConcernException extends LogicException
{
	/**
	 * @param string $message
	 * @param int $code
	 * @param Throwable|null $previous
	 */
	public function __construct(
		$message = 'Concerns on this class have additional requirements that are not met.',
		$code = 0,
		Throwable $previous = null
	) {
		parent::__construct($message, $code, $previous);
	}
}
