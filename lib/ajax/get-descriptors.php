<?php
//echo 'hello from get-descriptors.php';

include 'setup.php'; 
//$input = json_decode(file_get_contents('php://input'),true);

// get impressions
$query = $db->from('descriptors');

foreach($query as $row) {
	$output[] = $row;
}

echo json_encode($output);

?>