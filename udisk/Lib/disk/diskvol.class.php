<?php
//磁盘容量占用
class diskvol {
	/**
	 * 存储量配额<br>
	 * 当数据库网站配置表中config['disk_vol']不存在时，从此处初始化
	 * @var int
	 */
	public $vol=1073741824;//B
	
	function __construct() {
		import('@.disk.config');
		import('@.disk.Dir');
		if (config::get('disk_vol')==null) {//配额配置不存在
			config::set('disk_vol',$this->vol);//存储到配置表
		};
	}
	/**
	 * 检测文件夹已使用容量
	 */
	function used() {
		$dirc=new Dir(C('STORE_PATH'));
		$vol=$dirc->dirSize();
		config::set('disk_used', $vol);
		return $vol;
	}
	/**
	 * 更新磁盘使用状态
	 */
	static function update() {
		$dis=new diskvol();
		return $dis->used();
	}
	/**
	 * 获取磁盘的当前状态
	 * @return <b style='color:red'>array('vol','used')</b>
	 */
	static function state() {
		import('@.disk.config');
		$vol=config::get('disk_vol');
		$dis=new diskvol();
		if (($rst=config::get('disk_used'))!=null) {
			return array('vol'=>$vol,'used'=>$rst);
		}else {
			return array('vol'=>$vol,'used'=>$dis->used());
		}
	}
}