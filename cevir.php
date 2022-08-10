<?php

function convertCsvToXmlFile($input_file, $output_file) { 	
// Open csv file for reading 	
	$inputFile  = fopen(__DIR__ .$input_file, 'rt');
	 $headers = explode(';', array_shift($inputFile));
	 		$doc  = new DomDocument();
	$doc->formatOutput   = true;
	 		$root = $doc->createElement('policies');
	$root = $doc->appendChild($root);
	 	// Loop through each row creating a <policy>
	 		foreach ($lines as $line) 	{ 		$row = str_getcsv($line);
		$container = $doc->createElement('policy');
		 		foreach($headers as $i =>
$header) 		{ 			$child = $doc->createElement($header);
			$child = $container->appendChild($child);
			$value = $doc->createTextNode($row[$i]);
			$value = $child->appendChild($value);
		} 		$root->appendChild($container);
	} 	 	$strxml = $doc->saveXML();
	 	echo $strxml;


	 	$handle = fopen(__DIR__ .$output_file, "w");
	fwrite($handle, $strxml);
	fclose($handle);
}
convertCsvToXmlFile("../input/input.txt", "../output/output.xml");