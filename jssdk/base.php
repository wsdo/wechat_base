<html>
<head>
  <meta charset="utf-8">
  <title>优才网微信JS-SDK开发示例分享</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
  <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wxapi_container">
        <div class="lbox_close wxapi_form">
          <h3 id="menu-basic">基础配置与接口权限</h3>
          <span class="desc">
            判断当前客户端是否支持指定JS接口<br />
            如果select框没有列出权限列表，则客户端不支持微信JS<br />
            这里只判断js接口能否调用，公众号接口权限，请从mp.weixin.qq.com开发者中心查看
          </span>
          <select id="selJsApi" style="width:100%;height:42px;line-height:42px;font-size:18px;">
            <option value="0">--选择接口--</option>
          </select>
        </div>
    </div>
</body>

<?php require('signInfo.php'); ?>

<script type="text/javascript">
    wx.ready(function() {
      var jsApiList = [
        'checkJsApi', '检测js接口是否支持',
        'onMenuShareTimeline', '自定义分享到朋友圈',
        'onMenuShareAppMessage', '自定义发送给好友',
        'onMenuShareQQ', '自定义分享到QQ',
        'onMenuShareWeibo', '自定义分享腾讯微博',
        'translateVoice', '识别音频',
        'startRecord', '开始录音',
        'stopRecord', '停止录音',
        'onRecordEnd', '监听录音自动停止',
        'playVoice', '播放语音',
        'pauseVoice', '暂停语音',
        'stopVoice', '停止播放',
        'uploadVoice', '上传语音',
        'downloadVoice', '下载语音',
        'chooseImage', '拍照或选取图片',
        'previewImage', '预览图片',
        'uploadImage', '上载图片',
        'downloadImage', '下载图片',
        'getNetworkType', '获取网络状态',
        'openLocation', '微信地图查看位置',
        'getLocation', '获取地理位置',
        'hideOptionMenu', '隐藏右上角菜单',
        'showOptionMenu', '显示右上角菜单',
        'closeWindow', '关闭当前窗口',
        'hideMenuItems', '隐藏多个菜单项',
        'showMenuItems', '显示多个菜单项',
        'hideAllNonBaseMenuItem', '隐藏所有非基础菜单',
        'showAllNonBaseMenuItem', '显示所有非基础菜单',
        'scanQRCode', '扫一扫',
        'chooseWXPay', '发起微信支付',
        'openProductSpecificView', '跳转微信商品页',
        'addCard', '批量添加卡券',
        'chooseCard', '获取卡券选择列表',
        'openCard', '查看卡券'
      ];
      var obj = document.getElementById("selJsApi");
      for (var i=0; i<jsApiList.length; i+=2) {
        obj.add(new Option(jsApiList[i] + ' ' + jsApiList[i+1], jsApiList[i])); 
      }
      obj.onchange = function () {
        wx.checkJsApi({
          jsApiList: [
            obj.value
          ],
          success: function (res) {
            alert(JSON.stringify(res));
          }
        });
      };

    });
</script>

</html>
