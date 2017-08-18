<?php 

// 检测微信接口验证的函数
function checkSignature()
{
    if (empty($_GET['echostr'])) {
      return;
    }
	file_put_contents('wx.log', serialize($_GET), FILE_APPEND);
    $signature = $_GET["signature"];
    $timestamp = $_GET["timestamp"];
    $nonce = $_GET["nonce"];
    
    $token = 'stark';
    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );

	if( $tmpStr == $signature ){
		echo $_GET['echostr'];
	}else{
		echo 'failed';
	}
	exit;
}

checkSignature();


//微信post的所有数据在一起
// $postStr = $GLOBALS['HTTP_RAW_POST_DATA']
$postStr = file_get_contents('php://input');
// 验证如果接收的数据为空写入日志
if (empty($postStr)) {
	file_put_contents('wx.log', 'post数据为空'.FILE_APPEND."\n", FILE_APPEND);
	return 'post数据为空'."\n";
}

$xml = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
// 测试把接收的信息写入日志
file_put_contents('wx.log', $xml->Content."\n\n", FILE_APPEND);
echo $postStr."\n";


