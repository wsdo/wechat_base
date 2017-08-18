<?php 
require('./api/zhihuDaily.php');
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

// 回复的消息模板
function replyMsg($content) {
	global $xml;
	$str = sprintf('<xml><ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
	<CreateTime>%d</CreateTime>
	<MsgType><![CDATA[text]]></MsgType>
	<Content><![CDATA[%s]]></Content></xml>',
	$xml->FromUserName,$xml->ToUserName,time(), $content);
	echo $str;
}


// 回复图文信息
function replyArticle($data) {
	global $xml;
	$article = '<ArticleCount>'.count($data).'</ArticleCount>';
	$article .= '<Articles>';
	foreach ($data as $d) {
		$article .= sprintf('<item><Title><![CDATA[%s]]></Title>',$d['title']);
		$article .= sprintf('<Url><![CDATA[%s]]></Url>',$d['url']);
		$article .= sprintf('<PicUrl><![CDATA[%s]]></PicUrl>',$d['picurl']);
		$article .= sprintf('<Description><![CDATA[%s]]></Description></item>',$d['desc']);
	}
	$article .= '</Articles>';

	$str = sprintf('<xml><ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
	<CreateTime>%d</CreateTime>
	<MsgType><![CDATA[news]]></MsgType>
	%s</xml>',
	$xml->FromUserName,$xml->ToUserName,time(),$article);
	echo $str;
}


// 当接收用户发送的信息后给用户发送一些消息
// if(!empty($xml->Content)){
// 	replyMsg('今天天气很棒');
// 	// replyMsg('东哥很帅！！！');
// }

// if(!empty($xml->Content)){
// 	$data = array(
// 				array('title'=>'图文消息，Hi，guys','url'=>'http://www.shudong.wang','picurl'=>'http://imgsrc.baidu.com/imgad/pic/item/267f9e2f07082838b5168c32b299a9014c08f1f9.jpg','desc'=>'it is a photo'),
// 				array('title'=>'这是第二个图片','url'=>'http://www.shudong.wang','picurl'=>'https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=615871807,3571179663&fm=173&s=EC10119C9CB17D92161919420300C0B1&w=500&h=209&img.JPEG','desc'=>'it is a photo'),
// 				array('title'=>'哈哈哈，这是一个图文消息'),
// 			);
// 	replyArticle($data);
// }


if ($xml->Content == '知乎日报') {
	$DailTitle =  Daily::GetDailTitle();
	$data  = [];
	foreach ($DailTitle as $key => $value) {
		$data[] = [
					'title'=>$value['title'],
					'url'=>'http://shudong.wang',
					'picurl'=>$value['images'][0],
					'desc'=>$value['title']
				];
	}
	replyArticle(array_slice($data,1,8));
}