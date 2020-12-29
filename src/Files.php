<?php

namespace FDC\Support;

use FDC\Support\Record;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Files
{
	/**
	 * Extract the file name (without extension) from a file path.
	 *
	 * @param  string  $path
	 * @return string
	 */
	public static function name($path)
	{
		return pathinfo($path, PATHINFO_FILENAME);
	}

	/**
	 * Extract the trailing name from a file path.
	 * File name with extension or directory name
	 *
	 * @param  string  $path
	 * @return string
	 */
	public static function basename($path)
	{
		return pathinfo($path, PATHINFO_BASENAME);
	}

	/**
	 * Extract the parent directory from a file path.
	 *
	 * @param  string  $path
	 * @return string
	 */
	public static function dirname($path)
	{
		return pathinfo($path, PATHINFO_DIRNAME);
	}

	/**
	 * Extract the file extension from a file path.
	 *
	 * @param  string  $path
	 * @return string
	 */
	public static function extension($path)
	{
		return pathinfo($path, PATHINFO_EXTENSION);
	}

	/**
	 * Validate file has one of the given extensions.
	 *
	 * @param string 	$path
	 * @param string ...$extensions
	 * @return bool
	 */
	public static function isType(string $path, string ...$extensions): bool
	{
		return Str::contains(pathinfo($path, PATHINFO_EXTENSION), $extensions);
	}

	/**
	 * Get the full path for a given path.
	 * If a disk is not provided, the path is treated as a
	 * standard relative/absolute path.
	 *
	 * @param  string 		$path
	 * @param  string|null 	$disk
	 * @return string|bool  Full path if the file is present.
	 */
	public static function fullPath(string $path, ?string $disk = null)
	{
		return !$disk
			? pathinfo($path, PATHINFO_DIRNAME) . '/' . pathinfo($path, PATHINFO_BASENAME)
			: Storage::disk($disk)->path($path);
	}

	/**
	 * Pre-generate a temp file path for use when ready to store file.
	 *
	 * @param string $extension
	 * @return string
	 */
	public static function generateTempFilePath(string $extension): string
	{
		return storage_path('app/tmp/' . Carbon::now()->format('YmdHisv') . '.' . $extension);
	}

	/**
	 * Get content of a temp file.
	 *
	 * @param string $fileName
	 * @return string
	 */
	public static function getTemp(string $fileName): string
	{
		return file_get_contents(storage_path('app/tmp/' . $fileName));
	}

	/**
	 * Write content to local temp file and get the path.
	 *
	 * @param  string  $content
	 * @return string|bool
	 */
	public static function temp(string $content, string $extension)
	{
		$path = static::generateTempFilePath($extension);
		$dir = static::dirname($path);

		// Check first that the directory exists on default disk
		file_exists($dir) || mkdir($dir, 0755, true);

		// Write to disk and return the path on success.
		return file_put_contents($path, $content) ? $path : false;
	}

	/**
	 * Delete tmp directory in default storage and creates a new empty directory.
	 *
	 * @return bool
	 */
	public static function purgeTemp(): bool
	{
		// Check that the tmp directory exists, and delete it.
		file_exists(storage_path('app/tmp')) || rmdir(storage_path('app/tmp'));

		// Replace with an empty tmp directory.
		return mkdir(storage_path('app/tmp'), 0755, true);
	}

	/**
	 * Get contents of a file from s3.
	 *
	 * @param string $path
	 * @return string
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public static function s3File(string $path): string
	{
		return Storage::disk('s3')->get($path);
	}

	/**
	 * Get an array of files from an s3 directory/bucket.
	 * Additional arguments require the returned filenames
	 * to contain all given substrings.
	 *
	 * @param 	string|null     $directory  Path bucket root directory.
	 * @param   string|null ...$contains
	 * @return  Record
	 */
	public static function s3Files(?string $directory = null, ?string ...$contains): Record
	{
		$files = Storage::disk('s3')->files($directory);

		return record(array_filter($files, function ($file) use ($contains) {
			return Str::containsAll($file, $contains);
		}));
	}

	/**
	 * Generates a local temp copy of an S3 file.
	 *
	 * @param  string  $path
	 * @return string
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public static function s3Temp(string $path): string
	{
		return static::temp(static::s3File($path), static::extension($path));
	}
}
