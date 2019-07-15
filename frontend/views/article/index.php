<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aticles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aticle-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Aticle', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    foreach ($models as $model) {?>
        <div><a href=/article/view?id=<?=$model['a_id']?>><?=$model['a_title']?></a> <?=date("y-m-d H:i:s",$model['a_date'])?> <?=$model['user']['username']?></div>
    <?php }?>
    <div><?= LinkPager::widget(['pagination' => $pages]); ?></div>
    <?php  // GridView::widget([
    //     'dataProvider' => $dataProvider,
    //     'columns' => [
    //         ['class' => 'yii\grid\SerialColumn'],

    //         'a_id',
    //         'c_id',
    //         'a_title',
    //         'a_content:ntext',
    //         'a_date',
    //         //'a_author',

    //         ['class' => 'yii\grid\ActionColumn'],
    //     ],
    // ]); 
    ?>


</div>
