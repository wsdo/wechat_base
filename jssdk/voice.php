<!DOCTYPE html>
<html>
       <head>
        <meta charset="utf-8">
        <title>优才网微信JS课程</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script src="jquery.js"></script>
    </head>
    <body>
        <div class="wxapi_container">
            <?php 
            $text = array(
            "盼望着，盼望着，东风来了，春天的脚步近了。\n一切都像刚睡醒的样子，欣欣然张开了眼。山朗润起来了，水涨起来了，太阳的脸红起来了。",
            "小草偷偷地从土里钻出来，嫩嫩的，绿绿的。园子里，田野里，瞧去，一大片一大片满是的。坐着，躺着，打两个滚，踢几脚球，赛几趟跑，捉几回迷藏。风轻悄悄的，草软绵绵的。",
            "桃树、杏树、梨树，你不让我，我不让你，都开满了花赶趟儿。红的像火，粉的像霞，白的像雪。花里带着甜味儿；闭了眼，树上仿佛已经满是桃儿、杏儿、梨儿。",
            "花下成千成百的蜜蜂嗡嗡地闹着，大小的蝴蝶飞来飞去。野花遍地是：杂样儿，有名字的，没名字的，散在草丛里，像眼睛，像星星，还眨呀眨的。",
            " “吹面不寒杨柳风”，不错的，像母亲的手抚摸着你。风里带来些新翻的泥土的气息，混着青草味儿，还有各种花的香，都在微微润湿的空气里酝酿。",
            "鸟儿将巢安在繁花嫩叶当中，高兴起来了，呼朋引伴地卖弄清脆的喉咙，唱出宛转的曲子，跟轻风流水应和着。牛背上牧童的短笛，这时候也成天嘹亮地响着。",
            "雨是最寻常的，一下就是三两天。可别恼。看，像牛毛，像花针，像细丝，密密地斜织着，人家屋顶上全笼着一层薄烟。树叶儿却绿得发亮，小草儿也青得逼你的眼。",
            "傍晚时候，上灯了，一点点黄晕的光，烘托出一片安静而和平的夜。在乡下，小路上，石桥边，有撑起伞慢慢走着的人，地里还有工作的农民，披着蓑戴着笠。他们的房屋，稀稀疏疏的，在雨里静默着。",
            "天上风筝渐渐多了，地上孩子也多了。城里乡下，家家户户，老老小小，也赶趟儿似的，一个个都出来了。舒活舒活筋骨，抖擞抖擞精神，各做各的一份事去。“一年之计在于春”，刚起头儿，有的是工夫，有的是希望。",
            "春天像刚落地的娃娃，从头到脚都是新的，它生长着。\n春天像小姑娘，花枝招展的，笑着，走着。
             春天像健壮的青年，有铁一般的胳膊和腰脚，领着我们上前去。"
        );
              $seed =rand(0, count($text)-1);
              $text = $text[$seed];
       
            ?>
            <div class="lbox_close wxapi_form">

                <h3 id="menu-share">看你普通话标准不标准？</h3>
                <h3 id="menu-share">原文(朱自清《春》片段)</h3>
                <span  style="color:blue" id="origintext"><?php echo $text;?></span>
                <br />
                <input  type="hidden" value="<?php echo $seed;?>" id="originid"/> 
                <div id="divvoice" style="display:none;">
                <h3 id="menu-share">你的</h3>
                <span  style="color:red" id="voicetext"></span>
                </div>
                <br />
                <div id="divresult" style="display:none;">
                <h3 id="menu-share">去除标点相似度</h3>
                <div id="percent" style="text-align:center;background-color:green;color:white;font-size:60px;"></div>
                </div>
                <br />
                 <span id="traffictip" style="color:blue"></span><br />
                <h3 id="menu-voice">更丰富多彩地传递信息之语音</h3>
                <span class="desc">开始录制</span>
                <button class="btn btn_primary" id="startRecord">开始朗读</button>
                <span class="desc">停止录制</span>
                <button class="btn btn_primary" id="stopRecord">结束</button>
                <span class="desc">播放声音</span>
                <button class="btn btn_primary" id="playVoice">试播放</button>
                <span class="desc">停止播放</span>
                <button class="btn btn_primary" id="stopVoice">停止播放</button> 

                <span class="desc">提交比较</span>
                <button class="btn btn_primary" id="translateVoice">提交比较</button>

            </div>
        </div>
    </body>
<?php require('signInfo.php'); ?>
    <script type="text/javascript">
        wx.ready(function() {

            
            function enable(id)
            {
                var elem = document.querySelector("#" + id + "");
                elem.style.backgroundColor = "#04be02";
                elem.disabled = false;
            }
            function disable(id)
            {
                var elem = document.querySelector("#" + id + "");
                elem.style.backgroundColor = "gray";
                elem.disabled = true;
            }

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
            // 3 智能接口
            var voice = {
                localId: '',
                serverId: ''
            };
            // 3.1 识别音频并返回识别结果
            document.querySelector('#translateVoice').onclick = function() {
                if (voice.localId == '') {
                    alert('请先使用 startRecord 接口录制一段声音');
                    return;
                }
                disable("translateVoice");
                disable("playVoice");
                disable("stopVoice");
                disable("stopRecord");
                disable("startRecord");

                wx.translateVoice({
                    localId: voice.localId,
                    complete: function(res) {
                        if (res.hasOwnProperty('translateResult')) {
                            var text = res.translateResult;
                            document.querySelector('#voicetext').innerHTML = text;

                            $.post("postvoice.php", {"text": text, "id": document.querySelector('#originid').value}, function(res) {
                                var obj = JSON.parse(res);
                                document.querySelector('#divvoice').style.display="block";
                                document.querySelector('#divresult').style.display="block";
                                document.querySelector('#percent').innerHTML = obj.percent+"%";

                                var shareData = {
                                    title: "我的" + obj.msg + ",你也来试试吧",
                                    desc: "优才网普通话水平测试，得分:"+obj.percent+"，微信JS开发示例",
                                    link: "http://stark.tunnel.itguru.cn/php/voice.php",
                                    imgUrl: "http://p3.ucai.cn/static/i3/logogkk.png"
                                };
                                wx.onMenuShareAppMessage(shareData);
                                wx.onMenuShareTimeline(shareData);
                                wx.onMenuShareQQ(shareData);
                                wx.onMenuShareWeibo(shareData);
                                alert("经微信JS-SDK测验，你的" + obj.msg + ",快去分享给好友吧！");
                                disable("translateVoice");
                                disable("playVoice");
                                disable("stopVoice");
                                disable("stopRecord");
                                enable("startRecord");
                            });

                        } else {
                            alert('无法识别');
                        }
                    }
                });
            };

            // 4 音频接口
            // 4.2 开始录音
            document.querySelector('#startRecord').onclick = function() {
                document.querySelector("#startRecord").innerHTML = "正在录音中";
                disable("startRecord");
                enable("stopRecord");
                disable("translateVoice");
                disable("playVoice");
                disable("stopVoice");
                wx.startRecord({
                    cancel: function() {
                        alert('用户拒绝授权录音');
                    }

                });
            };

            // 4.3 停止录音
            document.querySelector('#stopRecord').onclick = function() {
                wx.stopRecord({
                    success: function(res) {
                        voice.localId = res.localId;
                        alert('录音成功');
                        document.querySelector("#playVoice").innerHTML = "可以播放了";
                        document.querySelector("#startRecord").innerHTML = "开始朗读";
                        disable("startRecord");
                        disable("stopRecord");
                        enable("translateVoice");
                        enable("playVoice");
                        disable("stopVoice");
                    },
                    fail: function(res) {
                        alert(JSON.stringify(res));
                    }
                });
            };

            // 4.4 监听录音自动停止
            wx.onVoiceRecordEnd({
                complete: function(res) {
                    voice.localId = res.localId;
                    alert('录音时间已超过一分钟');
                }
            });

            // 4.5 播放音频
            document.querySelector('#playVoice').onclick = function() {
                if (voice.localId == '') {
                    alert('请先使用 startRecord 接口录制一段声音');

                    return;
                }
                disable("startRecord");
                disable("stopRecord");
                enable("translateVoice");
                disable("playVoice");
                enable("stopVoice");
                wx.playVoice({
                    localId: voice.localId
                });
            };



            // 4.7 停止播放音频
            document.querySelector('#stopVoice').onclick = function() {
                wx.stopVoice({
                    localId: voice.localId
                });
                disable("startRecord");
                disable("stopRecord");
                enable("translateVoice");
                enable("playVoice");
                disable("stopVoice");
            };

            // 4.8 监听录音播放停止
            wx.onVoicePlayEnd({
                complete: function(res) {
                    alert('录音（' + res.localId + '）播放结束');
                }
            });

            disable("translateVoice");
            disable("playVoice");
            disable("stopVoice");
            disable("stopRecord");


        });

        wx.error(function(res) {
            alert(res.errMsg);
        });

    </script>

</html>
