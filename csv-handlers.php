<?php

function csv_to_array($filename='', $delimiter=',')
{
	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	$header = NULL;
	$data = array();
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
		{
			if(!$header)
				$header = $row;
			else
				$data[] = array_combine($header, $row);
		}
		fclose($handle);
	}
	return $data;
}

function makeCSV($data, $filename)
{
	// open file for writing
	$fp = fopen($filename, 'w');
	
	// get array keys to turn it into the column names
	
	// check if the array is multi-dimensional...if so use the 2nd level as the columns
	$firstVal = array_slice($data,0,1);
	
	if (is_array($firstVal))
	{
		$fieldsArray = array_keys($firstVal[0]);
	}
	else{
		$fieldsArray = array_keys($data);
	}
    // put fields in the file
    fputcsv($fp, $fieldsArray);

    // put the whole array in the file
    foreach ($data as $fields)
    {
	   fputcsv($fp, $fields);
    }
	if (fclose($fp) == FALSE)
	{
		exit("CSV output file error");		
	}
	else{
		return $filename;
	}	
}

