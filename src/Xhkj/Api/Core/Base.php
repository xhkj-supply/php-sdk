<?php
/**
 * Created by PhpStorm.
 * User: huidaoli
 * Date: 2023/10/23
 * Time: 2:04 PM
 */

namespace Xhkj\Api\Core;

class Base
{
	public $app_secret  = '';

	public $app_key = '';

	public $paramMap = array();

	public $body = '';

	public $serverRoot = 'http://ju.wzzd.cn';


	public function __construct($app_secret, $app_key)
	{

		if(!empty($serverRoot)){
			$this->serverRoot = $serverRoot;
		}

		if(!empty($app_secret)){
			$this->app_secret = $app_secret;
		}
		if(!empty($app_key)){
			$this->app_key = $app_key;
		}

		if(!empty($app_key)){
			$this->paramMap['Api-App-Key'] = $app_key;
		}

		$this->paramMap['X-Token'] = "";


		$this->preventAttack();

	}


	//防止同源攻击
	public function preventAttack()
	{
		//加入毫秒时间戳POST参数
		$this->paramMap['Api-Time-Stamp'] = $this->getMillisecond();

		$this->paramMap['Api-Nonce'] = $this->setOnnce();

	}


	/**
	 * 获取时间戳到毫秒
	 * @return bool|string
	 */
	public static function getMillisecond()
	{
		list($msec, $sec) = explode(' ', microtime());
		$msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
		$msectime = self::NumToStr($msectime);
		return $msectimes = substr($msectime, 0, 13);
	}

	//时间戳及密钥MD5
	public function setOnnce()
	{
		return md5($this->paramMap['Api-App-Key'] . $this->paramMap['Api-Time-Stamp']);
	}

	//单个添加参数
	public function addParam($key,$values)
	{
		$addParam = array($key=>$values);
		$this->paramMap = array_merge($this->paramMap,$addParam);
	}

	//设置body
	public function addBody($body)
	{
		$this->body = $body;
	}

	//批量添加参数
	public function batchAddParam($param)
	{
		$this->paramMap = array_merge($this->paramMap,$param);
	}

	//移除参数
	public function removeParam($key)
	{
		foreach ($this->paramMap as $k => $v){
			if($key == $k){
				unset($this->paramMap[$k]);
			}
		}
	}

	//移除全部参数
	public function removeAllParam()
	{
		foreach ($this->paramMap as $k => $v){
			if($k!='Api-App-Key'){
				unset($this->paramMap[$k]);
			}
		}
		$this->preventAttack();
	}

	//获取参数
	public function getParam($key)
	{
		return $this->paramMap[$key];
	}

	//获取全部参数
	public function getAllParam()
	{
		return $this->paramMap;
	}

	//获取服务器Root
	public function getServerRoot()
	{
		return $this->serverRoot;
	}

	//获取AppKey
	public function getAppKey()
	{
		return  $this->paramMap['Api-App-Key'];
	}

	//获取AppSecret
	public function getAppSecret()
	{
		return $this->app_secret;
	}

	/**
	 * 将参数转换成k=v拼接的形式
	 */
	public function toQueryString()
	{
		$StrQuery="";
		foreach ($this->paramMap as $k=>$v){
			$StrQuery .= strlen($StrQuery) == 0 ? "" : "&";
			$StrQuery.=$k."=".urlencode($v);
		}
		return $StrQuery;
	}

	/**
	 * 科学计数法，还原成字符串
	 */
	static function NumToStr($num){
		if (stripos($num,'e')===false) return $num;
		$num = trim(preg_replace('/[=\'"]/','',$num,1),'"');//出现科学计数法，还原成字符串
		$result = "";
		while ($num > 0){
			$v = $num - floor($num / 10)*10;
			$num = floor($num / 10);
			$result   =   $v . $result;
		}
		return $result;
	}

}