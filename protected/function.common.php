<?php
/**
  * This is the shortcut to DIRECTORY_SEPARATOR
  */
defined('DS') or define('DS',DIRECTORY_SEPARATOR);

defined('NOW') or define('NOW', time());

defined('MTIME') or define('MTIME', intval(microtime(true)));//返回当前unix时间戳
/**
  * This is the shortcut to Yii::app()
  */
function app()
{
 return Yii::app();
}

/**
  * This is the shortcut to Yii::app()->clientScript
  */
function cs()
{
     // You could also call the client script instance via Yii::app()->clientScript
     // But this is faster
     return Yii::app()->getClientScript();
}
function MediaUrl($filename,$path="imgs/")
{
	return baseDir()."/$path".$filename;
}
/**
 * This is the shortcut to Yii::app()->user.
 * @return CWebUser 
 */
function user()
{
     return Yii::app()->getUser();
}

function lang($key,$param=array(),$file="")
{
	$file = $file ? $file : Yii::app()->controller->id . "_" . app()->controller->getAction()->getId();
	return Yii::t($file, $key, $param);
}
/**
  * This is the shortcut to Yii::app()->createUrl()
  */
function url( $route , $params = "", $ampersand = '&' )
{
	$params = is_array($params) ? $params : array();
	if ($_GET['handlekey']) {$params['handlekey'] = $_GET['handlekey'];}
	//if ($_GET['inajax']) {$params['inajax'] = $_GET['inajax'];}
	//if ($_GET['ajaxtarget']) {$params['ajaxtarget'] = $_GET['ajaxtarget'];}
	if (IS_PRODUCT){
		$route = trim($route,"/");
		$str = http_build_query($params);
		$str = $str ? "?$str" : "";
		return "/{$route}/$str";	
	}
	else{
		return Yii::app()->createUrl( $route , $params , $ampersand );	
	}
    
}

/**
  * This is the shortcut to CHtml::encode
  */
/* function h( $text )
{
     return htmlspecialchars( $text ,ENT_QUOTES,Yii::app()->charset);
} */

/**
  * This is the shortcut to Yii::app()->request->baseUrl
  * If the parameter is given, it will be returned and prefixed with the app baseUrl.
  */
function baseDir( $url =null)
{
     //static $baseUrl = null;
     //if ( $baseUrl ===null)
   	 if (IS_PRODUCT){
   		return ""; 	
   	 }  else{
   	 	$baseUrl =Yii::app()->getRequest()->getBaseUrl();
     	return $url ===null ?  $baseUrl :  $baseUrl . '/' .ltrim( $url , '/' );	
   	 }
     
   	
}

/**
  * Returns the named application parameter.
  * This is the shortcut to Yii::app()->params[$name].
  */
function param( $name )
{
     return Yii::app()->params[ $name ];
}
/**
  * A useful one that I use in development is the following
  * which dumps the target with syntax highlighting on by default
  */
function dump( $target )
{
   return CVarDumper::dump( $target , 10, true) ;
}

function mk_dir($dir, $mode = 0777)
{
 if (is_dir($dir) || @mkdir($dir,$mode)) return true;
 if (!mk_dir(dirname($dir),$mode)) return false;
 return @mkdir($dir,$mode);
}

function showmsg($msg,$url='',$typearr=array(),$param=array())
{
	$id = 'site';
	$a = new Controller($id);
	$param=ShowMessage::show($msg, $url,$param,$typearr);
	$a->render($param['render'],$param);
	die;
}
function showpop($msg,$url='',$params=array())
{
	$param['closetime'] = $params['time'] ? $params['time'] : 3;
	$param['showdialog'] = 1;
	showmsg($msg, $url ,$param,$params);
}
function showAutoRediect($msg,$url='',$params=array())
{
	$param['locationtime'] = $params['time']!==null ? (int)$params['time'] : 3;
	$param['showdialog'] = 1;
	showmsg($msg, $url ,$param,$params);
}
function showDialog($msg,$url='',$params=array())
{
	$param['showdialog'] = 1;
	showmsg($msg, $url ,$param,$params);
}
function showPostRediect($url)
{
	showmsg($msg, url($url) ,array('postRediect'=>1));
}



function showError($msg="",$param="")
{
	$msg = $msg ? $msg : 'throw error here';
	$param = is_array($param) ? $param : array();
	throw new CException(Yii::t('yii', $msg,$param));
}

function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) 
{
	$ckey_length = 4;

	$key = md5($key ? $key : "X%@JHD%^&UDRKLJklewjrnusSUh");
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}

function isErrorClass($label,&$formObj,$return=false)
{
	if ($return){
		return $formObj->getError($label) === null;
	}else{
		echo $formObj->getError($label) === null ? "" : 'class="error"';
	}
}

function closeFloatWindow()
{
	if ($_REQUEST['handlekey'] && $_REQUEST['infloat']){
		return '<a href="javascript:;" class="flbc" ></a>';//onclick="hideWindow(\''.$_REQUEST["handlekey"].'\')"
	}
}

function showFormHead($action="",$method="get",$htmloption=array()){
	if ($_REQUEST['inajax']==2){
		$htmloption['onSubmit'] = "ajaxpost(this.id,'main','{$htmloption['key']}');return false;";
	}
	foreach ($htmloption as $k => $v){
		$html .= " ".$k."=\"".$v."\" ";
	}
	echo "<form action='$action' method='$method' $html>";
}

function mydate($time,$format="Y-m-d H:i:s")
{
	return date($format,$time);
}

function fopenSocket($url, $limit = 0, $post = '', $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 15, $block = TRUE) {
    $return = '';
	$matches = parse_url($url);
	!isset($matches['host']) && $matches['host'] = '';
	!isset($matches['path']) && $matches['path'] = '';
	!isset($matches['query']) && $matches['query'] = '';
	!isset($matches['port']) && $matches['port'] = '';
	$host = $matches['host'];
	$path = $matches['path'] ? $matches['path'].($matches['query'] ? '?'.$matches['query'] : '') : '/';
	$port = !empty($matches['port']) ? $matches['port'] : 80;
	if($post) {
		$out = "POST $path HTTP/1.0\r\n";
		$out .= "Accept: */*\r\n";
		//$out .= "Referer: $boardurl\r\n";
		$out .= "Accept-Language: zh-cn\r\n";
		$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
		$out .= "Host: $host\r\n";
		$out .= 'Content-Length: '.strlen($post)."\r\n";
		$out .= "Connection: Close\r\n";
		$out .= "Cache-Control: no-cache\r\n";
		$out .= "Cookie: $cookie\r\n\r\n";
		$out .= $post;
	} else {
		$out = "GET $path HTTP/1.0\r\n";
		$out .= "Accept: */*\r\n";
		//$out .= "Referer: $boardurl\r\n";
		$out .= "Accept-Language: zh-cn\r\n";
		$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
		$out .= "Host: $host\r\n";
		$out .= "Connection: Close\r\n";
		$out .= "Cookie: $cookie\r\n\r\n";
	}

	if(function_exists('fsockopen')) {
		$fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
	} elseif (function_exists('pfsockopen')) {
		$fp = @pfsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
	} else {
		$fp = false;
	}

	if(!$fp) {
		return '';
	} else {
		stream_set_blocking($fp, $block);
		stream_set_timeout($fp, $timeout);
		@fwrite($fp, $out);
		$status = stream_get_meta_data($fp);
		if(!$status['timed_out']) {
			while (!feof($fp)) {
				if(($header = @fgets($fp)) && ($header == "\r\n" ||  $header == "\n")) {
					break;
				}
			}

			$stop = false;
			while(!feof($fp) && !$stop) {
				$data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
				$return .= $data;
				if($limit) {
					$limit -= strlen($data);
					$stop = $limit <= 0;
				}
			}
		}
		@fclose($fp);
		return $return;
	}
}
