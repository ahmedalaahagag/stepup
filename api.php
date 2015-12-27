<?php

/**
 * Created by PhpStorm.
 * User: AhmedAlaaHagag
 * Date: 12/25/2015
 * Time: 3:43 PM
 */
class api
{
    private $baseurl;
    private $accesstoken;

    function __construct()
    {
        $this->baseurl = 'https://api.moves-app.com/api/1.1/user/';
        $this->accesstoken = '?access_token=waR9B4PVm5p9b1ot2Mb0n26H_6iKsBW59o5r_b8A1KExIyzIqSoB78tTzeck0c0t';
    }

    public function getRequest($action, $period, $date)
    {
        $url = $this->forgeURL($action, $period, $date);
        // Change to json.json for more data
        $response = $this->returnResponse($url);
        //$response = $this->returnResponse('json.json');
        return $response;
    }

    private function forgeURL($action, $period, $date)
    {
        $requestURL = $this->baseurl . $action . '/' . $period . '/' . $date . $this->accesstoken;
        return $requestURL;
    }

    private function returnResponse($url)
    {
        $jsonResponse = file_get_contents($url);
        $arrayResponse = json_decode($jsonResponse);
        return $arrayResponse;
    }

    /**
     * @return string
     */
    public function getBaseurl()
    {
        return $this->baseurl;
    }

    /**
     * @param string $baseurl
     */
    public function setBaseurl($baseurl)
    {
        $this->baseurl = $baseurl;
    }

    /**
     * @return string
     */
    public function getAccesstoken()
    {
        return $this->accesstoken;
    }

    /**
     * @param string $accesstoken
     */
    public function setAccesstoken($accesstoken)
    {
        $this->accesstoken = '?access_token='.$accesstoken;
    }
}