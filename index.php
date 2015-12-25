<?php
/**
 * Created by PhpStorm.
 * User: AhmedAlaaHagag
 * Date: 12/25/2015
 * Time: 4:03 PM
 */
// TODO : user class
// TODO : Tokens to database
try{
    if (!file_exists('api.php' )){
        throw new Exception("API Class not fountd");
    }else{
        require_once('api.php');
    }
    if (!file_exists('moves.php' )){
        throw new Exception("Moves Class not fountd");
    }else{
        require_once('moves.php');
    }
    if (!file_exists('db.php' )){
        throw new Exception("Database Class not fountd");
    }else{
        require_once('db.php');
    }
$api = new api();
$db= new db();
$moves = new moves($api,$db);
$walkingActivites = $moves->getWalkingActivity('daily','201512');
$db->save($walkingActivites,'activity');
}
catch(Exception $e)
{
    echo "Message : " . $e->getMessage() ."<br>";
    echo "Code : " . $e->getCode();
}
?>