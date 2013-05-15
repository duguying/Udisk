<?php
class WapAction extends Action {
	function _empty(){ 
        header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码 
        $this->show("404:页面不存在");
    }
	public function __construct(){
		C('SHOW_PAGE_TRACE',false);
	}
	public function index(){
		$this->assign('root',C('WWW_PATH'));
		$this->display('./udisk/Tpl/wap/index.html','utf-8', 'text/vnd.wap.wml');
	}
}



