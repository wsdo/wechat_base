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
echo '<pre>';
print_r($arr);
?>

<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
  	wx.config({
      debug: false,
      appId: '<?php echo $arr["appId"]; ?>',
      timestamp: <?php echo $arr["timestamp"]; ?>,
      nonceStr: '<?php echo $arr["nonceStr"]; ?>',
      signature: '<?php echo $arr["signature"]; ?>',
      jsApiList: [
        'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'translateVoice',
        'startRecord',
        'stopRecord',
        'onRecordEnd',
        'playVoice',
        'pauseVoice',
        'stopVoice',
        'uploadVoice',
        'downloadVoice',
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'getNetworkType',
        'openLocation',
        'getLocation',
        'hideOptionMenu',
        'showOptionMenu',
        'closeWindow',
        'scanQRCode',
        'chooseWXPay',
        'openProductSpecificView',
        'addCard',
        'chooseCard',
        'openCard'
      ]
  	});

  	wx.error(function(res) {
  	    alert(res.errMsg);
  	});

</script>
