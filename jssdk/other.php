<html>
<head>
  <meta charset="utf-8">
  <title>优才网 微信JS-SDK开发示例分享</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
  <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wxapi_container">
        <div class="lbox_close wxapi_form">
          <h3 id="menu-device">设备信息接口</h3>
          <span class="desc">获取网络状态接口</span>
          <button class="btn btn_primary" id="getNetworkType">获取当前网络状态</button>

          <h3 id="menu-webview">界面操作接口</h3>
          <span class="desc">隐藏右上角菜单接口</span>
          <button class="btn btn_primary" id="hideOptionMenu">隐藏右上角菜单</button>
          <span class="desc">显示右上角菜单接口</span>
          <button class="btn btn_primary" id="showOptionMenu">显示右上角菜单</button>
          <span class="desc">关闭当前网页窗口接口</span>
          <button class="btn btn_primary" id="closeWindow">关闭窗口</button>
          <span class="desc">批量隐藏功能按钮接口</span>
          <button class="btn btn_primary" id="hideMenuItems">隐藏多个按钮</button>
          <span class="desc">批量显示功能按钮接口</span>
          <button class="btn btn_primary" id="showMenuItems">显示多个按钮</button>
          <span class="desc">隐藏所有非基础按钮接口</span>
          <button class="btn btn_primary" id="hideAllNonBaseMenuItem">隐藏所有按钮</button>
          <span class="desc">显示所有功能按钮接口</span>
          <button class="btn btn_primary" id="showAllNonBaseMenuItem">显示所有按钮</button>
        </div>
    </div>
</body>

<?php require('signInfo.php'); ?>

<script type="text/javascript">
    wx.ready(function() {

      // 1 判断当前版本是否支持指定 JS 接口，支持批量判断
      /*
      document.querySelector('#checkJsApi').onclick = function () {
        wx.checkJsApi({
          jsApiList: [
            'getNetworkType',
            'previewImage'
          ],
          success: function (res) {
            alert(JSON.stringify(res));
          }
        });
      };
      */

      // 6 设备信息接口
      // 6.1 获取当前网络状态
      document.querySelector('#getNetworkType').onclick = function () {
        wx.getNetworkType({
          success: function (res) {
            alert('你当前使用 ' + res.networkType + '上网');
          },
          fail: function (res) {
            alert(JSON.stringify(res));
          }
        });
      };

      // 8 界面操作接口
      // 8.1 隐藏右上角菜单
      document.querySelector('#hideOptionMenu').onclick = function () {
        wx.hideOptionMenu();
      };
      // 8.2 显示右上角菜单
      document.querySelector('#showOptionMenu').onclick = function () {
        wx.showOptionMenu();
      };
      // 8.3 批量隐藏菜单项
      document.querySelector('#hideMenuItems').onclick = function () {
        wx.hideMenuItems({
          menuList: [
            'menuItem:share:timeline', // 分享到朋友圈
            'menuItem:copyUrl' // 复制链接
          ],
          success: function (res) {
            alert('已隐藏“分享到朋友圈”，“复制链接”等按钮');
          },
          fail: function (res) {
            alert(JSON.stringify(res));
          }
        });
      };
      // 8.4 批量显示菜单项
      document.querySelector('#showMenuItems').onclick = function () {
        wx.showMenuItems({
          menuList: [
            'menuItem:share:timeline', // 分享到朋友圈
            'menuItem:copyUrl' // 复制链接
          ],
          success: function (res) {
            alert('已显示“分享到朋友圈”，“复制链接”等按钮');
          },
          fail: function (res) {
            alert(JSON.stringify(res));
          }
        });
      };
      // 8.5 隐藏所有非基本菜单项
      document.querySelector('#hideAllNonBaseMenuItem').onclick = function () {
        wx.hideAllNonBaseMenuItem({
          success: function () {
            alert('已隐藏所有非基本菜单项');
          }
        });
      };
      // 8.6 显示所有被隐藏的非基本菜单项
      document.querySelector('#showAllNonBaseMenuItem').onclick = function () {
        wx.showAllNonBaseMenuItem({
          success: function () {
            alert('已显示所有非基本菜单项');
          }
        });
      };
      // 8.7 关闭当前窗口
      document.querySelector('#closeWindow').onclick = function () {
        wx.closeWindow();
      };

    });
</script>

</html>
