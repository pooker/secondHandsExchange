<link rel="stylesheet" href="application/third_party/waterfall/css/center.css" type="text/css" media="all">
<link rel="stylesheet" href="application/third_party/waterfall/css/pbl.css" type="text/css" media="all">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="application/third_party/waterfall/js/jquery.masonry.js"></script>
<script type="text/javascript" src="application/third_party/waterfall/js/jquery.infinitescroll.js"></script>
<script type="text/javascript">
var isWidescreen=screen.width>=1280; 
if(isWidescreen){document.write("<style type='text/css'>.demo{width:981px;}</style>");}
</script>
<style type="text/css">
.demo{width:981px;}
</style>
<script type="text/javascript">
function item_masonry(){ 
	$('.item img').load(function(){ 
		$('.infinite_scroll').masonry({ 
			itemSelector: '.masonry_brick',
			columnWidth:231,
			gutterWidth:19								
		});		
	});
		 //columnWidth 函数递增控制div左边距
	$('.infinite_scroll').masonry({ 
		itemSelector: '.masonry_brick',
		columnWidth:231,
		gutterWidth:19								
	});	
}
$(function(){
//滚动条下拉事件
	function item_callback(){
		$('.item').mouseover(function(){
			$(this).css('box-shadow', '0 1px 5px rgba(35,25,25,0.5)');
			//alert(1);
			$('.btns',this).show();
		}).mouseout(function(){
			$(this).css('box-shadow', '0 1px 3px rgba(34,25,25,0.2)');
			$('.btns',this).hide();		 	
		});
		item_masonry();	
	}
	item_callback();  
	$('.item').fadeIn();
	var sp = 1
	$(".infinite_scroll").infinitescroll({
		navSelector  	: "#more",
		nextSelector 	: "#more a",
		itemSelector 	: ".item",
		loading:{
			img: "images/masonry_loading_1.gif",
			msgText: '正在加载中....',
			finishedMsg: '木有了,看看下一页',
			finished: function(){
				sp++;
				if(sp>=10){ //到第10页结束事件
					$("#more").remove();
					$("#infscr-loading").hide();
					$("#pagebox").show();
					$(window).unbind('.infscr');
				}
			}	
		},errorCallback:function(){ 
			$("#pagebox").show();
		}
	},function(newElements){
		var $newElems = $(newElements);
		$('.infinite_scroll').masonry('appended', $newElems, false);
		$newElems.fadeIn();
		item_callback();
		return;
	});
});
</script>
</head>
<body>
 
<div class = "content">
<!--瀑布流 start-->
<div class="pbl_container">
  <div class="pblCon">
    <div class="demo clearfix">
      <div class="item_list infinite_scroll">
      
      <?php if (isset($accounts)): foreach ($accounts as $key => $a): ?>
<?php $str = $a->description;
    preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$str,$pic);

?>
      
      
        <div class="item masonry_brick">
          <div class="item_t">
            <div class="img"> 
            <a href=<?php echo 'index.php/home/detail/'.$a->id;?> title=<?php echo $a->title?> target="_blank">
            <img width="210" src=<?php if($pic): echo $pic[1];else:echo 'application/third_party/waterfall/images/no_pic.gif';endif;?> />
            
            
            </a>
              
            </div>
            <div class="title1"><em>T:</em><span><?php echo $a->title;?></span></div>
          </div>
          <div class="item_b clearfix">
            <div class="items_likes fl"> <span><em class = "price">￥<?php echo $a->price?></em></span><span><em class ="address">@<?php echo $a->address?></em></span> </div>
          </div>
        </div>
        
        <?php endforeach; endif; ?>
    </div>
    </div>
    </div>
    </div>
    <div class="row">
  <div class="col-md-6 col-md-offset-4"><?php echo $pagination; ?> </div>
</div>
    
    <div  class="panel panel-default">
    
    </div> 
   </div><!-- end of the content -->
<script type="text/javascript">
//回话顶部JS，最下面还有一段代码
var ScrollToTop=ScrollToTop||{
	setup:function(){
		
		var a=$(window).height()/2;
		$(window).scroll(function(){
			(window.innerWidth?window.pageYOffset:document.documentElement.scrollTop)>=a?$("#ScrollToTop").removeClass("Offscreen"):$("#ScrollToTop").addClass("Offscreen")
		});
		$("#ScrollToTop").click(function(){
			$("html, body").animate({scrollTop:"0px"},400);
			return false
		})
	}
};
$(document).ready(function(){
	ScrollToTop.setup();
});
</script>  
