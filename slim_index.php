<?
/* Require Slim and plugins */
require 'Slim/Slim.php';
require 'NotORM.php';

/* Register autoloader and instantiate Slim */
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

/* Database Configuration */
$dbhost   = 'localhost';
$dbuser   = 'root';
$dbpass   = 'root';
$dbname   = 'songwriter';
$dbmethod = 'mysql:dbname=';

$dsn = $dbmethod.$dbname;
$pdo = new PDO($dsn, $dbuser, $dbpass);
$db = new NotORM($pdo);

/* Routes */
$app->get('/', function() use($app, $db, $pdo){
    echo 'Heya Bb';
});

/* ~  Get all songs ~ */
/* ~ set up GET route ~*/
$app->get('/songs', function() use($app, $db, $pdo){
//    echo
    $songs = array();
    foreach ($db->songs() as $song) {
        $songs[]  = array(
            'id' => $song['id'],
            'title' => $song['title']
        );
    }
    $app->response()->header("Content-Type", "application/json");
    echo json_encode($songs, JSON_FORCE_OBJECT);
});

/* ~  Get a single song ~ */
$app->get('/songs/:id', function($id) use ($app, $db, $pdo) {
    $app->response()->header("Content-Type", "application/json");
    $song = $db->songs()->where('id', $id);
    if($data = $song->fetch()){
        echo json_encode(array(
            'id' => $data['id'],
            'title' => $data['title']
        ));
    }
    else{
        echo json_encode(array(
            'status' => false,
            'message' => "Car ID $id does not exist"
        ));
    }
});

/* ~  Create new song with POST ~ */
// e.g. year=1981&make=DeLorean&model=DMC-12 //
$app->post('/song', function() use($app, $db, $pdo){
    $app->response()->header("Content-Type", "application/json");
    $song = $app->request()->post();
    $result = $db->songs->insert($song);
    echo json_encode(array('id' => $result['id']));
});


/* ~ Update a song ~ */
$app->put('/song/:id', function($id) use($app, $db, $pdo){
    $app->response()->header("Content-Type", "application/json");
    $song = $db->songs()->where("id", $id);
    if ($song->fetch()) {
        $post = $app->request()->put();
        $result = $song->update($post);
        echo json_encode(array(
            "status" => (bool)$result,
            "message" => "Song updated successfully"
            ));
    }
    else{
        echo json_encode(array(
            "status" => false,
            "message" => "Song id $id does not exist"
        ));
    }
});

/* ~ Delete a song ~ */
$app->delete('/song/:id', function($id) use($app, $db, $pdo){
    $app->response()->header("Content-Type", "application/json");
    $song = $db->songs()->where('id', $id);
    if($song->fetch()){
        $result = $song->delete();
        echo json_encode(array(
            "status" => true,
            "message" => "Song deleted successfully"
        ));
    }
    else{
        echo json_encode(array(
            "status" => false,
            "message" => "Song id $id does not exist"
        ));
    }
});


/* Run the application */
$app->run();

?>
