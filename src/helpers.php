<?php

use FDC\Support\Files;
use FDC\Support\Record;
use Illuminate\Support\Collection;

if (!function_exists('toJson')) {
	/**
	 * Convert data as a json string.
	 *
	 * @param \Illuminate\Support\Collection|\FDC\Support\Record|array $content
	 * @param bool $formatted  `true` removes escape characters and formats (pretty print) the output.
	 * @return string
	 */
	function toJson($content = [], bool $formatted = false): string
	{
		if ($content instanceof Record || $content instanceof Collection) {
			$content = $content->toArray();
		}

		return !$formatted ? json_encode($content) : stripslashes(json_encode($content, JSON_PRETTY_PRINT));
	}
}

if (!function_exists('record')) {
	/**
	 * Create a record from the given value.
	 *
	 * @param  mixed  $value
	 * @return FDC\Support\Record
	 */
	function record($value = null)
	{
		return new Record($value);
	}
}

if (!function_exists('s3')) {
	/**
	 * Get the contents of a file from s3.
	 *
	 * @param string $path  Filepath relative to bucket root.
	 * @return string
	 */
	function s3(string $path): string
	{
		return Files::s3File($path);
	}
}

if (!function_exists('s3Files')) {
	/**
	 * Get a Record of files from an s3 directory/bucket.
	 *
	 * @param 	string|null     $directory  Relative to bucket root.
	 * @param   string|null ...$contains   Substrings that must all be in filename.
	 * @return  Record
	 */
	function s3Files(?string $directory = null, ?string ...$contains): Record
	{
		return Files::s3Files($directory, ...$contains);
	}
}

if (!function_exists('logo')) {
	/**
	 * Output an ascii logo from the command line.
	 *
	 * @return string
	 */
	function logo()
	{
		return <<<FDC
   ____     _____    __               __
  / __/_ __/ / _/(_)/ /_ _  ___ ___  / /_ _______  __ ___
 / _// // / / _/ / / /  ' \/ -_) _ \/ __// __/ _ \/  '  /
/_/  \_,_/_/_//_/_/_/_/_/_/\__/_//_/\___()__/\___/_/_/_/
FDC;
	}
}
