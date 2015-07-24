<?php
//echo 'hello from get-song-data.php';

include 'setup.php'; 
$input = json_decode(file_get_contents('php://input'),true);

// get impressions
$query = $db->from('songs')
			->where('id',$input['song_id']);

foreach($query as $row) {
	$output[] = $row;
}

echo json_encode($output);

?>