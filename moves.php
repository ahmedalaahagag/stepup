<?php

/**
 * Created by PhpStorm.
 * User: AhmedAlaaHagag
 * Date: 12/25/2015
 * Time: 3:35 PM
 */
class moves
{
    private $action;
    private $date;
    private $period;
    private $distance;
    private $duration;
    private $steps;
    private $api;
    private $userID;



    private function getSummary($period, $date)
    {
        $this->setAction('summary');
        $this->setPeriod($period);
        $this->setDate($date);
        $summary = $this->api->getRequest($this->action, $this->period, $this->date);
        return $summary;
    }

    public function getWalkingActivity($period, $date)
    {
        $walkingActivitesArray = array();
        $summary = $this->getSummary($period, $date);
        foreach ($summary as $dailySummary) {
            $readableDate = implode("-", str_split($dailySummary->date, 4));
            $readableDate = implode("-", str_split($readableDate, 7));
            if (isset($dailySummary->summary)) {
                foreach ($dailySummary->summary as $activity) {

                    if (isset($activity->group) && $activity->group == 'walking') {
                        $walkingActivites ['activity'] = 'walking';
                        $walkingActivites ['date'] = $readableDate;
                        $walkingActivites ['duration'] = $activity->duration;
                        $walkingActivites ['steps'] = $activity->steps;
                        $walkingActivites ['distance'] = $activity->distance;
                        $walkingActivites ['user_id'] = $this->userID;
                        $walkingActivitesArray[] = $walkingActivites;
                    }
                }
            }
        }
        return $walkingActivitesArray;
    }

    public function getActivities($period, $date)
    {
        $dailyActivitesArray = array();
        $summary = $this->getSummary($period, $date);
        foreach ($summary as $dailySummary) {
            $readableDate = implode("-", str_split($dailySummary->date, 4));
            $readableDate = implode("-", str_split($readableDate, 7));
            if (isset($dailySummary->summary)) {
                foreach ($dailySummary->summary as $activity) {
                    if (isset($activity->activity)) {
                        $dailyActivites ['activity'] = $activity->activity;
                        $dailyActivites ['date'] = $readableDate;
                        if(isset($activity->steps))
                            $dailyActivites ['steps'] = $activity->steps;
                        else
                            $dailyActivites ['steps'] = 0;
                        $dailyActivites ['duration'] = $activity->duration;
                        if(isset($activity->steps))
                            $dailyActivites ['distance'] = $activity->distance;
                        else
                            $dailyActivites ['distance'] = 0;
                        $dailyActivites ['user_id'] = $this->userID;
                        $dailyActivitesArray[] = $dailyActivites;
                    }
                }
            }
        }
        return $dailyActivitesArray;
    }

    /**
     * @return mixed
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * @param mixed $steps
     */
    public function setSteps($steps)
    {
        $this->steps = $steps;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $action
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param mixed $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }

    /**
     * @return mixed
     */
    public function getuserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userid
     */
    public function setuserID($userID)
    {
        $this->userID = $userID;
    }

    function __construct($api)
    {
        $this->api = $api;
    }


}