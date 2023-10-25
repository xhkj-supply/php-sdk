<?php
/**
 * Created by PhpStorm.
 * User: huidaoli
 * Date: 2023/10/23
 * Time: 2:04 PM
 */

require_once __DIR__ . '/../autoload.php';

use Xhkj\Api\SupplyClient;

$appKey = ""; 
$appSecret = "";

try {
	$supplyClient = new SupplyClient($appKey,$appSecret);
} catch (OssException $e) {
	printf(__FUNCTION__ . "creating supplyClient instance: FAILED\n");
	printf($e->getMessage() . "\n");
	return null;
}

//刷新access_token接口
//$param = [];
//$response = json_decode($supplyClient->getApiResponse("post","/ssologin/refreshtoken",$param));

//获取登录信息
$param = [];
$response = json_decode($supplyClient->getApiResponse("post","/api/base/userinfo",$param));

//用户退出
//$param = [];
//$response = json_decode($supplyClient->getApiResponse("post","/ssologin/logout",$param));

//获取当前登录用户关联的团队用户信息
//$param = [];
//$response = json_decode($supplyClient->getApiResponse("post","/api/base/bindteamuser",$param));

//根据当前登录用户获取部门列表
//$param = [];
//$response = json_decode($supplyClient->getApiResponse("post","/api/dept/deptAuthChild",$param));

var_dump($response);