<?php

/**
 * Created by PhpStorm.
 * User: AhmedAlaaHagag
 * Date: 12/26/2015
 * Time: 11:59 PM
 */
class user
{
    private $userID;
    private $accessToken;
    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function hasActivityToday($date)
    {
        $where = "user_id= '".$this->userID."' AND date = '".$date."'";
        $activityFound = $this->db->count($where,'activity');
        if($activityFound > 0 )
            return 1;
        else
            return 0;
    }

    public function getUserWalkingActivity()
    {
        $where = "user_id= '" . $this->userID . "' AND activity='walking' ORDER BY `date`";
        $activities = $this->db->get($where, 'activity');
        for ($month = 1; $month <= 12; $month++) {
            $weekNumber=1;
            for ($day = 1; $day <= 31; $day++) {
                if($this->dayActivityList($day, $month, $activities))
                $dailyActivites['day'.$day]=$this->dayActivityList($day, $month, $activities);
                else
                $dailyActivites['day'.$day] ="";
               if ($day % 7 == 0 || $day==31)  {
                    $weekName = 'week'.$weekNumber;
                    $week[$weekName] = $dailyActivites;
                    $monthName = 'month'.$month;
                    $months[$monthName][] = $week[$weekName];
                    $weekNumber =$weekNumber+1;
                    $dailyActivites = array();
                }
            }

        }
        return $months;
    }

    private function dayActivityList($day,$month,$activityList){
        $date='2015-'.$month.'-'.$day;
        $dayActivityList = array();
        foreach($activityList as $activity){
            if($activity['date']==$date){
                $dayActivityList[]=$activity;
            }
        }
        return $dayActivityList;
    }


    public function removeActivites($date)
    {
        $where = "user_id= '".$this->userID."' AND date = '    ".$date."'";
        $deleted = $this->db->delete($where,'activity');
        if($deleted)
            return 1;
        else
            return 0 ;
    }

    public function getUsers()
    {
        $users = $this->db->get(1, 'users');
        return $users;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

}