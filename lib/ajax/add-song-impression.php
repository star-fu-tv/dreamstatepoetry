<?php
//echo 'hello from get-song-data.php';

include 'setup.php'; 
$input = json_decode(file_get_contents('php://input'),true);

// get impressions
// $query = $db->from('song_fragment_descriptor')
// 			->where('song_id',$input['song_id']);

// foreach($query as $row) {
// 	$output[] = $row;
// }

// echo json_encode($output);

?>