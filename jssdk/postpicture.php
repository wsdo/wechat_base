<?php
/**
 * 优才网全栈工程师调研组
 * 微信号：优才创智
 * http://www.ucai.cn
 */

require('config.php');
require("jssdk.php");
global $jssdk;
$jssdk = new JSSDK(APPID, APPSECRET);

function getPicture($mediaid) {
    global $jssdk;
    $token = $jssdk->getAccessToken();
    $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$token&media_id=$mediaid";
    $ext = "png";
    $content = $jssdk->httpGet($url);
    $rawfilename = "data/$mediaid"."_big.".$ext;
    file_put_contents($rawfilename, $content);
    $url = "http://stark.tunnel.itguru.cn/php/".$rawfilename;
    //可以用convert生成缩略图
    return array("url"=>$url, "smallurl"=>$url);
}

function postpicture($idstr)
{
    $ids = explode(",", $idstr);
    $urls = array();
    foreach ($ids as $mediaid)
    {
        $url = getPicture($mediaid);
        $urls["urls"][] = $url['url'];
        $urls["smallurls"][] = $url['smallurl'];
    }
    return json_encode($urls);
}

echo postpicture($_REQUEST['srvids']);
exit;
