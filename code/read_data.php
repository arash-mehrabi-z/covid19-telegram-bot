<?php

function read_country_status($filename, $country) {

	//Countries statistics
	$statistics = [];
	// Open the file for reading
	if (($h = fopen("{$filename}", "r")) !== FALSE) 
	{
	// Each line in the file is converted into an individual array that we call $data
	// The items of the array are comma separated
	while (($data = fgetcsv($h, 1000, ",")) !== FALSE) 
	{
		// Each individual array is being pushed into the nested array
		if($data[1] == $country) {
			$statistics = $data ;
		}	
	}

	// Close the file
	fclose($h);
	return $statistics;
	} else {

	}
}


?>