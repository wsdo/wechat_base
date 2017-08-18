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
            <h3 id="menu-share">老师在哪儿？</h3>
            <span class="desc">快来看看优才网的老师在哪儿？</span>
            <button class="btn btn_primary" id="openLocation">在地图上查看老师位置</button>

            <h3 id="menu-share">我又在哪儿？</h3>
            <span class="desc">快速看看你自己在哪儿？</span>
            <button class="btn btn_primary" id="getLocation">获取我的位置坐标</button>
        </div>
    </div>
</body>

<?php require('signInfo.php'); ?>

<script type="text/javascript">
    wx.ready(function() {
        // 7 地理位置接口
        // 7.1 查看地理位置
        document.querySelector('#openLocation').onclick = function() {
            wx.openLocation({
                latitude: 39.98124,
                longitude: 116.3078,
                name: '优才网',
                address: '北京市海淀区中关村鼎好大厦B座1212',
                scale: 14,
                infoUrl: 'http://www.ucai.cn'
            });
        };

        // 7.2 获取当前地理位置
        document.querySelector('#getLocation').onclick = function() {
            wx.getLocation({
                success: function(res) {
                    var latitude = res.latitude;
                    var longitude = res.longitude;
                    wx.openLocation({
                        latitude: latitude,
                        longitude: longitude,
                        name: '我自己的位置',
                        address: '中华人民共和国',
                        scale: 14,
                        infoUrl: 'http://www.ucai.cn'
                    });
                    //alert(JSON.stringify(res));
                },
                cancel: function(res) {
                    alert('用户拒绝授权获取地理位置');
                }
            });
        };
    });
</script>

</html>
