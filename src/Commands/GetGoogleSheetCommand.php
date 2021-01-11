<?php

namespace FDC\Support\Commands;

use FDC\Sheets\Sheets;
use Illuminate\Console\Command;

class GetGoogleSheetCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'sheets:google';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import the current content of the configured Google Sheet.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @param Sheets $sheets
	 * @return int
	 */
	public function handle(Sheets $sheets)
	{
		dd($sheets->google($sheets->alias('upc'), 'Sheet1!A:H'));
	}
}
