<?
// Index
/* ---------------------------------------- */
/* - Setup
/* - Routes
/* - REST api
*/


/* ---------------------------------------------------------------------------- */
// Setup
/* ---------------------------------------------------------------------------- */

/* Require Slim and plugins */
require 'Slim/Slim.php';
require 'NotORM.php';
require 'lib/ajax/FluentPDO/FluentPDO.php';
include 'tools.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
    'debug' => true,
    'templates.path' => 'views/'
));

// Database Configuration 
/* ---------------------------------------- */
$dbhost   = 'localhost';
$dbuser   = 'root';
$dbpass   = 'root';
$dbname   = 'songwriter';
$dbmethod = 'mysql:dbname=';

// $dsn = $dbmethod.$dbname;
// $pdo = new PDO($dsn, $dbuser, $dbpass);
// $db = new NotORM($pdo);

/* create database object */
$pdo = new PDO("mysql:dbname=songwriter", "root", "root");
$db = new FluentPDO($pdo);


// Hooks and custom filters
/* ---------------------------------------- */
$app->hook('slim.before', function () use ($app) {
    $app->view()->appendData(array('baseUrl' => '/localhost:8888/dreamstatepoetry'));
});


/* ---------------------------------------------------------------------------- */
// Routes
/* ---------------------------------------------------------------------------- */

/* ---------------- Home page ----------------*/
$app->get('/home', function() use($app, $db, $pdo){
    $app->render('header.php', array('name' => 'Nia nia', 'url' => 'niabot.com'));
});

/* ---------------- Edit song ---------------- */
$app->get('/edit-song/:id', function($id) use($app, $db, $pdo){
    // get info from db
    $song = $db->songs()->where('id', $id);
    if($data = $song->fetch()){
        $_song = array(
            'id' => $data['id'],
            'title' => $data['title']
        );
    };
    $app->render('header.php');
    $app->render('edit-song-nav.php', array('song' => $_song));
    $app->render('edit-song-info.php', array('song' => $_song));

});

/* ---------------- Edit song info ---------------- */
$app->get('/edit-song-info/:id', function($id) use($app, $db, $pdo){
    
    $song = $db->songs()->where('id', $id);
    if($data = $song->fetch()){
        $_song = array(
            'id' => $data['id'],
            'title' => $data['title']
        );
    };
    $app->render('header.php');
    $app->render('edit-song-nav.php', array('song' => $_song));
    $app->render('edit-song-info.php', array('song' => $_song));

});

/* ---------------- Edit song fragments---------------- */
$app->get('/edit-song-fragments/:id', function($id) use($app, $db, $pdo){
    // Get song info
    $song = $db->songs()->where('id', $id);
    if($data = $song->fetch()){
        $_song = array(
            'id' => $data['id'],
            'title' => $data['title']
        );
    };
    // get all impressions related to this song
    $impressions = array();
    foreach($db->impressions()->where('song_id', $id) as $impression) {
        foreach($db->fragments()->where('id', $impression['fragment_id']) as $fragment) {
            $impressions[] = array(
                'fragment_id' => $impression['fragment_id'],
                'descriptor_id' => $impression['descriptor_id'],
                'fragment_text' => $fragment['text'],
                );
        };
    };


    $fragments = array();
    foreach ($db->fragments() as $fragment) {
        $fragments[]  = array(
            'id' => $fragment['id'],
            'text' => $fragment['text']
        );
    };    
    // Get descriptors and related fragments
    $descriptors = array();
    $descriptor_type = "shine on";
    foreach($db->descriptors() as $descriptor) {
            $d_id = intval($descriptor['id']);
            if($d_id < 6)                { $descriptor_type = "content"; };
            if(6 < $d_id && $d_id < 12 ) { $descriptor_type = "senses"; };
            if(12 < $d_id)               { $descriptor_type = "thoughts"; };        
            $descriptors[] = array(
                'id' => $descriptor['id'],
                'name' => $descriptor['name'],
                'descriptor_type' => $descriptor_type,                
                // 'fragments' => $fragments // $fragments= id + text 
            );
    };

    $app->render('header.php');
    $app->render('edit-song-nav.php', array('song' => $_song));
    $app->render('edit-song-fragments.php', array('song' => $_song, 'fragments' => $fragments,
                                                  'descriptors' => $descriptors, 'impressions' => $impressions));

});


/* ---------------------------------------------------------------------------- */
// RESTful : keep it chill
/* ---------------------------------------------------------------------------- */

/* ---------------------------------------- */ 
// Songs
/* ---------------------------------------- */ 
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
            'message' => "Song ID $id does not exist"
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
   // echo json_encode($app->request()->post());
    $new_fragment = $app->request()->post();
    $new_frag_id = $db->fragments->insert("blah");
    //$new_frag_id = $db->fragments->insert($new_fragment['text']);
    //echo $new_frag_id;
    echo json_encode($new_frag_id);
   // $result = $db->fragments->insert($fragment);
    // echo json_encode(array('id' => $result['id']));
    //pretty_var_dump($new_fragment);
    //echo json_encode($new_fragment);
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
