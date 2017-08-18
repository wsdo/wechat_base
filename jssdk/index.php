<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>优才网微信JS-SDK开发示例分享</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="wxapi_container">
      <div style="vertical-align: middle;"><img height="50" src="http://p10.ucai.cn/static/i3/logogkk.png" />优才网微信JS开发小鲜肉</div>
    <div class="wxapi_index_container">
      <ul class="label_box lbox_close wxapi_index_list">
        <li class="label_item wxapi_index_item">
          <a class="label_inner" href="base.php">环境搭建与配置</a>
        </li>
        <li class="label_item wxapi_index_item">
          <a class="label_inner" href="share.php">好东西不能独占，要分享给更多人</a>
        </li>
        <li class="label_item wxapi_index_item">
          <a class="label_inner" href="voice.php">普通话等级测试，你敢来吗？</a>
        </li>
        <li class="label_item wxapi_index_item">
          <a class="label_inner" href="picture.php">晒晒你的靓照!</a>
        </li>
        <li class="label_item wxapi_index_item">
          <a class="label_inner" href="scan.php">扫一扫，分享图书给好友</a>
        </li>
        <li class="label_item wxapi_index_item">
          <a class="label_inner" href="where.php">老师在哪儿？我又在哪儿？</a>
        </li>
        <li class="label_item wxapi_index_item">
          <a class="label_inner" href="other.php">其他功能</a>
        </li>
      </ul>
    </div>
  </div>
</body>

<?php require('signInfo.php'); ?>

<script type="text/javascript">
wx.ready(function() {
  var title = '优才网微信JS-SDK小鲜肉';
  var desc = '让你轻松快速掌握微信JS-SDK开发';
  var link = 'http://samples.app.ucai.cn/wx/';
  var imgUrl = 'http://p10.ucai.cn/static/i3/logogkk.png';

  // 2. 分享接口
  // 2.1 监听“分享给朋友”，按钮点击、自定义分享内容及分享结果接口
  wx.onMenuShareAppMessage({
      title: title,
      desc: desc,
      link: link,
      imgUrl: imgUrl
  });
  // 2.2 监听“分享到朋友圈”按钮点击、自定义分享内容及分享结果接口
  wx.onMenuShareTimeline({
      title: title,
      link: link,
      imgUrl: imgUrl
  });
});
</script>

</html>
