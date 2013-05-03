<?php
class WapAction extends Action {
	public function __construct(){
		C('SHOW_PAGE_TRACE',false);
	}
	public function index(){
		$this->assign('root',C('WWW_PATH'));
		$this->display('./udisk/Tpl/wap/index.html','utf-8', 'text/vnd.wap.wml');
	}
}



