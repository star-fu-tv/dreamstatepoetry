<?
// Index
/* ---------------------------------------- */
/* - Setup
/* - Routes
*/


/* ---------------------------------------------------------------------------- */
// Setup
/* ---------------------------------------------------------------------------- */

/* Require Slim and plugins */
require 'lib/Slim/Slim.php';
require 'lib/NotORM.php';

//require 'Slim-Views/Twig.php';


//Twig_Autoloader::register();
\Slim\Slim::registerAutoloader();

$twig= new \Slim\Views\Twig();

//$app = new \Slim\Slim();
$app = new \Slim\Slim(array(
    'debug' => true,
    'view' => $twig,
    'templates.path' => 'views/'
));


//$view = $app->view();
$twig->parserOptions = array(
    'debug' => true,
    'cache' => dirname(__FILE__) . '/cache'
);
/* Extensions */
$twig->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);
//$twig->setTemplatesDirectory($templatesPath);

// Database Configuration 
/* ---------------------------------------- */
$dbhost   = 'localhost';
$dbuser   = 'root';
$dbpass   = 'root';
$dbname   = 'songwriter';
$dbmethod = 'mysql:dbname=';

$dsn = $dbmethod.$dbname;
$pdo = new PDO($dsn, $dbuser, $dbpass);
$db = new NotORM($pdo);




/* ---------------------------------------------------------------------------- */
// Routes
/* ---------------------------------------------------------------------------- */

/* Index page :) */
$app->get('/', function() use($app, $db, $pdo){
    $app->render('header.php', array('name' => 'Nia nia', 'url' => 'niabot.com'));
    $app->render('song-list.php', array('name' => 'Nia nia', 'url' => 'niabot.com'));
    $app->render('footer.php', array('name' => 'Brian Nesbitt', 'url' => 'nesbot.com'));
});

/* Index page :) */
$app->get('/song/:id', function() use($app, $db, $pdo){
    $app->render('header.php', array('name' => 'Nia nia', 'url' => 'niabot.com'));
   // $app->render('song-list.php', array('name' => 'Nia nia', 'url' => 'niabot.com'));
    $app->render('footer.php', array('name' => 'Brian Nesbitt', 'url' => 'nesbot.com'));
});



/* ---------------------------------------------------------------------------- */
// RESTful : keep it chill
/* ---------------------------------------------------------------------------- */

/* ---------------------------------------- */ 
// Songs
/* ---------------------------------------- */ 
/* ~  Get all songs ~ */
/* ~ set up GET route ~*/
$app->get('songs', function() use($app, $db, $pdo){
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

// ~  Create new song with POST ~ */
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

/* ---------------------------------------- */ 
// Fragments
/* ---------------------------------------- */ 

/* ~  Get all fragments ~ */
/* ~ set up GET route ~*/
$app->get('/fragments', function() use($app, $db, $pdo){
//    echo
    $fragments = array();
    foreach ($db->fragments() as $fragment) {
        $fragments[]  = array(
            'id' => $fragment['id'],
            'text' => $fragment['text']
        );
    }
    $app->response()->header("Content-Type", "application/json");
    echo json_encode($fragments, JSON_FORCE_OBJECT);
});

/* ~  Get a single fragment ~ */
$app->get('/fragments/:id', function($id) use ($app, $db, $pdo) {
    $app->response()->header("Content-Type", "application/json");
    $fragment = $db->fragments()->where('id', $id);
    if($data = $fragment->fetch()){
        echo json_encode(array(
            'id' => $data['id'],
            'text' => $data['text']
        ));
    }
    else{
        echo json_encode(array(
            'status' => false,
            'message' => "Fragment ID $id does not exist"
        ));
    }
});

/* ~  Create new song with POST ~ */
// e.g. year=1981&make=DeLorean&model=DMC-12 //
$app->post('/fragment', function() use($app, $db, $pdo){
    $app->response()->header("Content-Type", "application/json");
    $fragment = $app->request()->post();
    $result = $db->fragments->insert($fragment);
    echo json_encode(array('id' => $result['id']));
});

/* ~ Update a song ~ */
$app->put('/fragment/:id', function($id) use($app, $db, $pdo){
    $app->response()->header("Content-Type", "application/json");
    $song = $db->fragment()->where("id", $id);
    if ($fragment->fetch()) {
        $post = $app->request()->put();
        $result = $fragment->update($post);
        echo json_encode(array(
            "status" => (bool)$result,
            "message" => "Fragment updated successfully"
            ));
    }
    else{
        echo json_encode(array(
            "status" => false,
            "message" => "Fragment id $id does not exist"
        ));
    }
});

/* ~ Delete a song ~ */
$app->delete('/fragment/:id', function($id) use($app, $db, $pdo){
    $app->response()->header("Content-Type", "application/json");
    $fragment = $db->fragments()->where('id', $id);
    if($fragment->fetch()){
        $result = $fragment->delete();
        echo json_encode(array(
            "status" => true,
            "message" => "Fragment deleted successfully"
        ));
    }
    else{
        echo json_encode(array(
            "status" => false,
            "message" => "Fragment id $id does not exist"
        ));
    }
});


/* Run the application */
$app->run();

?>
