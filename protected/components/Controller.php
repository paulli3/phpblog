<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public $styles=array();
	
	public $script=array();
	
	public $ExtraData=array();
	
	public function __construct($id)
	{
		parent::__construct($id);
		Yii::app()->language='en'; //这里设计语言
	}
	
	public function render($view,$data=null,$return=false)
	{

		if ($_SERVER['REQUEST_METHOD']=='XMLHttpRequest' || $_REQUEST['inajax'])
		{
			$this->layout = "//layouts/xml";
			@header("Expires: -1");
			@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
			@header("Pragma: no-cache");
		  	if ($_REQUEST['inajax']==2){
			@header("Content-type: text/xml; charset=utf8");
		  }else if ($_REQUEST['inajax']==1){
			echo $_REQUEST['callback'] ? $_REQUEST['callback']."(".json_encode(array("data" => $output)) .")" :  json_encode( array("data" => $output));
			die;
		  }
		}
		$html = parent::render($view,$data,true);
		//$html = preg_replace("#<!--[\w\W]*?-->#", "", $html);
		if ($return)
		return $html;
		else 
		echo $html;		
	}
}