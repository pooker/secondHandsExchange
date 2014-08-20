<div class="content">
<div class="content1">
<div class="slide">
<div id="carousel-example-captions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-captions" data-slide-to="0" class=""></li>
          <li data-target="#carousel-example-captions" data-slide-to="1" class=""></li>
          <li data-target="#carousel-example-captions" data-slide-to="2" class="active"></li>
          <li data-target="#carousel-example-captions" data-slide-to="3" class=""></li>
          <li data-target="#carousel-example-captions" data-slide-to="4" class=""></li>
        </ol>
        <div class="carousel-inner">
          <?php $flag=1;foreach ($slide as $sl):?>
          <div class="item <?php if($flag==1){echo 'active';$flag++;}?>">

<?php $str = $sl->description;
    preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$str,$pic);
?>
            <a href="index.php/home/detail/<?php echo $sl->id;?>"><img data-src="holder.js/1000x400/auto/#555:#5555"  src=<?php if($pic): echo $pic[1];else:echo 'application/third_party/waterfall/images/no_pic.gif';endif;?>> </a>
            <div class="carousel-caption">
              <h4><?php echo $sl->title;?></h4>
            </div>
          </div>
          <?php endforeach;?>
        </div>
         <a class="left carousel-control" href="#carousel-example-captions" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-captions" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </div>
     </div>
     <!-- end of the slide bar -->
     
     <div class="down-slide">
     	<h2 class="welcome">欢迎来到颖火城</h2>
     	<p class="welcomep">亲爱的校园学子，你们好，欢迎来到颖火城校园淘宝平台，
     	在这里你可以方便快捷地挑选你想要的东西，也可以拥有自己的店铺哦。
</p>
     </div>
     
     <div class="about">
        <div class="col1">
        <img src="application/third_party/images/about.png" alt="">        
            <h2 class="welcome">About Us</h2>
          <p class="welcomep">我们是大大世界里小小的萤火虫，擎着小小火花飞在静谧的城堡，我们关注学子需求，力图为校园孩子们打造便捷优惠的校园购物平台。
        </div>
        <!--.col-->
        <div class="col1">
          <img src="application/third_party/images/services.png" alt="">
          <h2 class="welcome">Services</h2>
          <p class="welcomep">目前我们开发二手淘区域，你有想法你就来，买方卖方都可以，留言板区可以畅所欲言，学习、工作、商品、旅游任你挑选，后续会有更多精彩内容，不容错过哦
</p>
          
        </div>
        <!--.col-->
        <div class="col1 last">
          <img src="application/third_party/images/support.png" alt="">
          <h2 class="welcome">Support</h2>
          <p class="welcomep">为实现点到点，面对面的交易，我们实行线上交流，线下交易模式，这里只有你想不到的，没有你做不到的。</p>
         
        </div>
        <!--.col-->
      </div>
    </div>
</div>