<?php
/**
 * Created by PhpStorm.
 * User: huidaoli
 * Date: 2023/10/23
 * Time: 2:04 PM
 */

require_once __DIR__ . '/../autoload.php';

use Xhkj\Api\SupplyClient;

$appKey = "test"; 
$appSecret = "123456";

try {
	$supplyClient = new SupplyClient($appKey,$appSecret);
} catch (OssException $e) {
	printf(__FUNCTION__ . "creating supplyClient instance: FAILED\n");
	printf($e->getMessage() . "\n");
	return null;
}

//获取登录信息
$param = [];
$response = json_decode($supplyClient->getApiResponse("get","/api/base/userinfo",$param));

//用户退出
//$param = [];
//$response = json_decode($supplyClient->getApiResponse("post","/ssologin/logout",$param));

//用户退出
//$param = [];
//$response = json_decode($supplyClient->getApiResponse("post","/ssologin/logout",$param));

var_dump($response);