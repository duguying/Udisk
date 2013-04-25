<?php
/**
 * 通过hash值检测文件是否已经上传过
 * @author rex
 *
 */
class chkIsUpload{
	private $fileModel;
	
	function __construct() {
		$this->fileModel=M('files');
	}
	
	/**
	 * 按照hash值检测文件是否存在<br>
	 * 存在时返回文件信息数组，不存在时返回false
	 * @param string $hash
	 * @return boolean|Ambigous <mixed, boolean, NULL, multitype:>
	 */
	function isUploaded($hash) {
		$result=$this->fileModel->where(array('hash'=>$hash))->find();
		if ($result) {
			return $result;
		}else{
			return $result;
		}
	}
	
	/**
	 * 按照hash值检测文件是否存在，启动函数<br>
	 * 存在时返回文件信息数组，不存在时返回false
	 * @param string $hash
	 * @return Ambigous <boolean, Ambigous, mixed, NULL, multitype:>
	 */
	static function CHK($hash){
		$isuploaded=new chkIsUpload();
		return $isuploaded->isUploaded($hash);
	}
}