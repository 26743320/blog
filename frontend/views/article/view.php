<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Aticle */

$this->title = $model['a_title'];
$this->params['breadcrumbs'][] = ['label' => 'Aticles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="aticle-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->id == $model->a_author){?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->a_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->a_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php }?>
    <div>
        <?php echo $model->a_content;?>
    </div>
    <div>
        by <?php echo $model['user']->username?> <?php echo date("y-m-dH:i:s",$model->a_date)?>
    </div>
    <?php  //DetailView::widget([
    //     'model' => $model,
    //     'attributes' => [
    //         'a_id',
    //         'c_id',
    //         'a_title',
    //         'a_content:ntext',
    //         'a_date',
    //         'a_author',
    //     ],
    // ]) 
    ?>

</div>
