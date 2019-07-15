<?php
use yii\bootstrap\Carousel;
use yii\helpers\Url;
/* @var $this yii\web\View */

//$this->title = 'My Yii Application';
?>
<style>
#tu{
    width: 100%;
    overflow: hidden;
    /*background-size:cover; */
}
.line{
    width: 100%;
    border-bottom: 2px solid gray;
}
</style>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-8">
                <div class="img-wall" style="width:660">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="4000" >

                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="<?=Url::to('@web/images/snail.jpg')?>" alt="First slide">
                                <div class="carousel-caption">标题 1</div>
                            </div>
                            <div class="item">
                                <img src="<?=Url::to('@web/images/snail.jpg')?>" alt="Second slide">
                                <div class="carousel-caption">标题 2</div>
                            </div>
                            <div class="item">
                                <img src="<?=Url::to('@web/images/snail.jpg')?>" alt="Third slide">
                                <div class="carousel-caption">标题 3</div>
                            </div>
                        </div>

                        <a class="carousel-control left" href="#myCarousel"
                           data-slide="prev">&lsaquo;</a>
                        <a class="carousel-control right" href="#myCarousel"
                           data-slide="next">&rsaquo;</a>
                    </div>
                </div>
                <!-- <img id="tu" src='/images/snail.jpg' /> -->
                <?php //echo Carousel::widget([
                //items' => [
                    // 只有图片的格式
                    //'<img src="/images/snail.jpg"/>',
                    
                    // 与上面的效果一致
                    //['content' => '<img src="/images/snail.jpg"/>'],
                    
                    // 包含图片和字幕的格式
                   // [
                   //     'content' => '<img src="/images/snail.jpg"/>',
                   //     'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
                        //'options' => [...],       //配置对应的样式
                   // ],
                //]
            //]);
            ?>
            </div>
           
            <div class="col-lg-4">
                <h2>关于我</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <h2>最新文章</h2>
                <div class="line"></div>
                <?php foreach($articles as $article){?>
                    <div  class="col-lg-8">
                        <div><a href="/article/view?id=<?=$article['a_id']?>"><h2><?=$article['a_title']?></h2></a></div>
                    </div>
                <?php }?>
            </div>
           
            <div class="col-lg-4">
                <h2>友情连接</h2>

                <p></p>
            </div>
        </div>
    </div>
</div>
