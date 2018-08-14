<?php
require_once "./config.php";

//appid和secret配置
// require('config.php');
//微信sdk，php生成token和签名
require('jssdk.php');

//调用sdk生成签名信息
// $sdk = new JSSDK(APPID, APPSECRET);
$sdk = new JSSDK(Config::APPID, Config::APPSECRET);
$arr = $sdk->GetSignPackage();
echo json_encode($arr, $asArray = true);
?>

