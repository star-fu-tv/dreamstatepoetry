<?php
    require "FluentPDO/FluentPDO.php";
   
    /* print debug statements */
    $DEBUG = true;
  //  if($DEBUG) { echo 'hello from setup.php'; }
    
    /* create database object */
    $pdo = new PDO("mysql:dbname=songwriter", "root", "root");
    $db = new FluentPDO($pdo);

    /* pretty var dumps */
    function pretty_var_dump($data) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";  
    }    

?>

