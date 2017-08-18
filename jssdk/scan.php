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
            <h3 id="menu-share">扫一扫更快捷</h3>
            <h3 id="title"></h3>
            <img id='image' src='' />
            <span id="price" style="color:darkred"></span>
            <br /> 
            <h3 id="menu-scan">分享图书给优才网好友</h3>
            <button class="btn btn_primary" id="scanQRCode1">分享图书给优才网好友</button>
        </div>
    </div>
</body>

<?php require('signInfo.php'); ?>

<script type="text/javascript" src="//cdn.bootcss.com/jquery/3.1.1/jquery.js"></script>
<script type="text/javascript">
    wx.ready(function() {
        // 9.1.2 扫描二维码并返回结果
        document.querySelector('#scanQRCode1').onclick = function() {
            wx.scanQRCode({
                needResult: 1,
                desc: 'scanQRCode desc',
                success: function(res) {
                    var isbn = "";
                    var obj = null;
                    if (res.resultStr.indexOf("scan_code")!=-1) {
                        obj = JSON.parse(res.resultStr);
                    }
                    if (obj!=null && (typeof obj.scan_code != "undefined") && obj.scan_code.scan_type == "barcode") {
                        var scan_code = obj.scan_code.scan_result;
                        isbn = scan_code.split(",")[1];
                        alert("isbn:" + isbn);
                    } else {
                        isbn = res.resultStr.split(",")[1];
                        alert("isbn:" + isbn);
                    }
                    if (isbn != "") {
                        $.get("getbook.php?isbn=" + isbn, function(res) {
                            alert("res: " + res);
                            var res = JSON.parse(res);
                            document.querySelector('#title').innerHTML = res['title'];
                            document.querySelector('#image').src = res['image'];
                            document.querySelector('#price').innerHTML = res['price'];
                            var shareData = {
                                title: res['title'],
                                desc: res['desc'],
                                link: res['link'],
                                imgUrl: res['image']
                            };
                            wx.onMenuShareAppMessage(shareData);
                            wx.onMenuShareTimeline(shareData);
                            wx.onMenuShareQQ(shareData);
                            wx.onMenuShareWeibo(shareData);
                        });
                    }
                }
            });
        };

    });
</script>

</html>
