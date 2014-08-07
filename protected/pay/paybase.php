<?php
class paybase 
{
	public $sid;
	
	const PAY_SUCCESS 	= 	1;
	const PAY_FAIL		=	0;
	
	public function __construct($sid)
	{
		$this->sid = $sid;
	}
	
	protected function _hash($num="")
	{
		$str = "";
		$num = $num ? $num : 6;
		for ($i=0;$i<$num;++$i)
		{
			$str .= rand(0, 9);
		}
		return $str;
	}
	
	protected function getOrderID($uid="")
	{
		return $orderid = "7433CPS|".date('YMDhis').$this->_hash(6).$uid;
	}
	
	protected function format($arr)
	{
	    foreach($arr as $k=>$v){
	        $ret .= $fh.$k."=".$v;
	        $fh = "&";
	    }
	    return $ret;
	}
	
 	protected  function Curl($url)
     {
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_HEADER, 0);
         $output = curl_exec($ch);
         curl_close($ch); 
         return $output;
     }
     
     protected function log($url,$ret)
     {
     	Yii::log("\nREQ=>$url\nRET=>$ret\n", 'info','firstpay');
     }
}


class api 
{
    const LOGIN_KEY    = 'b4a104d94da24808fb8b9887afe7d187';                //此处填写登陆KEY
    const EXCHANGE_KEY = 'b312bcc162c2e443b9d20391fa5c7401';                //此处填写支付KEY
    const PLATFORM     = '7433';                //此处填写平台ID
    const DOMAIN       = 'gate.7433.com';                //此处填写网关域名如gate.wan.360.cn  gate.4399.com
    const GKEY         = 'sgh';            //此处填写游戏ID
    static $ALL_STAT   = array(0,1);
    /** 
        * @how do use:  api::login($uid,$skey,$is_adult,$back_url);
        * @param $uid 平台用户的唯一标识 
        * @param $skey 区服ID 
        * @param $is_adult 是否通过防沉迷 
        * @param $back_url 发生错误需要跳转的URL 
        * 
        * @return 返回游戏登陆的URL 
     */

    static public function login($uid,$skey,$is_adult,$back_url)
    {
        $time     = time();
        $back_url = urlencode($back_url);
        $sign     = self::loginSign($uid,$skey,$time,$is_adult);
        $url      = "http://".$skey.'.'.self::GKEY.'.'.self::DOMAIN."/login.html?uid=$uid&platform=".self::PLATFORM."&gkey=".self::GKEY."&skey=$skey&time=$time&is_adult=$is_adult&back_url=$back_url&sign=$sign";
        return $url;
    }
    static public function loginSign($uid,$skey,$time,$is_adult)
    {
        $str=$uid.self::PLATFORM.self::GKEY.$skey.$time.$is_adult.'#'.self::LOGIN_KEY;
        return md5($str);
    }

    /** 
        * @param $uid  平台用户的唯一标识
        * @param $skey 区服ID
        * @param $order_id 订单号，由平台方保证唯一性
        * @param $money 充值金额，单位元
        * @param $role_name 角色名称 可为空
        * @param $role_id  角色ID  可为空
        * 
        * @return 返回充值的URL; 
     */

    static public function exchange($uid,$skey,$order_id,$money,$role_name=null,$role_id=null)
    {
        $coins = $money * 10;
        $time  = time();
        $sign  = self::exchangeSign($uid,$skey,$time,$order_id,$money,$coins); 
        if($role_name) 
            $role_name = '&role_name='.urlencode($role_name);
        if($role_id) 
            $role_id   = '&role_id='.$role_id;
        $url   = "http://".$skey.'.'.self::GKEY.'.'.self::DOMAIN."/exchange.html?gkey=".self::GKEY."&skey=$skey&platform=".self::PLATFORM."&order_id=$order_id&uid=$uid&coins=$coins&money=$money&time=$time&sign=$sign".$role_name.$role_id;
        return $url;
    }
    static public function exchangeSign($uid,$skey,$time,$order_id,$money,$coins)
    {
        $str= $uid.self::PLATFORM.self::GKEY.$skey.$time.$order_id.$coins.$money.'#'.self::EXCHANGE_KEY;
        return md5($str);
    }
    static public function checkStat($res)
    {
        $obj = json_decode($res); 
        if(!is_object($obj))
            return false;
        if(in_array((int)$obj->errno,self::$ALL_STAT))
            return true;
        return false;
    }
    static public function checkUser($uid,$skey)
    {
        $time  = time();
        $sign  = self::checkUserSign($uid,$skey,$time);
        $url   = "http://".$skey.'.'.self::GKEY.'.'.self::DOMAIN."/checkuser.html?uid=$uid&platform=".self::PLATFORM."&gkey=".self::GKEY."&skey=$skey&time=$time&sign=$sign";
        return $url;
    }
    static public function checkUserSign($uid,$skey,$time)
    {
        $str=$uid.self::PLATFORM.self::GKEY.$skey.$time.'#'.self::LOGIN_KEY; 
        return md5($str);
    }
     static public function apiCurl($url)
     {
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_HEADER, 0);
         $output = curl_exec($ch);
         curl_close($ch); 
         return $output;
     }
}