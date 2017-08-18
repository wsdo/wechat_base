<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>上传照片</title>
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
</head>
<body>
<!-- page集合的容器，里面放多个平行的.page，其他.page作为内联页面由路由控制展示 -->
    <div class="page-group">
        <!-- 单个page ,第一个.page默认被展示-->
        <div class="page">
            <!-- 标题栏 -->
            <header class="bar bar-nav">
                <a class="icon icon-me pull-left open-panel"></a>
                <h1 class="title">标题</h1>
            </header>

            <!-- 工具栏 -->
            <nav class="bar bar-tab">
                <a class="tab-item external active" href="#">
                    <span class="icon icon-home"></span>
                    <span class="tab-label">首页</span>
                </a>
                <a class="tab-item external" href="#">
                    <span class="icon icon-star"></span>
                    <span class="tab-label">收藏</span>
                </a>
                <a class="tab-item external" href="#">
                    <span class="icon icon-settings"></span>
                    <span class="tab-label">设置</span>
                </a>
            </nav>

            <!-- 这里是页面内容区 -->
            <div class="content">
				  <div class="content-block">
				<span id="desc" style="color:red"></span><br />
                <img id="retimage" style="max-width:200px;max-height:200px;"/>
                <br />
                <span id="traffictip" style="color:blue"></span><br />
				    <p><a href="#" class="button button-big" id="upimage">选择图片</a></p>
				    <p><a href="#" class="button button-big" id="previewImage">预览图片</a></p>
				    <p><a href="#" class="button button-big button-round" id="uploadImage">上传图片</a></p>
				  </div>
            </div>
        </div>

        <!-- 其他的单个page内联页（如果有） -->
        <div class="page">...</div>
    </div>

    <!-- popup, panel 等放在这里 -->
    <div class="panel-overlay"></div>
    <!-- Left Panel with Reveal effect -->
    <div class="panel panel-left panel-reveal">
        <div class="content-block">
            <p>这是一个侧栏</p>
            <p></p>
            <!-- Click on link with "close-panel" class will close panel -->
            <p><a href="#" class="close-panel">关闭</a></p>
        </div>
    </div>

	<?php require_once('signInfo.php'); ?>
	<script>
	$(function() {
        // 5 图片接口
        // 5.1 拍照、本地选图
        var images = {
            localId: [],
            serverId: [],
            imageUrls: []
        };

        // 选择本地图片
		$("#upimage").click(function(){
			$.toast("点击上传");
			wx.chooseImage({
			    count: 1, // 默认9
			    sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
			    sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
			    success: function (res) {
			        var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
			        images.localId = res.localIds;
			        // var img = "<img sytle='max-width:200px;max-height:200px;' src=" + localIds + ">";
			        // $("#vimage").html(img);
			        $.toast("已经选择了"+res.localIds.length+"张照片")
			    }
			});
		})

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
                                    document.querySelector('#desc').innerHTML = "这张照片上传成功了";
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

  wx.ready(function() {
	    var title =  '图片上传功能'; // 分享标题
	    var link = 'http://stark.tunnel.itguru.cn/php/upimage.php'; // 分享链接
	    var desc = "在这里可以上传图片预览测试";
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

    })
	</script>
</body>
</html>