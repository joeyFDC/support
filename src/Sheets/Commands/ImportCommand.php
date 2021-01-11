<?php

namespace FDC\Sheets\Commands;

use FDC\Sheets\Sheets;
use Illuminate\Console\Command;

class ImportCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'sheets:import';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Read the contents of a csv, xls or xlsx file into an array.';

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
