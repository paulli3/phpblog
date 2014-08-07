<?php
class FromBlog extends CFormModel
{
	public $title;
	public $mean;
	public $body;
	public $author;
	public $id;
	
	public function rules()
	{
		return array(
			array('title,body','required'),
			array('mean,author','safe'),
		);
	}
	
	
}