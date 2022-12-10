<!DOCTYPE html>
<html lang="zh-Hans"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
   <meta name="apple-mobile-web-app-title" content="秘密胶囊- 快把你的秘密写进胶囊里吧">
  <meta http-equiv="Cache-Control" content="no-siteapp">
  <meta name="author" content="Pings@924984">
  <meta name="keywords" content="秘密胶囊,匿名留言,匿名邮箱,匿名送信,免费留言平台,免费树洞,免费送信平台">
  <meta name="description" content="秘密胶囊,匿名留言,匿名邮箱,匿名送信,免费留言平台,免费树洞,免费送信平台">
  <link rel="stylesheet" href="./css/css.css" type="text/css">
  <link rel="stylesheet" href="./css/font-awesome.css" type="text/css">
  <link rel="stylesheet" href="./css/style.css" type="text/css">
  <link rel="shortcut icon" type="image/ico" href="./images/favicon.ico">
  <title>秘密胶囊 - 查询留言</title>
  <script src="./js/jquery.js"></script>
  <script src="./js/skel.js"></script>
  <script src="./js/util.js"></script>
  <script src="./js/respond.js"></script>
  <script src="https://v1.hitokoto.cn/?encode=js&amp;select=%23hitokoto" defer=""></script>
</head>
<body>
    <div id="wrapper">
	<!--主页-->
        <article id="home" class="panel special" style="display: flex;">
			 <div class="content">
                <ul class="actions spinX">
                    <li><a href="./" class="button small back">返回</a>
                    </li>
                </ul>
                <div class="inner"><b>
                    <header>
                        <h2>查留言</h2>
                        <blockquote><span id="hitokoto">获取中...</span></blockquote>
                    </header>
                    </b>
				<form action="search.php" method="post" name="tijiao">
	          <input type="text" name="name" placeholder="请输入姓名或者暗号查看留言" style="background-color:transparent; border:0px; height:30px; font-size:18px; width:100%"/>
                <center>
                 <hr>
				 <ul class="actions">
                        <li>
						<input type="submit" name="gos" class="css_btn_class" value="查询留言">
                    </li>
					</ul>
							<center>
		<!---输出查询结果-->
<?php
if($_POST["gos"]){
include_once("common.php");
$sqlcx="select * from fanall where name='".$_POST["name"]."'";
$sqlcxgo=mysqli_query($conn,$sqlcx);
if($sqlcxgo>0){
while($myrow=mysqli_fetch_array($sqlcxgo)){
echo '<div style="padding:30px;border:1px solid #BEBEBE;background:#FCFCFC">';
echo "时间:".$myrow['time']."<br><hr>";
$atte = $myrow['text'];
echo htmlentities($atte,ENT_QUOTES,"UTF-8");
echo "</div></p>";
}
}else{
echo "未查询到留言";
}
}
?>
      </center>
                 </form>
                </div>
            </div>
        </article>
		
        <footer id="footer">
        <p class="copyright">Copyright © 2019-2022 by <a href="./" target="_blank">Pings</a>版权所有</p>
        <p class="copyright"><a href="http://beian.miit.gov.cn/publish/query/indexFirst.action" target="_blank">此处填写你的备案号-如果没有请删除</a></p>
    </footer>
    </div>
   
    <script>
        (function($) {
            skel.breakpoints({
                xlarge: '(max-width: 1680px)',
                large: '(max-width: 1280px)',
                medium: '(max-width: 980px)',
                small: '(max-width: 736px)',
                xsmall: '(max-width: 480px)',
                xxsmall: '(max-width: 360px)'
            });
            $(function() {
                var $window = $(window),
                    $document = $(document),
                    $body = $('body'),
                    $wrapper = $('#wrapper'),
                    $footer = $('#footer');
                $window.on('load', function() {
                    window.setTimeout(function() {
                        $body.removeClass('is-loading-0');
                        window.setTimeout(function() {
                            $body.removeClass('is-loading-1');
                        }, 1500);
                    }, 100);
                });
                $('form').placeholder();
                var $wrapper = $('#wrapper'),
                    $panels = $wrapper.children('.panel'),
                    locked = true;
                $panels.not($panels.first()).addClass('inactive').hide();
                $panels.each(function() {
                    var $this = $(this),
                        $image = $this.children('.image'),
                        $img = $image.find('img'),
                        position = $img.data('position');
                    $image.css('background-image', 'url(' + $img.attr('src') + ')');
                    if (position) $image.css('background-position', position);
                    $img.hide();
                });
                window.setTimeout(function() {
                    locked = false;
                }, 1250);
                $('a[href^="#"]').on('click', function(event) {
                    var $this = $(this),
                        id = $this.attr('href'),
                        $panel = $(id),
                        $ul = $this.parents('ul'),
                        delay = 0;
                    event.preventDefault();
                    event.stopPropagation();
                    if (locked) return;
                    locked = true;
                    $this.addClass('active');
                    if ($ul.hasClass('spinX') || $ul.hasClass('spinY')) delay = 250;
                    window.setTimeout(function() {
                        $panels.addClass('inactive');
                        $footer.addClass('inactive');
                        window.setTimeout(function() {
                            $panels.hide();
                            $panel.show();
                            $document.scrollTop(0);
                            window.setTimeout(function() {
                                $panel.removeClass('inactive');
                                $this.removeClass('active');
                                locked = false;
                                $window.triggerHandler('--refresh');
                                window.setTimeout(function() {
                                    $footer.removeClass('inactive');
                                }, 250);
                            }, 100);
                        }, 350);
                    }, delay);
                });
                if (skel.vars.IEVersion < 12) {
                    $window.on('--refresh', function() {
                        $wrapper.css('height', 'auto');
                        window.setTimeout(function() {
                            var h = $wrapper.height(),
                                wh = $window.height();
                            if (h < wh) $wrapper.css('height', '100vh');
                        }, 0);
                        if (skel.vars.IEVersion < 10) {
                            var $panel = $('.panel').not('.inactive'),
                                $image = $panel.find('.image'),
                                $content = $panel.find('.content'),
                                ih = $image.height(),
                                ch = $content.height(),
                                x = Math.max(ih, ch);
                            $image.css('min-height', x + 'px');
                            $content.css('min-height', x + 'px');
                        }
                    });
                    $window.on('load', function() {
                        $window.triggerHandler('--refresh');
                    });
                    $('.spinX').removeClass('spinX');
                    $('.spinY').removeClass('spinY');
                }
            });
        })(jQuery);
    </script>
	
</body></html>