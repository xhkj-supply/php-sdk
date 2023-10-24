
## xhkj-supply-php-sdk

xhkj-supply-php-sdk是序航科技官方SDK的Composer封装，支持php项目的云平台API对接。
## 安装

* 通过composer，这是推荐的方式，可以使用composer.json 声明依赖，或者运行下面的命令。
```bash
$ composer require xhkj-supply/php-sdk
```
* 直接下载安装，SDK 没有依赖其他第三方库，但需要参照 composer的autoloader，增加一个自己的autoloader程序。

## 运行环境

    php: >=7.0

## 使用方法

```php    

	/**
	 * Created by PhpStorm.
	 * User: huidaoli
	 * Date: 2023/10/23
	 * Time: 2:04 PM
	 */

	use Xhkj\Api\SupplyClient;

	$appKey = "your appkey";
	$appSecret = "your appSecret";

	try {
		$supplyClient = new SupplyClient($appKey,$appSecret);
	} catch (OssException $e) {
		printf(__FUNCTION__ . "creating supplyClient instance: FAILED\n");
		printf($e->getMessage() . "\n");
		return null;
	}

	$param = [
		
	];
	$response = json_decode($supplyClient->getApiResponse("get","/api/base/userinfo",$param));

```    

## 云平台

官网网址 http://ju.wzzd.cn  
