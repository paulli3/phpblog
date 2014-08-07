<?php
class BlogModel extends CFormModel
{
	
	
	public function rules()
	{
		
		return array(
			// name, email, subject and body are required
			//array('username, password, g,p,s', 'required'),
			
			//array('password2', 'compare', 'compareAttribute' => 'password'),

		);
	}
	
	
	public function getBlogStyleList()
	{
		//获取博客分类的类型
		
	}
	
	/**
	 * 递归取文件扩展
	 * @param unknown_type $file
	 */
	static private function _ParseLogic($file)
	{
		if (strpos($file,".")===false)return;
		$ext = tool::get_fileext($file);
//		echo $ext."<br/>";
//		echo $file."<br/>";
//		echo "<hr/>";
		$file = substr($file, 0,strlen($ext)*-1-1);
		$ext = strtolower($ext);
		if ($ext){
			$ext = $ext."/".self::_ParseLogic($file);
		}
		return rtrim($ext,"/");
	}
	
	static public function PaseBlogByDir()
	{
		$d = __DIR__."/blogData/";
		$dir = dir($d);
		$ret = array();
		while ($file = $dir->read())
		{
			if ($file == '.' || $file=='..' || is_dir($d.$file))continue;
			$ext = self::_ParseLogic($file);
			
			if ($ext == '')continue;
			$newDir = $d."$ext/";
			if (!is_dir($newDir))mkdir($newDir,775,true);
			$ctime = filemtime($d.$file); //文件修改时间，用于以后的排序
			
			if (rename($d.$file, $newDir.$file))
			{
				$ret[] = array(
					'filetime' 	=> filemtime($newDir.$file),
					'filePath' 	=> $newDir.$file,
					'filename'	=> iconv("GBK","UTF-8", substr($file,0, strpos($file, "."))),
					'type'		=> $ext,
					'ext'		=>	tool::get_fileext($file),
				);	
			}
		}
		self::_SaveFileData($ret);
	}
	
	/**
	 * 给文章归类
	 * @param unknown_type $k			key  'php/array/array_merge2' 分类的key
	 * @param unknown_type $data		data  array('count','self');
	 * @param unknown_type $ret
	 * @param unknown_type $filedata	$data 文章
	 * @param unknown_type $suffer
	 */
	private static function _getAllstyleLogic($k,$data,&$ret,$filedata,$suffer="")
	{//"xxx/xx/xxx/x"
//		/if (strpos($file,"/")===false)return array();
		$style = substr($k, 0,strpos($k, "/"));
		//echo $k." -- $style \n";
		if ($style){
			
			$ret[$style]['name'] = $style;
			$ret[$style]['count'] += $data['count'];
			$ret[$style]['data'] = $filedata[$suffer.$style]['self'];
			$ret[$style]['child'] = self::_getAllstyleLogic(substr($k, strpos($k, "/")+1),$data,$ret[$style]['child'],$filedata,$suffer.$style."/");
		}else{
			$ret[$k]['name'] = $k;
			//echo rtrim($suffer.$k,"/")."\n";
			$ret[$k]['data'] = $filedata[rtrim($suffer.$k,"/")]['self'];
			if (!is_array($ret[$k]['child']))$ret[$k]['child']=array();
			$ret[$k]['child'] = array_merge($ret[$k]['child'],array());
			$ret[$k]['count'] = $data['count'];
		}
		//print_r($ret);
		return $ret;
	}
	
	/**
	 * 根据语言获取博客分类
	 * @param unknown_type $code
	 */
	public static function getStyleByTopCodeName($code='php')
	{
		$alldata = self::getAllStyle();
		return $alldata[$code] ? $alldata[$code] : array();	
	}
	/**
	 * 获取所有博客分类
	 */
	public static function getAllStyle()
	{
		$key = "file|typelist";
		if (1||($data = app()->cache->get($key))==false){
			$alldata = self::getBlogData();
			$ret = array();
			foreach ($alldata as $k => $v){
				++$ret[$v['type']]['count'];
				$ret[$v['type']]['self'][] = $v;
			}
			//print_r($ret);
			$return = array();
			foreach ($ret as $k => $v)
			{
				$return = self::_getAllstyleLogic($k,$v,$return,$ret);
			}
			$data = ($return);
			//$data = array_keys($ret);
			app()->cache->set($key,$data,600);
		}
		//print_r($data);die;
		return $data;
	}
	/**
	 * 根据id获取文件内容信息
	 * @param unknown_type $id
	 */
	public static function getBlogByid($id)
	{
		$data = self::getBlogData();
		if (!$data[$id])return;
		$data[$id]['body']=file_get_contents($data[$id]['filePath']);
		preg_match_all("#<!--(.*?):(.*?)-->#", $data[$id]['body'],$arr);
		foreach ($arr[0] as $var => $value)
		{
			$data[$id][$arr[1][$var]] = $arr[2][$var];
		}
		return $data[$id];
	}
	/**
	 * 获取博客数据
	 */
	public static function getBlogData()
	{
		$key = self::_CACHE_KEY_FILE_DATA();
		return app()->cache->get($key);
	}
	/**
	 * 获取换成key
	 */
	private static function _CACHE_KEY_FILE_DATA()
	{
		return "file|alldata6";
	}
	/**
	 * 保存数据
	 */
	private static function _SaveFileData($data)
	{
		$key = self::_CACHE_KEY_FILE_DATA();
		$d = self::getBlogData();
		if (!is_array($d))$d=array();
		$d = array_merge($d,$data);
		
		foreach ($d as $k => $v)
		{
			$v['id'] = substr(md5($v['filePath']), 10); 
			$ret[$v['id']] = $v;
		}
//		foreach ($data as $k => $v)
//		{
//			if (is_array($d[$k])){
//				foreach ($da+a[$k] as $kk => $vv){
//					$d[$k][] = $vv;
//				}
//			}else{
//				$d[$k] = $v; 
//			}
//		}
		return app()->cache->set($key,$ret);
	}
	
	
}

