<?php
//站内配置
class config {
	public $confModel;
	function __construct() {
		$this->confModel=M('config');
	}
	/**
	 * 设定键名为key键值为value的配置
	 * Enter description here ...
	 * @param $key
	 * @param $value
	 */
	function setConf($key,$value) {
		$data['key']=$key;
		$data['value']=$value;
		$this->confModel->add($data);
	}
	/**
	 * 更新键名为key的配置
	 * Enter description here ...
	 * @param $key
	 * @param $value
	 */
	function updateConf($key,$value) {
		$data['value']=$value;
		$this->confModel->where(array('key'=>$key))->save($data);
	}
	/**
	 * 检测键名为key的配置是否存在
	 * Enter description here ...
	 * @param $key
	 */
	function definedConf($key) {
		$rst=$this->confModel->where(array('key'=>$key))->find();
		if ($rst==null) {
			return false;
		}else {
			return true;
		}
	}
	/**
	 * 获取键名为key的键值
	 * Enter description here ...
	 * @param unknown_type $key
	 */
	function getConf($key) {
		$rst=$this->confModel->where(array('key'=>$key))->find();
		return $rst['value'];
	}
	/**
	 * 获取配置键名为key的键值
	 * @param <b style='color:red'>string $key 键名</b>
	 * @return any||null
	 */
	static function get($key) {
		$conf=new config();
		if (($rst=$conf->getConf($key))==null) {
			return null;
		}else {
			return json_decode($rst);
		}
	}
	/**
	 * 设定键名为key键值为value的配置
	 * @param string <b style='color:red'>$key 键名</b>
	 * @param any <b style='color:red'>$value 键值</b>
	 */
	static function set($key,$value) {
		$value=json_encode($value);
		$conf=new config();
		if ($conf->definedConf($key)) {
			$conf->updateConf($key, $value);
		}else {
			$conf->setConf($key, $value);
		};
	}
}
