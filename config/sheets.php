<?php

return [
	'readDisk' => 'local', // Default filesystem disk for writing files
	'readPath' => 'fdc', // Directory path (relative to disk root)
	'writeDisk' => 'local', // Default filesystem disk for writing files
	'writePath' => 'fdc', // Directory path (relative to disk root)

	//Storage locations for Google Sheets auth info
	'googleAccessToken' => storage_path('app/auth/gsAccessToken.json'),
	'googleAuthConfig' => storage_path('app/auth/gsAuthConfig.json'),

	// May assign an alias for commonly used sheets here, as `'alias' => 'google-sheet-id'`
	'alias' => [
		'upc' => '1-4zcaLXwZw6D6O31mY0TDOzn1b-IhXPxtBFuab4s4VY'
	]
];
