<?php
/**
 * Created by PhpStorm.
 * User: AhmedAlaaHagag
 * Date: 12/27/2015
 * Time: 12:06 AM
 */
if (!file_exists('api.php')) {
    throw new Exception("API Class not fountd");
} else {
    require_once('api.php');
}
if (!file_exists('moves.php')) {
    throw new Exception("Moves Class not fountd");
} else {
    require_once('moves.php');
}
if (!file_exists('db.php')) {
    throw new Exception("Database Class not fountd");
} else {
    require_once('db.php');
}
if (!file_exists('user.php')) {
    throw new Exception("User Class not fountd");
} else {
    require_once('user.php');
}
?>