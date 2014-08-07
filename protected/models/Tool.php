<?php
class tool
{
	//获取文件扩展名
	static function get_fileext($file)
	{
		//return pathinfo($file, PATHINFO_EXTENSION);
		return end(explode('.', $file));
	}
	static function is_zip($str) 
	{ 
	   return (preg_match("/^[1-9]\d{5}$/",$str))?true:false; 
	} 
	static function is_mobile($str){
	    return (preg_match("/^1[358]\d{9}$/",$str))?true:false;
	} 
	static function is_phone($str) 
	{ 
	     return (preg_match("/^((0\d{2,3}))(\d{7,8})(-(\d{3,}))?$/",$str))?true:false;
	}
	static function is_url($str) 
	{ 
	   return (preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/",$str))?true:false; 
	}
	static function is_status($str)
	{
	   return (preg_match('/(^([\d]{15}|[\d]{18}|[\d]{17}x)$)/',$str))?true:false;
	}
	/**
	 * PHP 邮箱验证函数
	 * @param unknown_type $email
	 */
	static function is_Email($email)
	{
	   $isValid = true;
	   $atIndex = strrpos($email, "@");
	   if (is_bool($atIndex) && !$atIndex)
	   {
	      $isValid = false;
	   }
	   else
	   {
	      $domain = substr($email, $atIndex+1);
	      $local = substr($email, 0, $atIndex);
	      $localLen = strlen($local);
	      $domainLen = strlen($domain);
	      if ($localLen < 1 || $localLen > 64)
	      {
	         // local part length exceeded
	         $isValid = false;
	      }
	      else if ($domainLen < 1 || $domainLen > 255)
	      {
	         // domain part length exceeded
	         $isValid = false;
	      }
	      else if ($local[0] == '.' || $local[$localLen-1] == '.')
	      {
	         // local part starts or ends with '.'
	         $isValid = false;
	      }
	      else if (preg_match('/\\.\\./', $local))
	      {
	         // local part has two consecutive dots
	         $isValid = false;
	      }
	      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
	      {
	         // character not valid in domain part
	         $isValid = false;
	      }
	      else if (preg_match('/\\.\\./', $domain))
	      {
	         // domain part has two consecutive dots
	         $isValid = false;
	      }
	      else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
	                 str_replace("\\\\","",$local)))
	      {
	         // character not valid in local part unless 
	         // local part is quoted
	         if (!preg_match('/^"(\\\\"|[^"])+"$/',
	             str_replace("\\\\","",$local)))
	         {
	            $isValid = false;
	         }
	      }
	      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
	      {
	         // domain not found in DNS
	         $isValid = false;
	      }
	   }
	   return $isValid;
	}
	
	
	static function Import_countrylist()
	{
		die;
		$str = '[["Afghanistan", "AF"],["Albania", "AL"],["Algeria", "DZ"],["American Samoa", "AS"],["Andorra", "AD"],["Angola", "AO"],["Anguilla", "AI"],["Antarctica", "AQ"],["Antigua and Barbuda", "AG"],["Argentina", "AR"],["Armenia", "AM"],["Aruba", "AW"],["Ascension", "AC"],["Australia", "AU"],["Austria", "AT"],["Azerbaijan", "AZ"],["Bahamas, The", "BS"],["Bahrain", "BH"],["Bangladesh", "BD"],["Barbados", "BB"],["Belarus", "BY"],["Belgium", "BE"],["Belize", "BZ"],["Benin", "BJ"],["Bermuda", "BM"],["Bhutan", "BT"],["Bolivia", "BO"],["Bonaire, Sint Eustatius and Saba", "AN"],["Bosnia and Herzegovina", "BA"],["Botswana", "BW"],["Brazil", "BR"],["British Indian Ocean Territory", "IO"],["British Virgin Islands", "VG"],["Brunei", "BN"],["Bulgaria", "BG"],["Burkina Faso", "BF"],["Burundi", "BI"],["Cambodia", "KH"],["Cameroon", "CM"],["Canada", "CA"],["Cape Verde", "CV"],["Cayman Islands", "KY"],["Central African Republic", "CF"],["Chad", "TD"],["Chile", "CL"],["China", "CN"],["Colombia", "CO"],["Comoros", "KM"],["Congo", "CG"],["Congo (DRC)", "CD"],["Cook Islands", "CK"],["Costa Rica", "CR"],["Croatia", "HR"],["Cuba", "CU"],["Cyprus", "CY"],["Czech Republic", "CZ"],["Côte d’Ivoire", "CI"],["Denmark", "DK"],["Djibouti", "DJ"],["Dominica", "DM"],["Dominican Republic", "DO"],["Ecuador", "EC"],["Egypt", "EG"],["El Salvador", "SV"],["Equatorial Guinea", "GQ"],["Eritrea", "ER"],["Estonia", "EE"],["Ethiopia", "ET"],["Falkland Islands (Islas Malvinas)", "FK"],["Faroe Islands", "FO"],["Fiji", "FJ"],["Finland", "FI"],["France", "FR"],["French Guiana", "GF"],["French Polynesia", "PF"],["Gabon", "GA"],["Gambia, The", "GM"],["Georgia", "GE"],["Germany", "DE"],["Ghana", "GH"],["Gibraltar", "GI"],["Greece", "GR"],["Greenland", "GL"],["Grenada", "GD"],["Guadeloupe", "GP"],["Guam", "GU"],["Guatemala", "GT"],["Guinea", "GN"],["Guinea-Bissau", "GW"],["Guyana", "GY"],["Haiti", "HT"],["Holy See (Vatican City)", "VA"],["Honduras", "HN"],["Hong Kong SAR", "HK"],["Hungary", "HU"],["INMARSAT", "SQ"],["Iceland", "IS"],["India", "IN"],["Indonesia", "ID"],["International Networks (+883)", "VO"],["International Toll Free", "IZ"],["Iran", "IR"],["Iraq", "IQ"],["Ireland, Republic of", "IE"],["Israel", "IL"],["Italy", "IT"],["Jamaica", "JM"],["Japan", "JP"],["Jordan", "JO"],["Kazakhstan", "KZ"],["Kenya", "KE"],["Kiribati", "KI"],["Korea", "KR"],["Kuwait", "KW"],["Kyrgyzstan", "KG"],["Laos", "LA"],["Latvia", "LV"],["Lebanon", "LB"],["Lesotho", "LS"],["Liberia", "LR"],["Libya", "LY"],["Liechtenstein", "LI"],["Lithuania", "LT"],["Luxembourg", "LU"],["Macao SAR", "MO"],["Macedonia, FYRO", "MK"],["Madagascar", "MG"],["Malawi", "MW"],["Malaysia", "MY"],["Maldives", "MV"],["Mali", "ML"],["Malta", "MT"],["Marshall Islands", "MH"],["Martinique", "MQ"],["Mauritania", "MR"],["Mauritius", "MU"],["Mayotte", "YT"],["Mexico", "MX"],["Micronesia", "FM"],["Moldova", "MD"],["Monaco", "MC"],["Mongolia", "MN"],["Montenegro", "ME"],["Montserrat", "MS"],["Morocco", "MA"],["Mozambique", "MZ"],["Myanmar", "MM"],["Namibia", "NA"],["Nauru", "NR"],["Nepal", "NP"],["Netherlands", "NL"],["New Caledonia", "NC"],["New Zealand", "NZ"],["Nicaragua", "NI"],["Niger", "NE"],["Nigeria", "NG"],["Niue", "NU"],["North Korea", "KP"],["Northern Mariana Islands", "MP"],["Norway", "NO"],["Oman", "OM"],["Pakistan", "PK"],["Palau", "PW"],["Palestinian Authority", "PS"],["Panama", "PA"],["Papua New Guinea", "PG"],["Paraguay", "PY"],["Peru", "PE"],["Philippines", "PH"],["Poland", "PL"],["Portugal", "PT"],["Puerto Rico", "PR"],["Qatar", "QA"],["Reunion", "RE"],["Romania", "RO"],["Russia", "RU"],["Rwanda", "RW"],["Saint Helena, Ascension and Tristan da Cunha", "SH"],["Saint Kitts and Nevis", "KN"],["Saint Lucia", "LC"],["Saint Pierre and Miquelon", "PM"],["Saint Vincent and the Grenadines", "VC"],["Samoa", "WS"],["San Marino", "SM"],["Saudi Arabia", "SA"],["Senegal", "SN"],["Serbia", "RS"],["Seychelles", "SC"],["Sierra Leone", "SL"],["Singapore", "SG"],["Sint Maarten", "SX"],["Slovakia", "SK"],["Slovenia", "SI"],["Solomon Islands", "SB"],["Somalia", "SO"],["South Africa", "ZA"],["South Sudan", "SS"],["Spain", "ES"],["Sri Lanka", "LK"],["Sudan", "SD"],["Suriname", "SR"],["Swaziland", "SZ"],["Sweden", "SE"],["Switzerland", "CH"],["Syria", "SY"],["São Tomé and Príncipe", "ST"],["Taiwan", "TW"],["Tajikistan", "TJ"],["Tanzania", "TZ"],["Thailand", "TH"],["Timor-Leste", "TL"],["Togo", "TG"],["Tokelau", "TK"],["Tonga", "TO"],["Trinidad and Tobago", "TT"],["Tunisia", "TN"],["Turkey", "TR"],["Turkmenistan", "TM"],["Turks and Caicos Islands", "TC"],["Tuvalu", "TV"],["US Virgin Islands", "VI"],["Uganda", "UG"],["Ukraine", "UA"],["United Arab Emirates", "AE"],["United Kingdom", "GB"],["United Nations", "UN"],["United States", "US"],["Uruguay", "UY"],["Uzbekistan", "UZ"],["Vanuatu", "VU"],["Venezuela", "VE"],["Vietnam", "VN"],["Wallis and Futuna", "WF"],["Yemen", "YE"],["Zambia", "ZM"],["Zimbabwe", "ZW"]]';
		$arr = json_decode($str,true);	
		foreach ($arr as $v){
			$sql = "INSERT INTO momee_country (`name`,`code`,`ctrlid`) values ('{$v['0']}','{$v['1']}','{$v['2']}')";
			app()->db->createCommand($sql)->query();
		}
	}
	static function Import_languagelist()
	{
		die;
		$str = file_get_contents(dirname(__FILE__)."/tooldata/lang");
		$arr = explode("\n",$str);
		
		foreach ($arr as $v){
			$v = explode(",", $v);
			$sql = "INSERT INTO momee_lang (`name`,`code`,`ctrlid`) values ('{$v['0']}','{$v['1']}','{$v['2']}')";
			app()->db->createCommand($sql)->query();
		}
	}
	static function Import_showCurreny()
	{
		$str = file_get_contents(dirname(__FILE__)."/tooldata/curreny");
		$arr = explode("\n",$str);
		$ret = array();
		foreach ($arr as $v){
			$v = explode(",", $v);
			$v[2] = trim($v[2]); 
			$ret[] = $v;
		}
		var_export($ret);
	}
}

function getCurrenyList()
{
	return array ( 0 => array ( 0 => 'AED', 1 => 'United Arab Emirates Dirham', 2 => '', ), 1 => array ( 0 => 'ARS', 1 => 'Argentine Peso', 2 => 'AR$', ), 2 => array ( 0 => 'AUD', 1 => 'Australian Dollars', 2 => '$', ), 3 => array ( 0 => 'BGN', 1 => 'Bulgarian Lev', 2 => '', ), 4 => array ( 0 => 'BND', 1 => 'Brunei Dollar', 2 => '$', ), 5 => array ( 0 => 'BOB', 1 => 'Bolivian Boliviano', 2 => '', ), 6 => array ( 0 => 'BRL', 1 => 'Brazilian Real', 2 => 'R$', ), 7 => array ( 0 => 'CAD', 1 => 'Canadian Dollars', 2 => '$', ), 8 => array ( 0 => 'CHF', 1 => 'Swiss Francs', 2 => '', ), 9 => array ( 0 => 'CLP', 1 => 'Chilean Peso', 2 => 'CL$', ), 10 => array ( 0 => 'CNY', 1 => 'Yuan Renminbi', 2 => '¥', ), 11 => array ( 0 => 'COP', 1 => 'Colombian Peso', 2 => '', ), 12 => array ( 0 => 'CSD', 1 => 'Old Serbian Dinar', 2 => '', ), 13 => array ( 0 => 'CZK', 1 => 'Czech Koruna', 2 => '', ), 14 => array ( 0 => 'DEM', 1 => 'Deutsche Marks', 2 => '', ), 15 => array ( 0 => 'DKK', 1 => 'Denmark Kroner', 2 => '', ), 16 => array ( 0 => 'EEK', 1 => 'Estonian Kroon', 2 => '', ), 17 => array ( 0 => 'EGP', 1 => 'Egyptian Pound', 2 => '', ), 18 => array ( 0 => 'EUR', 1 => 'Euros', 2 => '€', ), 19 => array ( 0 => 'FJD', 1 => 'Fiji Dollar', 2 => '$', ), 20 => array ( 0 => 'FRF', 1 => 'French Franks', 2 => '', ), 21 => array ( 0 => 'GBP', 1 => 'British Pounds Sterling', 2 => '£', ), 22 => array ( 0 => 'HKD', 1 => 'Hong Kong Dollars', 2 => '$', ), 23 => array ( 0 => 'HRK', 1 => 'Croatian Kuna', 2 => '', ), 24 => array ( 0 => 'HUF', 1 => 'Hungarian Forint', 2 => '', ), 25 => array ( 0 => 'IDR', 1 => 'Indonesian Rupiah', 2 => '', ), 26 => array ( 0 => 'ILS', 1 => 'Israeli Shekel', 2 => '₪', ), 27 => array ( 0 => 'INR', 1 => 'Indian Rupee', 2 => '', ), 28 => array ( 0 => 'JPY', 1 => 'Japanese Yen', 2 => '¥', ), 29 => array ( 0 => 'KES', 1 => 'Kenyan Shilling', 2 => '', ), 30 => array ( 0 => 'KRW', 1 => 'South Korean Won', 2 => '₩', ), 31 => array ( 0 => 'LTL', 1 => 'Lithuanian Litas', 2 => '', ), 32 => array ( 0 => 'MAD', 1 => 'Moroccan Dirham', 2 => '', ), 33 => array ( 0 => 'MTL', 1 => 'Maltese Lira', 2 => '', ), 34 => array ( 0 => 'MXN', 1 => 'Mexico Peso', 2 => '', ), 35 => array ( 0 => 'MYR', 1 => 'Malaysian Ringgit', 2 => '', ), 36 => array ( 0 => 'NOK', 1 => 'Norway Kroner', 2 => '', ), 37 => array ( 0 => 'NZD', 1 => 'New Zealand Dollars', 2 => '$', ), 38 => array ( 0 => 'PEN', 1 => 'Peruvian Nuevo Sol', 2 => '', ), 39 => array ( 0 => 'PHP', 1 => 'Philippine Peso', 2 => '', ), 40 => array ( 0 => 'PKR', 1 => 'Pakistan Rupee', 2 => '', ), 41 => array ( 0 => 'PLN', 1 => 'Polish New Zloty', 2 => '', ), 42 => array ( 0 => 'ROL', 1 => 'Romanian Leu', 2 => '', ), 43 => array ( 0 => 'RON', 1 => 'New Romanian Leu', 2 => '', ), 44 => array ( 0 => 'RSD', 1 => 'Serbian Dinar', 2 => '', ), 45 => array ( 0 => 'RUB', 1 => 'Russian Rouble', 2 => '', ), 46 => array ( 0 => 'SAR', 1 => 'Saudi Riyal', 2 => '', ), 47 => array ( 0 => 'SEK', 1 => 'Sweden Kronor', 2 => '', ), 48 => array ( 0 => 'SGD', 1 => 'Singapore Dollars', 2 => '$', ), 49 => array ( 0 => 'SIT', 1 => 'Slovenian Tolar', 2 => '', ), 50 => array ( 0 => 'SKK', 1 => 'Slovak Koruna', 2 => '', ), 51 => array ( 0 => 'THB', 1 => 'Thai Baht', 2 => '฿', ), 52 => array ( 0 => 'TRL', 1 => 'Turkish Lira', 2 => '', ), 53 => array ( 0 => 'TRY', 1 => 'New Turkish Lira', 2 => '', ), 54 => array ( 0 => 'TWD', 1 => 'New Taiwan Dollar', 2 => '$', ), 55 => array ( 0 => 'UAH', 1 => 'Ukrainian Hryvnia', 2 => '', ), 56 => array ( 0 => 'USD', 1 => 'US Dollars', 2 => '$', ), 57 => array ( 0 => 'VEB', 1 => 'Venezuela Bolivar', 2 => '', ), 58 => array ( 0 => 'VEF', 1 => 'Venezuela Bolivar Fuerte', 2 => '', ), 59 => array ( 0 => 'VND', 1 => 'Vietnamese Dong', 2 => '₫', ), 60 => array ( 0 => 'ZAR', 1 => 'South African Rand', 2 => 'R', ), );
}