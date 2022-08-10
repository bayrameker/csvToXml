<?php

function convertTxtToXmlFile($input_file, $output_file) {
    // Dosyamızı okuyoruz 
    $inputFile  = fopen(__DIR__ .$input_file, 'rt');
    
    // Dosyamızın header kısmını çekiyoruz
    $headers = fgetcsv($inputFile,1000,";");
    
    
    // Yeni döküman oluşturuyoruz
    $doc  = new DomDocument();
    $doc->formatOutput   = true;
    
    // Ana etiketimizi tanımlıyoruz
    $root = $doc->createElement('order');
    $root = $doc->appendChild($root);

    $sayac= 0;
    //
   $row = fgetcsv($inputFile,1000,";");
        
       
            $container = $doc->createElement('header');
        foreach($headers as $i => $header)
        {
            $child = $doc->createElement($header);
            $child = $container->appendChild($child);
            $value = $doc->createTextNode($row[$i]);
            $value = $child->appendChild($value);

        }
            $root->appendChild($container);

            $container1 = $doc->createElement('lines');

        $headers2 = fgetcsv($inputFile,1000,";");

        
        while (($row2 = fgetcsv($inputFile,1000,";")) !== FALSE)
        {
        $container2 = $doc->createElement('line');
        $container2 = $container1->appendChild($container2);

             
             foreach($headers2 as $i => $line)
        {
            $child1 = $doc->createElement($line);
            $child1 = $container2->appendChild($child1);
            $value1 = $doc->createTextNode($row2[$i]);
            $value1 = $child1->appendChild($value1);
        }

             }
              $root->appendChild($container1);
    $strxml = $doc->saveXML();
    
    $handle = fopen(__DIR__ .$output_file, "w");
    fwrite($handle, $strxml);
    fclose($handle);
}
convertTxtToXmlFile("../input/input.txt", "../output/output.xml");