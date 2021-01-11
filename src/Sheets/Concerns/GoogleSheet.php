<?php

namespace FDC\Sheets\Concerns;

interface GoogleSheet
{
	/**
	 * Get the Google Sheet ID
	 *
	 * @return string
	 */
	public function googleSheetId(): string;

	/**
	 * Get the range to read.
	 *
	 * @return string
	 */
	public function googleSheetRange(): string;
}
