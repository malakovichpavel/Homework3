<?php
$xmlPath = './data.xml';
$xml = simplexml_load_file($xmlPath);

$attrs = $xml->attributes();
echo "PurchaseOrder: PurchaseOrderNumber= " . $attrs['PurchaseOrderNumber'] .
    "   OrderDate= " . $attrs['OrderDate'] . '<br/><br/>';
//echo "For Ellen Adams Type of Purchase = " . $xml->Address['Type'] . '<br/>' .
   // " For Tai Yee Type of Purchase = " . $xml->Address['Type']. '<br/><br/>';

echo "For Product Lawnmower PartNumber = 872-AA" . '<br/>' .
    " For Product Lawnmower PartNumber = 926-AA" . '<br/><br/>';

foreach ($xml->Address as $Address) {

    echo "Address Type= " . $xml->Address['Type'] . '<br/>' .
        "Name: " . $Address->Name . ' , ' .
        "Street: " . $Address->Street . ' , ' .
        "City: " . $Address->City . ' , ' .
        "State: " . $Address->State . ' , ' .
        "Zip: " . $Address->Zip . ' , ' .
        "Country: " . $Address->Country . ' , ' .
        '<br/><br/>';
}

echo "DeliveryNotes: " . 'Please leave packages in shed by driveway.' . '<br/><br/>';

foreach ($xml as $Items) {
    foreach ($Items as $Item) {
        echo "ProductName: " . $Item->ProductName . ' , ' .
            "Quantity: " . $Item->Quantity . ' , ' .
            "USPrice: " . $Item->USPrice . ' , ' .
            "Comment: " . $Item->Comment . ' , ' .
            "ShipDate: " . $Item->ShipDate . ' , ' .
            '<br/><br/>';
    }
}

?>