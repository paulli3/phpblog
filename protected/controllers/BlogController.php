<?php

class BlogController extends Controller
{
	//public $defaultAction = 'GetPage';
	public $layout = "//layouts/blog/right_menu";
	//public $layout='//layouts/column1';
	public function actionIndex()
	{
		$this->render('index');
	}
	
	
	public function actionEdit()
	{
		
		$a = BlogModel::getBlogData();
		var_dump($a);
		//$this->render('blog_edit');
	}
	/**
	 * 列表显示
	 * Enter description here ...
	 */
	public  function actionList()
	{
		$d['datalist'] = BlogModel::getBlogData();
	
		$d['leftHtml'] = $this->renderPartial('lefthtml',array('leftData'=>BlogModel::getAllStyle()),true);
		
		$this->render('list',$d);
		
	}
	/**
	 * 解析，更新文档到列表
	 */
	public function actionParse()
	{	
		BlogModel::PaseBlogByDir();
		$a = BlogModel::getBlogData();
		BlogModel::getAllStyle();
		var_dump($a);
		header('500','500');
	}
	
	
	public function actionView()
	{
		//app()->cache->rpush("2",'xxx');
		// var_dump(app()->cache->lrange("2",0,-1));die;
		$id = (app()->request->getParam('id'));
		
		$d['leftHtml'] = $this->renderPartial('lefthtml',array('leftData'=>BlogModel::getAllStyle()),true);
		
		$d['Html'] = format_code(BlogModel::getBlogByid($id));
		
		$this->render('view',$d);
	}

	
	
}

function format_code($html)
{
	$html = preg_replace("#<!--.*?-->.*?\n#", "", $html);
	$html = preg_replace("#{(.*?)}([\w\W]*?){/\\1}#", "<pre><code class='$1'>$2</code></pre>", $html);
	$html = preg_replace("#!!(.*)?\n#", "<h2>$1</h2>", $html);
	$html = preg_replace("#\n#", "<br>", $html);
	$html = preg_replace("#//(.*)?#", "<div class='comment'>$1</div>", $html);
	$html = preg_replace("#\#(.*)?#", "<div class='comment'>$1</div>", $html);
	$html = preg_replace("#/\*([\w\W]*)?\*/#", "<div class='comment'>$1</div>", $html);
	
	return $html;
}
