<?php
/**
 * Created by PhpStorm.
 * User: AhmedAlaaHagag
 * Date: 12/25/2015
 * Time: 4:03 PM
 */

global $test;


// Walking Activities
  try {
      if (!file_exists('includes.php')) {
          throw new Exception("Include File not fountd");
      } else {
          require_once('includes.php');
      }
      // API REQUEST
      $url = $_SERVER['REQUEST_URI'];
      if (strpos($url, 'api') !== false) {
          $request = explode('/', $url);
          $request = array_slice($request, 3);
          $userid = $request[1];
          $db = new db();
          $users = new user($db);
          $users->setUserID($userid);
          $walkingActivites = $users->getUserWalkingActivity();
          echo(json_encode($walkingActivites));
          // NORMAL REQUEST get walking and save data to mysql
      } else {
          $api = new api();
          $db = new db();
          $users = new user($db);
          $users = $users->getUsers();
          foreach ($users as $user) {
              $api->setAccesstoken($user['access_token']);
              $moves = new moves($api, $db);
              $activites = $moves->getWalkingActivity('daily', '201512');
              $db->save($activites, 'activity');
          }
      }
  }
  catch
      (Exception $e) {
          echo "Message : " . $e->getMessage() . "<br>";
          echo "Code : " . $e->getCode();
      }
?>