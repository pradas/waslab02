<?php

$URI = 'http://localhost:8080/waslab02/wall.php';
$resp = file_get_contents($URI);

echo $http_response_header[0], "\n"; // Print the first HTTP response header

//Task 3
$tweets = new SimpleXMLElement($resp);

foreach ($tweets->tweet as $tweet) {
	echo "[tweet #" . $tweet["id"] . "] " . $tweet->author. ": " . $tweet->text;
	echo " [" . $tweet->time . "]";
	echo "\n";
}

//Task 4
$resp = new SimpleXMLElement("<tweet></tweet>");
$resp->author = "Winston Churchill";
$resp->text = "Empires of the future will be empires of the mind.";

$postdata = $resp->asXML();

$opts = array('http' =>
    array(
        'method'  => 'PUT',
        'header'  => 'Content-type: text/xml',
        'content' => $postdata
    )
);

$context = stream_context_create($opts);
$result = file_get_contents($URI, false, $context);
echo $result;

//Task 5
$opts = array('http' =>
    array(
        'method'  => 'DELETE',
    )
);

$context = stream_context_create($opts);
$result = file_get_contents("http://localhost:8080/waslab02/wall.php?twid=9", false, $context);
echo $result;
?>