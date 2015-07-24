<?php

include 'setup.php';

//if($DEBUG) { 
	//echo 'hello from get-songs.php';// }


$query = $db->from('songs');

foreach($query as $row) {
	$output[] = $row;
}
//pretty_var_dump($output);
echo json_encode($output);

?>