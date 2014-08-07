<?php

class PayAdapter
{
	private $obj;
	/**
	 * 游戏根据游戏，获取model，然后来充值
	 * @param $gameID
	 */
	public function  __construct($gameID,$sid)
	{
		Yii::import('application.pay.*');
		$class = $this->_config($gameID);
		if (!$class ){showError('have no payment type');}
		$class = "pay$class";
		$this->obj = new $class($sid);
	}
	
	public function pay($uid,$money=1)
	{
		return $this->obj->pay($uid,$money);
	}
	/**
	 * 
	 * @param unknown_type $gid
	 */
	private function _config($gid)
	{
		$config = array(
			'800001' => 'qj',
			'800005' => 'sgh',
		);
		return $config[$gid];
	}
}