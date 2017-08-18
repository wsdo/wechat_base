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
                <h3 id="menu-image">更丰富多彩地传递信息之照片</h3>
                <span id="desc" style="color:red"></span><br />
                <img id="retimage" style="max-width:200px;max-height:200px;"/>
                <br />
                <span id="traffictip" style="color:blue"></span><br />
                <span class="desc">拍照或从手机相册中选图接口</span>
                <button class="btn btn_primary" id="chooseImage">拍照或选择照片</button>
                <span class="desc">上传图片接口</span>
                <button class="btn btn_primary" id="uploadImage">上传图片</button>
                <span class="desc">预览图片接口</span>
                <button class="btn btn_primary" id="previewImage">预览图片</button>
            </div>
        </div>
    </body>

    <?php require('signInfo.php'); ?>

    <script type="text/javascript" src="//cdn.bootcss.com/jquery/3.1.1/jquery.js"></script>
    <script type="text/javascript">
        
        wx.ready(function() {
            wx.getNetworkType({
            success: function(res) {
                if(res.networkType=="wifi")
                {
                     document.querySelector('#traffictip').innerHTML=('你当前使用 ' + res.networkType + '上网'+",可以和小伙伴们放心愉快地玩耍！");
                }
                else
                {
                    document.querySelector('#traffictip').innerHTML=('你当前使用 ' + res.networkType + '上网'+",注意流量使用，土豪请随意！");
                    document.querySelector('#traffictip').style.color="red";
                }
                
            },
            fail: function(res) {
                alert(JSON.stringify(res));
            }
        });
            // 5 图片接口
            // 5.1 拍照、本地选图
            var images = {
                localId: [],
                serverId: [],
                imageUrls: []
            };
            document.querySelector('#chooseImage').onclick = function() {
                wx.chooseImage({
                    success: function(res) {
                        images.localId = res.localIds;
                        document.querySelector('#chooseImage').innerHTML = ('已选择 ' + res.localIds.length + ' 张图片');
                    }
                });
            };

            // 5.2 图片预览
            document.querySelector('#previewImage').onclick = function() {
                if (images.imageUrls.length <= 0) {
                    alert("要上传成功才能预览哦");
                    return;
                }
                wx.previewImage({
                    current: images.imageUrls[0],
                    urls: images.imageUrls
                });
            };

            // 5.3 上传图片
            document.querySelector('#uploadImage').onclick = function() {
                if (images.localId.length == 0) {
                    alert('请先使用 chooseImage 接口选择图片');
                    return;
                }
                var i = 0, length = images.localId.length;
                images.serverId = [];
                function upload() {
                    wx.uploadImage({
                        localId: images.localId[i],
                        success: function(res) {
                            i++;
                            alert('已上传：' + i + '/' + length + ", 服务器正在处理，请稍候...");
                            images.serverId.push(res.serverId);
                            if (i < length) {
                                upload();
                            } else {
                                //alert("服务器:"+images.serverId.join(","));
                                $.post("postpicture.php", {"srvids": images.serverId.join(",")}, function(res) {
                                    alert("全部上传完成:" + res);
                                    var obj = JSON.parse(res);
                                    images.imageUrls = obj['urls'];
                                    document.querySelector('#retimage').src = obj['smallurls'][0];
                                    document.querySelector('#desc').innerHTML = "这张照片上传成功了，来自于优才网哦！";
                                    document.querySelector('#previewImage').innerHTML = "上传成功了，可以预览了!";
                                });
                            }
                        },
                        fail: function(res) {
                            alert(JSON.stringify(res));
                        }
                    });
                }
                upload();
            };

        });
    </script>

</html>
