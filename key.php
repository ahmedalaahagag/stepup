<?php
/**
 * Created by PhpStorm.
 * User: AhmedAlaaHagag
 * Date: 12/27/2015
 * Time: 4:50 AM
 */
if (!file_exists('includes.php')) {
    throw new Exception("Include File not fountd");
} else {
    require_once('includes.php');
}
include_once('HttpRequest.php');
if($_REQUEST['code'])
{
    $code = $_REQUEST['code'];
    $url="https://api.moves-app.com/oauth/v1/access_token";
    $options['grant_type']=GRANTTYPE;
    $options['code']=$code;
    $options['client_id']=CLIENTID;
    $options['client_secret']=CLIENTSECRET;
    $http=new HttpRequest($url,$request_method = HTTP_METH_POST, $options);
    $response = $http->send();
    if($http->getResponseStatus()==200)
    {
        $response = $response->getBody();
        $db = new db();
        $response = json_decode($response);
        $db->save($response);
    }
    else{
        echo "Failed to request access token";
    }

}