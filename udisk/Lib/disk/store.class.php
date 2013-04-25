<?php
/**
 * 文件上传存储类
 * @author <a href="mailto:duguying2008@gmail.com">rex</a>
 *
 */
class store{
	public $fileInfo;
	private $fileModel;
	public $key;
	
	/**
	 * 文件存储类
	 * @throws Exception 上传失败异常
	 */
	function __construct() {
		$this->fileModel=M('files');
		
		import("ORG.Net.UploadFile");
    	$u=new UploadFile();
    	$result=$u->upload(C('STORE_PATH'));
    	
    	$this->fileInfo=$u->getUploadFileInfo();
    	
//     	FFDEBUG($result);
    	if(!$result){
    		throw new Exception('上传失败！');
    	}
	}
	
	/**
	 * 将文件信息保存到数据库
	 * @return int
	 */
	function saveInfo2DB() {
		$data['filename']=$this->fileInfo[0]['name'];
		$data['savename']=$this->fileInfo[0]['savename'];
		$data['filename']=$this->fileInfo[0]['name'];
		$this->key=CreateId();
		$data['key']=$this->key;
		$data['extension']=$this->fileInfo[0]['extension'];
		$data['mime']=$this->fileInfo[0]['type'];
		$data['hash']=$this->fileInfo[0]['hash'];
		$data['size']=$this->fileInfo[0]['size'];
		$data['time']=time();
		return $this->fileModel->data($data)->add();
	}
	
	/**
	 * 文件上传存储
	 * @return array|false
	 */
	static function UPLOAD() {
		$upload=new store();
		import('@.disk.chkIsUpload');
		if ($chkRst=chkIsUpload::CHK($upload->fileInfo[0]['hash'])) {
// 			dump($chkRst);
			unlink(C('STORE_PATH').$upload->fileInfo[0]['savename']);//移除文件
			return array(
					'key'=>$chkRst['key'],
					'filename'=>$chkRst['filename'],
					'size'=>$chkRst['size']//单位B
					);
		}else{
			if($upload->saveInfo2DB()){
				return array(
						'key'=>$upload->key,
						'filename'=>$upload->fileInfo[0]['name'],
						'size'=>$upload->fileInfo[0]['size']
						);
			}else{
				return false;
			}
		}
	}
	
}