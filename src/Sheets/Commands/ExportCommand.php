<?php

namespace FDC\Sheets\Commands;

use FDC\Sheets\Sheets;
use Illuminate\Console\Command;

class ExportCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'sheets:export
							{source	 :  Path to a json file
							{path    :  Path the exported document is stored to}
							{--disk= :  Store a filesystem disk}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Export contents of a json file to an xlsx, xls or csv file.';

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
	 * Dump the contents of a file as an array.
	 *
	 * @param Sheets $sheets
	 * @return void
	 */
	public function handle(Sheets $sheets): void
	{
		//
	}
}
