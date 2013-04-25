<?php
/**
 * 生成短ID
 * @author 铜豌豆 <bestphper@126.com>
 * @return string ID
 */
function CreateId() {
    //新时间截定义,基于世界未日2012-12-21的时间戳。
    $endtime=1356019200;//2012-12-21时间戳
    $curtime=time();//当前时间戳
    $newtime=$curtime-$endtime;//新时间戳
    $rand=rand(0,99);//两位随机
    $all=$rand.$newtime;
    $onlyid=base_convert($all,10,36);//把10进制转为36进制的唯一ID
    return strtoupper($onlyid);
}
/**
 * 火狐浏览器Debug函数
 * 将php变量信息在firebug的控制台中显示
 * 注意：此功能可能会使页面UI发生轻微异常，UI设计工作时请关闭此功能
 * @param any_type $msg 变量，任意类型
 */
function FFDEBUG($msg) {
	if (C('FFDEBUG')) {
		echo '<script type="text/javascript">console.log('.json_encode($msg).')</script>',"\n";
	}
	return $msg;
}

