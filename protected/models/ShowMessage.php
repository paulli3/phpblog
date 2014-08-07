<?php

class ShowMessage
{
	static function show($message, $url_forward = '', $values = array(), $extraparam = array(), $custom = 0) {
			
			if($extraparam['break']) {
				return;
			}
			
			//$_G['inshowmessage'] = true;
		
			$param = array(
				'header'	=> false,
				'timeout'	=> null,
				'refreshtime'	=> null,
				'closetime'	=> null,
				'locationtime'	=> null,
				'alert'		=> null,
				'return'	=> false,
				'redirectmsg'	=> 0,
				'msgtype'	=> 1,
				'showmsg'	=> true,
				'showdialog'	=> false,
				'login'		=> false,
				'handle'	=> false,
				'extrajs'	=> '',
				'striptags'	=> true,
				'postRediect' => 0, //ajaxpost 需要直接跳转的时候，使用
			);
		
			$navtitle = app()->name;
		
			if($custom) {
				$alerttype = 'alert_info';
				$show_message = $message;
				return array(
					'render' =>'common/showmessage',
					'param' => '',
				);
			}
		
			$handlekey = $leftmsg = '';
		
		
			if(empty($_REQUEST['inajax'])) {
				$param['header'] = true;
			}
			$_GET['handlekey'] = !empty($_GET['handlekey']) && preg_match('/^\w+$/', $_GET['handlekey']) ? $_GET['handlekey'] : '';
			if(!empty($_REQUEST['inajax'])) {
				$handlekey = $_GET['handlekey'] = !empty($_GET['handlekey']) ? htmlspecialchars($_GET['handlekey']) : '';
				$param['handle'] = true;
			}
			if(!empty($_REQUEST['inajax'])) {
				$param['msgtype'] = empty($_GET['ajaxmenu']) && (empty($_POST) || !empty($_GET['nopost'])) ? 2 : 3;
			}
			if($url_forward) {
				$param['timeout'] = true;
				if($param['handle'] && !empty($_REQUEST['inajax'])) {
					$param['showmsg'] = false;
				}
			}
		
			foreach($extraparam as $k => $v) {
				$param[$k] = $v;
			}
			if(array_key_exists('set', $extraparam)) {
				$setdata = array('1' => array('msgtype' => 3));
				if($setdata[$extraparam['set']]) {
					foreach($setdata[$extraparam['set']] as $k => $v) {
						$param[$k] = $v;
					}
				}
			}
			$timedefault = intval($param['refreshtime'] === null ? 3 : $param['refreshtime']);
			if($param['timeout'] !== null) {
				$refreshsecond = !empty($timedefault) ? $timedefault : 3;
				$refreshtime = $refreshsecond * 1000;
			} else {
				$refreshtime = $refreshsecond = 0;
			}
		
			if($param['login'] && user()->id || $url_forward) {
				$param['login'] = false;
			}
		
			$param['header'] = $url_forward && $param['header'] ? true : false;
		
			if($_GET['ajaxdata'] === 'json') {
				$param['header'] = '';
			}
		
			if($param['header']) {
				header("HTTP/1.1 301 Moved Permanently");
				header("location: ".str_replace('&amp;', '&', $url_forward));
			}
			$url_forward_js = addslashes(str_replace('\\', '%27', $url_forward));
			if($param['location'] && !empty($_REQUEST['inajax'])) {
//				include template('common/header_ajax');
//				echo '<script type="text/javascript" reload="1">window.location.href=\''.$url_forward_js.'\';</script>';
//				include template('common/footer_ajax');
//				dexit();
			}
		
			/**
			 * 语言包载入
			 */
			$LangFileNameDefault = $_ENV['LangFileDefault'];
			$langFile = $param['langfile'];
			$langFile = $langFile == '' ? $LangFileNameDefault : $langFile;
			$langFile = $langFile == '' ? 'showmsg' : $langFile;
			$msg = Yii::t($langFile,$message,$values);
			/*
			 * =============语言包载入完成================
			 */
			$show_message = $msg;
			
//			if(isset($_GET['ajaxdata'])) {
//				if($_GET['ajaxdata'] === 'json') {
//					helper_output::json(array('message' => $show_message, 'data' => $values));
//				} else if($_GET['ajaxdata'] === 'html') {
//					helper_output::html($show_message);
//				}
//			}
		
		
			$show_jsmessage = str_replace("'", "\\'", $param['striptags'] ? strip_tags($show_message) : $show_message);
		
			if((!$param['showmsg'] || $param['showid']) && !defined('IN_MOBILE') ) {
				$show_message = '';
			}
		
			$allowreturn = !$param['timeout'] && !$url_forward && !$param['login'] || $param['return'] ? true : false;
			if($param['alert'] === null) {
				$alerttype = $url_forward ? (preg_match('/(succeed|success)$/', $message) ? 'alert_right' : 'alert_info') : ($allowreturn ? 'alert_error' : 'alert_info');
			} else {
				$alerttype = 'alert_'.$param['alert'];
			}
		
			$extra = '';
			if($param['showid']) {
				$extra .= '$(\''.$param['showid'].'\').html(\''.$show_jsmessage.'\');';
			}
			if($param['handle']) {
				$valuesjs = $comma = $subjs = '';
				foreach($values as $k => $v) {
					$v = addslashes($v);
					if(is_array($v)) {
						$subcomma = '';
						foreach ($v as $subk => $subv) {
							$subjs .= $subcomma.'\''.$subk.'\':\''.$subv.'\'';
							$subcomma = ',';
						}
						$valuesjs .= $comma.'\''.$k.'\':{'.$subjs.'}';
					} else {
						$valuesjs .= $comma.'\''.$k.'\':\''.$v.'\'';
					}
					$comma = ',';
				}
				$valuesjs = '{'.$valuesjs.'}';
				if($url_forward) {
					$extra .= 'if(typeof succeedhandle_'.$handlekey.'==\'function\') {succeedhandle_'.$handlekey.'(\''.$url_forward_js.'\', \''.$show_jsmessage.'\', '.$valuesjs.');}';
				} else {
					$extra .= 'if(typeof errorhandle_'.$handlekey.'==\'function\') {errorhandle_'.$handlekey.'(\''.$show_jsmessage.'\', '.$valuesjs.');}';
				}
			}
			if($param['closetime'] !== null) {
				$param['closetime'] = $param['closetime'] === true ? $timedefault : $param['closetime'];
			}
			if($param['locationtime'] !== null) {
				$param['locationtime'] = $param['locationtime'] === true ? $timedefault : $param['locationtime'];
			}
			
			
				
				if($param['hidewindow']) {
					
				}else if($param['showdialog']) {
					$modes = array('alert_error' => 'alert', 'alert_right' => 'right', 'alert_info' => 'notice');
					$extra .= 'hideWindow(\''.$handlekey.'\');showDialog(\''.$show_jsmessage.'\', \''.$modes[$alerttype].'\', null, '.($param['locationtime'] !== null ? 'function () { window.location.href =\''.$url_forward_js.'\'; }' : 'null').', 0, null, null, null, null, '.($param['closetime'] ? $param['closetime'] : 'null').', '.($param['locationtime'] ? $param['locationtime'] : 'null').');';
					$param['closetime'] = null;
					$st = '';
					if($param['showmsg']) {
						$show_message = '';
					}
				}
				if($param['closetime'] !== null) {
					$extra .= 'setTimeout("hideWindow(\''.$handlekey.'\')", '.($param['closetime'] * 1000).');';
				}
		
				$st = $param['locationtime'] !== null ?'setTimeout("window.location.href =\''.$url_forward_js.'\';", '.($param['locationtime'] * 1000).');' : '';
			
			if(!$extra && $param['timeout'] && !defined('IN_MOBILE')) {
				$extra .= 'setTimeout("window.location.href =\''.$url_forward_js.'\';", '.$refreshtime.');';
			}
			$show_message .= $extra ? '<script type="text/javascript" reload="1">'.$extra.$st.'</script>' : '';
			$show_message .= $param['extrajs'] ? $param['extrajs'] : '';
			
	
			return array(
				'render' =>'../common/showmessage',
				'param' => $param,
				'url_forward' => $url_forward,
				'url_forward_js' => $url_forward_js,
				'show_message' => $show_message,
			);
		}
}