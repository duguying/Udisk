<?php

/**
 * 判断是否为低版本的IE浏览器，HTML4兼容
 * @return boolean 若是IE7,IE6,IE5, 则返回True否则返回False
 */
function isHTML4() {
	$isOld=false;
	$ua=$_SERVER['HTTP_USER_AGENT'];
	switch (true) {
		case preg_match('/MSIE 5/i', $ua):
			$isOld=true;
			break;
		case preg_match('/MSIE 6/i', $ua):
			$isOld=true;
			break;	
		case preg_match('/MSIE 7/i', $ua):
			$isOld=true;
			break;
		case preg_match('/MSIE 8/i', $ua):
			$isOld=true;
			break;
	}
	return $isOld;
}

if (isHTML4()) {
	return 'html4';
}else {
	return 'html5';
}
