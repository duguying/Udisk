<?php
class IndexAction extends Action {
	public function __construct(){
		$this->assign('root', C('WWW_PATH'));
	}
    public function index(){
    	import('@.disk.diskvol');
    	$diskstate=diskvol::state();
    	$vol=$diskstate['vol'];
    	$diskstate['vol']=$vol/(1024*1024*1024);//G
    	$diskstate['used']=round($diskstate['used']/(1024*1024),2);//M round(1.95583, 2);
    	$diskstate['free']=round($vol/(1024*1024),2)-$diskstate['used'];
    	$diskstate['percent']=100*$diskstate['used']/($vol/(1024*1024));
    	$this->assign('disk',$diskstate);
    	$this->display();
    }
    public function upload(){
//         dump($_FILES);
    	import('@.disk.store');
    	try {
    		$result=store::UPLOAD();
    		if($result){
    			$result['site']=$_SERVER['HTTP_HOST'].C('WWW_PATH');
                $result['time']=date('Y-m-d H:i', time()+60);
                $result['size']=(int)($result['size']/1024);
                $result['durl']=urlencode('http://'.$result['site'].'download/'.$result['key']);
                import('@.disk.diskvol');
                diskvol::update();//更新磁盘状态
                $this->assign('result',$result);
    			$this->display();
    		}else{
    			$this->show('上传失败！');
    		};
    	} catch (Exception $e) {
    		$this->show($e->getMessage());
    	}
    }
    public function xml() {
    	$m=M('config');
    	$d=$m->select();
    	import('@.disk.config');
    	$this->ajaxReturn($d,'xml');
    }
    function p404() {
    	header('location:http://yibo.iyiyun.com/Home/js/yibo404');
    }
    function test1() {
    	$this->display('upload');
    }
}