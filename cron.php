<?php
/**
 * Created by PhpStorm.
 * User: AhmedAlaaHagag
 * Date: 12/27/2015
 * Time: 1:04 AM
 */

// Runs Every 2 hours (can be done with cron job on live server)
$interval = 120;
set_time_limit(0);
while (true) {
    $now = time();
    try {
        if (!file_exists('includes.php')) {
            throw new Exception("Include File not fountd");
        } else {
            require_once('includes.php');
        }
        $api = new api();
        $db = new db();
        $users = new user($db);
        $moves = new moves($api, $db);
        $authorizedUsers = $users->getUsers();
        foreach ($authorizedUsers as $user) {

            $api->setAccesstoken($user['access_token']);
            $moves->setUserID($user['user_id']);
            $users->setUserID($user['user_id']);
            $date = date("Y-m-d");
            // If activity found today not to be duplicated
            $activityFound = $users->hasActivityToday($date);
            if($activityFound > 0){
                $users->removeActivites($date);
            }
            $activites = $moves->getActivities('daily', $date);
            $db->save($activites,'activity');
        }
    } catch (Exception $e) {
        echo "Message : " . $e->getMessage() . "<br>";
        echo "Code : " . $e->getCode();
    }
    sleep($interval * 60 - (time() - $now));
}
?>