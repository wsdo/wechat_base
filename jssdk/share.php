<?php
require_once "./config.php";
require_once "jssdk.php";
$jssdk = new JSSDK(Config::APPID, Config::APPSECRET);
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
  <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
  <link rel="stylesheet" href="style.css">

</head>
<body>
      <div class="wxapi_container">
        <div class="lbox_close wxapi_form">
            <h3 id="menu-share">分享公开课</h3>
            <span class="desc">标题、描述和图片都可以自由定义，不一定在网页里</span>
            <button class="btn btn_primary" id="openShareApp">注册自定义分享给好友内容</button>
            <button class="btn btn_primary" id="openShareTimeline">注册自定义分享朋友圈内容</button>

            <h3 id="menu-share">计数分享</h3>
            <span class="desc">每次一分享的内容都可以不一样</span>
            <button class="btn btn_primary" id="openShareCounter">计数分享到朋友圈</button>
        </div>
    </div>
</body>
<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
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
//   wx.ready(function () {
//     // 在这里调用 API
//     wx.onMenuShareTimeline({
//     title: 'stark.wang', // 分享标题
//     link: 'stark.wang', // 分享链接
//     imgUrl: 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1489638195851&di=ed214b323f6711b3a023c412919ddced&imgtype=0&src=http%3A%2F%2Fimg4.duitang.com%2Fuploads%2Fitem%2F201602%2F24%2F20160224020611_fVLWx.jpeg', // 分享图标
//     success: function () { 
//         // 用户确认分享后执行的回调函数
//     },
//     cancel: function () { 
//         // 用户取消分享后执行的回调函数
//     }
// });
//   });

  wx.ready(function() {
    var title =  'stark.wang'; // 分享标题
    var link = 'http://www.stark.wang'; // 分享链接
    var desc = "hello wechat develop";
    var titlePicUrl = 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1489638195851&di=ed214b323f6711b3a023c412919ddced&imgtype=0&src=http%3A%2F%2Fimg4.duitang.com%2Fuploads%2Fitem%2F201602%2F24%2F20160224020611_fVLWx.jpeg'; // 分享图标
    // 2. 分享接口
    // 2.1 监听“分享给朋友”，按钮点击、自定义分享内容及分享结果接口
    wx.onMenuShareAppMessage({
        title: title,
        desc: desc,
        link: link,
        imgUrl: titlePicUrl,
        trigger: function(res) {
            // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
        },
        success: function(res) {},
        cancel: function(res) {},
        fail: function(res) {
            //alert(JSON.stringify(res));
        }
    });
    // 2.2 监听“分享到朋友圈”按钮点击、自定义分享内容及分享结果接口
    wx.onMenuShareTimeline({
        title: title,
        link: link,
        imgUrl: titlePicUrl,
        trigger: function(res) {
            // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
        },
        success: function(res) {},
        cancel: function(res) {},
        fail: function(res) {
            //alert(JSON.stringify(res));
        }
    });

    wx.error(function(res){
      $.toast(res);
      console.log(res);
    // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。

    });
})

</script>
</html>
